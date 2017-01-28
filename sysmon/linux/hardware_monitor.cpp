#include <iostream>
#include <list>
#include "hardware_monitor.h"
#include "cpu_monitor.h"
#include "io_monitor.h"

hardware_monitor* hardware_monitor::_hardware_monitor = NULL;
hardware_monitor* hardware_monitor::get_instance()
{
    if (NULL == _hardware_monitor)
        _hardware_monitor =  new hardware_monitor("hardware Monitor");
    return _hardware_monitor;        
}

hardware_monitor::hardware_monitor( const char* _name)
{
    name = _name;
}

hardware_monitor::~hardware_monitor()
{

}

bool hardware_monitor::register_monitors() 
{
    monitor_list.push_back(new cpu_monitor("CPU"));
    monitor_list.push_back(new io_monitor("IO"));
    return true;
}
