/***********************
* All Right Reserved @ Debdipta
*
************************/

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include "collector.h"
#include "logger.h"
#include "cpu_monitor.h"
#include "io_monitor.h"
#include "common.h"

int check_root_permission()
{
    if (0 != geteuid()) {
        printf(" We might have elevated privileges beyond that of the user who invoked\
         * the program, due to suid bit. Run with root permission\n");
        return -1;
    }
    return 0;
}

void Initialize_monitors()
{

#ifdef __CPU__
    new cpu_monitor("cpu_monitor");
#endif
#ifdef _IO___
    new io_monitor("io_monitor");
#endif
}

int main(int argc, char* argv[])
{   
    if( -1 == check_root_permission())
        exit(0);
    LOG(L1,"Starting System Monitor Application");

    //License checker 

// Initialize monitors
    Initialize_monitors();
    //test
    collector* pcollector = new collector();
    pcollector->trigger();
    return 0;
}
