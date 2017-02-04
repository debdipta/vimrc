#ifndef __CPU_MONITOR__
#define __CPU_MONITOR__

#include "monitor_interface.h"
#include "hardware_monitor.h"
#include "linux/linux_cpu_monitor.h"

/* This class is registered to hardware monitor */
class cpu_monitor: public monitor_interface
{
    const char* name;
    char output[2048];
    monitor_interface* monitor;
public:
    cpu_monitor(const char*);
    ~cpu_monitor();
    char* collect_data();
};
#endif
