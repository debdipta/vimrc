#ifndef __CPU_MONITOR__
#define __CPU_MONITOR__

#include "monitor_interface.h"
#include "hardware_monitor.h"
#include "linux/linux_cpu_monitor.h"
#include <string>
#include <iostream>

/* This class is registered to hardware monitor */
class cpu_monitor: public monitor_interface
{
    const char* name;
    std::string format;
    std::string header;
    std::string footer;
    monitor_interface* monitor;
public:
    cpu_monitor(const char*);
    ~cpu_monitor();
    const char* collect_data();
};
#endif
