#include "cpu_monitor.h"
#include <stdio.h>
#include <iostream>
#include <string.h>
#include <stdlib.h>

cpu_monitor::cpu_monitor(const char* _name)
{
    name = _name;
    header = "<cpu_details>";
    footer = "</cpu_details>";
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

const char* cpu_monitor::collect_data()
{
    char output[2048];
    format.clear();
    format += header;
//   Prepare appropiate monitor type 
#ifdef __LINUX__
    linux_cpu_monitor *_monitor = dynamic_cast<linux_cpu_monitor*>(monitor);
#endif
    sprintf(output, "<cpu_number>%d</cpu_number>", (_monitor)->get_cpu_number());

   format += output; 

   format += footer;
    
    
    
    
    
    return format.c_str();
}
