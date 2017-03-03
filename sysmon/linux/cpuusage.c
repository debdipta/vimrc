#include <stdio.h>
#include <signal.h>
#include <stdlib.h>
#include <unistd.h>

#define DEBUG

#ifdef DEBUG
#define LOG(msg, ...) { \
    do {       \
        printf(msg,__VA_ARGS__);    \
    } while(0);  \
}//I Quit from here
#define LOGmsg(msg) { \
    do {       \
        printf(msg);    \
    } while(0);  \
}//I Quit from here
#endif

#define SMLBUFSIZ ( 256 )
#define NORETURN __attribute__((__noreturn__))

static int  Cpu_tot;

typedef long long SIC_t;
typedef unsigned long long TIC_t;
typedef struct CPU_t {
    TIC_t u, n, s, i, w, x, y, z; // as represented in /proc/stat
    TIC_t u_sav, s_sav, n_sav, i_sav, w_sav, x_sav, y_sav, z_sav; // in the order of our display
    unsigned id;  // the CPU ID number
} CPU_t;


static void bye_bye (FILE *fp, int eno, const char *str) NORETURN;
static void bye_bye (FILE *fp, int eno, const char *str)
{
    fflush(stdout);
    fprintf(fp, "Bye Bye\n");
    exit(eno);
}

static void end_pgm (int sig) NORETURN;
static void end_pgm (int sig)
{
    if(sig)
        sig |= 0x80;
    bye_bye(stdout, sig, NULL);    
}

static void 
before()
{
    Cpu_tot = sysconf(_SC_NPROCESSORS_ONLN);
    LOG("Cpu_total=%ld\n", Cpu_tot);
}

static CPU_t *cpus_refresh (CPU_t *cpus)
{
    static FILE *fp = NULL;
    char buf[SMLBUFSIZ];
    int num, i;

    if(!fp) {
        //Open /proc/stat for cpu usage details
        if(!(fp = fopen("/proc/stat", "r")))    {
            LOGmsg("Error in opening file, exiting...\n");
            exit(0);
        }
        //Allocation memory for each CPUs + 1
        cpus = malloc((1 + Cpu_tot) * sizeof(CPU_t));
    }
    rewind(fp);
    fflush(fp);
    // first value the last slot with the cpu summary line
    if (fgets(buf, sizeof(buf), fp)) {
        cpus[Cpu_tot].x = 0;
        cpus[Cpu_tot].y = 0;
        cpus[Cpu_tot].z = 0;
        num = sscanf(buf, "cpu %Lu %Lu %Lu %Lu %Lu %Lu %Lu %Lu",
                &cpus[Cpu_tot].u,
                &cpus[Cpu_tot].n,
                &cpus[Cpu_tot].s,
                &cpus[Cpu_tot].i,
                &cpus[Cpu_tot].w,
                &cpus[Cpu_tot].x,
                &cpus[Cpu_tot].y,
                &cpus[Cpu_tot].z
                );
    }
    // now value each separate cpu's tics
    for (i = 0; 1 < Cpu_tot && i < Cpu_tot; i++) {
        if (!fgets(buf, sizeof(buf), fp))   {
            LOGmsg("failed /proc/stat read");
            exit(0);
        }
        cpus[i].x = 0; 
        cpus[i].y = 0;
        cpus[i].z = 0;
        num = sscanf(buf, "cpu%u %Lu %Lu %Lu %Lu %Lu %Lu %Lu %Lu",
                &cpus[i].id,
                &cpus[i].u, &cpus[i].n, &cpus[i].s, &cpus[i].i, &cpus[i].w, &cpus[i].x, &cpus[i].y, &cpus[i].z
                );
    }
    return cpus;
}

/********
*    Returns cpu idle percentage for sent processor
*
*********/
static float formathlp(  CPU_t  *cpu )
{
    // we'll trim to zero if we get negative time ticks,
    // which has happened with some SMP kernels (pre-2.4?)
#define TRIMz(x)  ((tz = (SIC_t)(x)) < 0 ? 0 : tz)
    SIC_t u_frme, s_frme, n_frme, i_frme, w_frme, x_frme, y_frme, z_frme, tot_frme, tz;
    float scale, idle = 99.9;

    u_frme = cpu->u - cpu->u_sav;
    s_frme = cpu->s - cpu->s_sav;
    n_frme = cpu->n - cpu->n_sav;
    i_frme = TRIMz(cpu->i - cpu->i_sav);
    w_frme = cpu->w - cpu->w_sav;
    x_frme = cpu->x - cpu->x_sav;
    y_frme = cpu->y - cpu->y_sav;
    z_frme = cpu->z - cpu->z_sav;
    tot_frme = u_frme + s_frme + n_frme + i_frme + w_frme + x_frme + y_frme + z_frme;
    if (tot_frme < 1) tot_frme = 1;
    scale = 100.0 / (float)tot_frme;

    //LOG("u_frme=%f\n", (float)u_frme * scale); //
    //LOG("s_frme=%f\n", (float)s_frme * scale);
    //LOG("n_frme=%f\n", (float)n_frme * scale);
    //LOG("i_frme=%f\n", (float)i_frme * scale); //cpu idle time
    //LOG("w_frme=%f\n", (float)w_frme * scale);
    //LOG("x_frme=%f\n", (float)x_frme * scale);
    //LOG("y_frme=%f\n", (float)y_frme * scale);
    //LOG("z_frme=%f\n", (float)z_frme * scale);
    
    idle = (float)i_frme * scale;

    // remember for next time around
    cpu->u_sav = cpu->u;
    cpu->s_sav = cpu->s;
    cpu->n_sav = cpu->n;
    cpu->i_sav = cpu->i;
    cpu->w_sav = cpu->w;
    cpu->x_sav = cpu->x;
    cpu->y_sav = cpu->y;
    cpu->z_sav = cpu->z;

#undef TRIMz
    return idle;
}

static void summary_show()
{
    int i = 0;
    static CPU_t  *smpcpu = NULL;
    smpcpu = cpus_refresh (smpcpu);
    printf("Cpu(s):%2f\n",formathlp(&smpcpu[Cpu_tot])); //Average for all processor
    for(i=0;i<Cpu_tot;i++)
        printf("cpu[%d]=%f\n", i,formathlp(&smpcpu[i]));
}

int main(int argc, char* argv[])
{
    signal(SIGALRM,  end_pgm);
    signal(SIGHUP,   end_pgm);
    signal(SIGINT,   end_pgm);
    signal(SIGPIPE,  end_pgm);
    signal(SIGQUIT,  end_pgm);
    signal(SIGTERM,  end_pgm);
    
    before();
    summary_show();
    while(1)   { 
        summary_show();
        printf("\n------------\n");
        sleep(2);
    }
    return 0;
}
