#ifndef __HARDWARE_MONITOR__
#define __HARDWARE_MONITOR__

#include <iostream>
#include <list>
#include "monitor_interface.h"

/*
* class hardware_monitor maintains a list of monitor objects alike cpu monitor, io monitor, network monitor. When asked,
it calls all objects for updated information, and send back to caller
*/

class hardware_monitor
{
    const char* name;
    std::list<monitor_interface*> monitor_list;
    static hardware_monitor* _hardware_monitor; 
    hardware_monitor( const char* );
protected:
public:
    ~hardware_monitor();
    static hardware_monitor* get_instance();
    bool register_monitors();
    bool get_update();
};

#endif
