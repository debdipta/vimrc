#ifndef __CPU_MONITOR__
#define __CPU_MONITOR__

#include "monitor_interface.h"
#include "hardware_monitor.h"

/* This class is registered to hardware monitor */
class cpu_monitor: public monitor_interface
{
    const char* name;
public:
    cpu_monitor(const char*);
    ~cpu_monitor();
    char* collect_data();
    bool update_data( char* );
};
#endif
