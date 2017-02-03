#ifndef __PROCESS_MONITOR__
#define __PROCESS_MONITOR__

#include "monitor_interface.h"
#include <stdio.h>
#include <iostream>
#include <list>

/*
Singletone class to monitor all processes. Reads process list from a file and keep monitoring it. Reading of file in a
thread
*/

class process_monitor : public monitor_interface
{
    char* name;
    std::list<monitor_interface*> monitor_list;
    static process_monitor* _process_monitor;
    process_monitor(char *);
    bool register_monitors();
public:
    ~process_monitor();
    static process_monitor* get_instance();
    char* collect_data();
};

#endif
