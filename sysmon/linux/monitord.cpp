/***********************
* All Right Reserved @ Debdipta
*
***********************/

#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <sys/types.h>
#include "collector.h"
#include "logger.h"

int check_root_permission()
{
    if (0 != geteuid()) {
        printf(" We might have elevated privileges beyond that of the user who invoked\
         * the program, due to suid bit. Run with root permission\n");
        return -1;
    }
    return 0;
}

int main(int argc, char* argv[])
{   
    if( -1 == check_root_permission())
        exit(0);
    LOG(L1,"Starting System Monitor Application");

    //License checker 


    //test
    collector* pcollector = new collector();
    pcollector->trigger();
    return 0;
}
