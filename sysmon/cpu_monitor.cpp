#include "cpu_monitor.h"
#include <stdio.h>
#include <iostream>
#include <string.h>
#include <stdlib.h>

cpu_monitor::cpu_monitor(const char* _name)
{
    name = _name;
    monitor =  NULL;
#ifdef __LINUX__
    monitor = new linux_cpu_monitor();
#elif __UNIX__
    //return "UNIX:Not Implemented";
#elif __WINDOWS__
    //return "WINDOWS: Not Implemented";
#else
    //return "Not Implemented";
#endif

    hardware_monitor::get_instance()->register_monitors(this);
}

cpu_monitor::~cpu_monitor()
{
    if(NULL != monitor) {
        delete monitor;
        monitor = NULL;
    }
}

char* cpu_monitor::collect_data()
{
//   Prepare appropiate monitor type 
#ifdef __LINUX__
    linux_cpu_monitor *_monitor = dynamic_cast<linux_cpu_monitor*>(monitor);
#endif
    sprintf(output, "CPU: %d", (_monitor)->get_cpu_number());
    return output;
}
