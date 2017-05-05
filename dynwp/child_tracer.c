#include <stdio.h>
#include <sys/ptrace.h>
#include <sys/types.h>
#include <sys/wait.h>
#include <unistd.h>
#include <string.h>
#include <sys/signal.h>
#include <syscall.h>
#include <unistd.h>
#include <sys/user.h>
#include <stddef.h>
#include <pthread.h>
#include <errno.h>
#include <sys/prctl.h>
#include "pstack.h"

void* thread_proc_one(void*);
void* thread_proc_two(void*);

//Variables needed to be traced
static int g_var_x = 0, g_var_y = 0, g_var_z = 0;
int thread_stop_flag = 0;

//struct consist of two debigger and debugee process id
typedef struct {
    volatile pid_t debugee_tid;
    volatile pid_t debuger_tid;
    pid_t debugee_pid;
}parent_action_args;

enum {
    DR7_BREAK_ON_EXEC  = 0,
    DR7_BREAK_ON_WRITE = 1,
    DR7_BREAK_ON_RW    = 3,
};

enum {
    DR7_LEN_1 = 0,
    DR7_LEN_2 = 1,
    DR7_LEN_4 = 3,
};

typedef struct {
    char l0:1;
    char g0:1;
    char l1:1;
    char g1:1;
    char l2:1;
    char g2:1;
    char l3:1;
    char g3:1;
    char le:1;
    char ge:1;
    char pad1:3;
    char gd:1;
    char pad2:2;
    char rw0:2;
    char len0:2;
    char rw1:2;
    char len1:2;
    char rw2:2;
    char len2:2;
    char rw3:2;
    char len3:2;
} dr7_t;

typedef int (*fn_ptr)(pid_t);
static parent_action_args g_arg_params;

int trap_handle(pid_t child_waited )
{
    printf("%s, new value: %d, child_waited=<%ld>\n", __func__,g_var_x, child_waited);
    int errno_ = -1;
    errno_ = kill(child_waited, SIGUSR1);
    //errno_ = syscall(SYS_tkill,  child_waited, SIGUSR1);
    //errno_ = pthread_kill(child_waited, SIGUSR1);
    if(0==errno_)
        printf("Signal sent to thread: %ld, parent=%ld\n", child_waited,g_arg_params.debugee_pid);
    else
        printf("Signal not sent to thread,error:%d", errno_);
}
static inline int set_hw_br(pid_t tracee, dr7_t *pdr7, void *addr, int dr_index)
{
    errno = 0;
    printf("LINE = %d <pid> %d, dr_index= %d\n",__LINE__, tracee, dr_index);
    if (ptrace(PTRACE_POKEUSER, tracee, offsetof(struct user, u_debugreg[dr_index]), addr))
    {
        printf("22  errno = %d\n", errno);
        return -1;
    }
    if (ptrace(PTRACE_POKEUSER, tracee, offsetof(struct user, u_debugreg[7]), *pdr7))
    {
        printf("33 errno = %d\n", errno);
        return -1;
    }
}

/* The Tracer process activity : tracer_actions()  ->                                       *
Task:                                                                                       *            
1. attach the thread of a parent                                                     *
2. Wait for 'child processes' signal and act accordingly.                                    *
NOTE: Until the child threads are detached tracer process will get SIGTRAP and has to      *
handle that. After detach, child thread's own SIGTRAP sighandler will be called.            *
 */

void tracer_actions(void *tracked_add, fn_ptr debug_handler)
//void tracer_actions()
{
    int status = 0;
    int signal_catch_cnt = 0;
    int exit_cnt = 0;
    int sig_cnt = 0;
    int stop_cnt = 0;
    int trap_stop_cnt = 0;
    int cnt = 0;
    int *pNum = tracked_add;
    int trap_cnt= 0;
    pid_t child_waited = -1;
    if(g_arg_params.debugee_tid)
    {
        if(-1L == ptrace(PTRACE_ATTACH, g_arg_params.debugee_tid, NULL))
        {
            printf("MKH_ATTACH-FAIL err =%s debugee<tid> %d debuger <tid>%d\n",
                    strerror(errno), g_arg_params.debugee_tid,
                    g_arg_params.debuger_tid);
            return ;

        }
        else
            printf("Ptrace attached passed...\n");
        /*
           if(ptrace(PTRACE_SETOPTIONS, g_arg_params.debugee_tid, NULL, ptraceOption))
           {
           printf("Error, ptrace(PTRACE_SETOPTIONS, failed with %d\n", errno);
           }
         */
        /* DRs modification through ptrace and ptarce detach the child */
        dr7_t dr7 = {0};
        dr7.l0 = 1;
        dr7.rw0 = DR7_BREAK_ON_WRITE;
        dr7.len0 = DR7_LEN_4;

        set_hw_br(g_arg_params.debugee_tid, &dr7, &g_var_x, 0);
        /* Continue the tracee thread */
        if (ptrace(PTRACE_CONT, g_arg_params.debugee_tid, NULL, NULL))
        {
            printf("44\n");
        }
        printf("parenet_action: debugee_tid= <%d>\n",g_arg_params.debugee_tid);
        /* wait for tracee processs' signal. Only sigtrap is handled */
        while(1)
        {
            child_waited = waitpid(-1, &status, __WALL);
            signal_catch_cnt++;
            /* None to wait for */
            if(child_waited == -1)
                break;
            cnt++;
            printf("got a wait catch at parent %d\n", child_waited);

            //if((WIFSTOPPED(status)== SIGTRAP) || (WSTOPSIG(status) == SIGTRAP))
            if(WIFSTOPPED(status) && WSTOPSIG(status) == SIGTRAP)
            {
                trap_cnt++;
                //debug_handler(child_waited);
                loadSymbols(child_waited);
                crawl(child_waited);
                //pthread_kill(child_waited, SIGTRAP);
                //kill(child_waited, SIGUSR1);
                //printf("g_var_x=%d\n",*pNum);;
            }
            /* One child got exited: break if no more child to wait for */
            else if(WIFEXITED(status))
            {
                exit_cnt++; 
                break;
            }
            /* One child got signalled: break if no more child to wait for */
            else if(WIFSIGNALED(status))
            {
                sig_cnt++;
                break;
            }
            /*
               else if(WIFSTOPPED(status))
               {
               stop_cnt++; 
               int stopCode = WSTOPSIG(status);
               printf("Received Signal : %d \n", stopCode);
               }*/
            /* Continue the tracee thread */
            ptrace(PTRACE_CONT, child_waited, NULL, NULL);
        } // while(1)

        printf("---Exit::tracer_actions(...)-<total_sig %d>,"
                "<proceseed_sig %d>,exit %d, sig %d, stop %d,"
                "trap_stop =%d, traps <%d>\n",
                signal_catch_cnt,cnt,exit_cnt, sig_cnt,stop_cnt,trap_stop_cnt, trap_cnt);
        fflush(NULL);
    }
}

int main(int argc, char* argv[])
{
    int child = -1;
    pthread_t thread_one, thread_two;
    int iRet1 = -1, iRet2 = -1;
    //long ptraceOption = PTRACE_O_TRACECLONE;
#if 0 
    sigset_t set;

    sigemptyset(&set);
    sigaddset(&set, SIGUSR1);
    pthread_sigmask(SIG_BLOCK, &set, NULL);
#endif
    printf("main <parent> = %d\n",getpid());
    iRet1 = pthread_create(&thread_one, NULL, thread_proc_one, NULL/*(void*)&set*/);
    iRet2 = pthread_create(&thread_two, NULL, thread_proc_two, NULL);
#if 0
    sleep(1);
    if ((child = fork()) == 0)
    {
        g_arg_params.debuger_tid = getpid();
        printf(" g_arg_params.debuger_tid in child = %d\n",  g_arg_params.debuger_tid);
        //sleep(3);
        tracer_actions(&g_var_x, trap_handle);
    }
    else
    {
        g_arg_params.debuger_tid = child;
        pthread_join(thread_one, NULL);
        pthread_join(thread_two, NULL);
        printf("Thread One returns %d\n", iRet1);
        wait(NULL);
    }
#else
        pthread_join(thread_two, NULL);
        pthread_join(thread_one, NULL);
	while(1)
	sleep(10);
        wait(NULL);
#endif
    return 0;
}

void baz() {
    g_var_x++;
}

void bak() { baz(); }
void bar() { bak(); }
void foo() { bar(); }

void stack_dump()
{
    printf("******trap() entry ******\n");
printf("tid: %ld: pid=%ld\n", syscall(SYS_gettid), getpid());
    void *array[10];
    size_t size;
    // get void*'s for all entries on the stack
    size = backtrace(array, 10);

    // print out all the frames to stderr
//    fprintf(stderr, "Error: signal %d:\n", sig);
    backtrace_symbols_fd(array, size, STDERR_FILENO);
    printf("*******trap() exit ******\n");
}

void* thread_proc_one(void *lParam)
{
    //sigset_t *set = (sigset_t*)lParam;
    //int error_ = pthread_sigmask(SIG_UNBLOCK, set, NULL);
    //if(0!=error_)
    //    printf("Error in pthread_sigmask\n");
#if 0
    sigset_t set;
    sigemptyset(&set);
    sigaddset(&set, SIGUSR1);
    pthread_sigmask(SIG_UNBLOCK, &set, NULL);
#endif
    printf("--Entry: thread_one debugee tid<%ld> \n", syscall(SYS_gettid));
    g_arg_params.debugee_tid =  syscall(SYS_gettid);
    g_arg_params.debugee_pid =  syscall(SYS_getpid);

    struct sigaction trap_action;
    //printf("Childprocess <tid> %d\n", syscall (SYS_gettid));
    //memset(&trap_action, 0, sizeof(trap_action));
    sigaction(SIGUSR1, NULL, &trap_action);
    trap_action.sa_sigaction = stack_dump;
    trap_action.sa_flags = SA_SIGINFO | SA_RESTART | SA_NODEFER;
    sigaction(SIGUSR1, &trap_action, NULL);

    sleep(2);
    foo();
    sleep(1);
    foo();

while(1)
sleep(10);

    //foo();
    /*sleep(1);
    foo();
    sleep(1);
    foo();*/
#if 0
    while(1 != thread_stop_flag)
    {
        sleep(1);
        if(g_var_x > 2)
            thread_stop_flag = 1;
        else
            foo();
        printf("g_var_x=%d\n", g_var_x);
    }
#endif
    printf("--Exit: thread_one\n");
}

void *thread_proc_two(void *lParam)
{
    printf("--Entry: thread_two debuger tid<%ld> \n", syscall(SYS_gettid));
    int child = -1;
    int status = -1;
    sleep(1);
    if ((child = fork()) == 0)
    {        
        tracer_actions(&g_var_x, trap_handle);
    }
    else
    {
        wait(NULL);
    }
while(1)
sleep(10);
    printf("--Exit: thread_two\n");
#if 0
	if(g_arg_params.idProcess)
	{
		prctl(PR_SET_PTRACER, g_arg_params.idProcess, 0, 0, 0);
	}
	else
	{
		printf("hsdflklfs:\n");
	}
#endif
}
