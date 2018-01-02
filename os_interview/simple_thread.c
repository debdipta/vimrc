#include <stdio.h>
#include <string.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <errno.h>
#include <ctype.h>
#include <pthread.h>

#define handle_error_en(en, msg)    \
    do  {                           \
        errno = en; perror(msg);    \
        exit(EXIT_FAILURE);         \
    } while(0);

#define handle_error( msg ) \
    do  {                   \
        perror(msg);        \
        exit(EXIT_FAILURE); \
    }while(0);

struct thread_info {
    pthread_t thread_id;        /* ID returned by pthread_create() */
    int       thread_num;       /* Application-defined thread # */
    char     *argv_string;      /* From command-line argument */
};

static void* 
thread_start(void* pdata)  
{
    struct thread_info *tinfo = (struct thread_info *)pdata;
    char *p_ret, *p_tmp;
    p_ret = strdup(tinfo->argv_string);
    for(p_tmp = p_ret; *p_tmp != '\0'; p_tmp++)
        *p_tmp = toupper(*p_tmp);
    return (void*)p_ret;
}


int main(int argc, char* argv[])
{
    pthread_attr_t attr;
    struct thread_info *tinfo;
    int s, opt = -1, num_threads = 1, tnum = 0;
    int stack_size = 0; 
    void* ret;
    while((opt = getopt(argc, argv, "s:")) != -1) {
        switch(opt) {
            case 's':
                stack_size = strtoul(optarg, NULL, 0);
                break;
            default:
                fprintf(stderr, "Usage: %s [-s stack-size] arg...\n",
                    argv[0]);
                exit(EXIT_FAILURE);
        }
    }
    printf("Stack_size = %d\n", stack_size);
    // Right now optind = 2 (s and program name)
    num_threads = argc - optind;
    s = pthread_attr_init(&attr);
    if (stack_size > 0) 
        if (0 != pthread_attr_setstacksize(&attr, stack_size))
            handle_error_en(s, "pthread_attr_setstacksize");
    
    tinfo = calloc(num_threads, sizeof(struct thread_info));
    if (NULL == tinfo)
        handle_error("calloc");

    /* Create one thread for each command-line argument */
    for(tnum = 0; tnum < num_threads; tnum++)   {
        tinfo[tnum].thread_num = tnum + 1;
        tinfo[tnum].argv_string = argv[optind + tnum];
        s = pthread_create(&tinfo[tnum].thread_id, &attr,
                            &thread_start, &tinfo[tnum]);
        if ( s != 0)
            handle_error_en(s, "pthread_create");
    }

/* Destroy the thread attributes object, since it is no longer needed */
    s = pthread_attr_destroy(&attr);
    if ( s != 0)
        handle_error_en(s, "ppthread_attribte_destroy");


    /* Join each thraed and display its value*/
    for(tnum = 0; tnum < num_threads; tnum++)   {
        pthread_join(tinfo[tnum].thread_id, &ret);
        if ( s != 0)
            handle_error_en(s, "pthread_join");
        printf("Returned from thread[%2d], Return Value = %s\n", tinfo[tnum].thread_num, (char*)ret);
        free(ret);
    }
    free(tinfo);


    return 0;
}
