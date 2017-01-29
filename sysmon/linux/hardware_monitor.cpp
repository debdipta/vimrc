#include <iostream>
#include <list>
#include "hardware_monitor.h"
#include "cpu_monitor.h"
#include "io_monitor.h"
#include <stdio.h>

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
    register_monitors();
}

hardware_monitor::~hardware_monitor()
{
    if (NULL != _hardware_monitor)  {
        delete _hardware_monitor;
        _hardware_monitor = NULL;
    }
}

bool hardware_monitor::register_monitors() 
{
    monitor_list.push_back(new cpu_monitor("CPU"));
    monitor_list.push_back(new io_monitor("IO"));
    return true;
}

char* hardware_monitor::get_update()
{
    std::list<monitor_interface*>::iterator _monitor;
    for( _monitor = monitor_list.begin();_monitor != monitor_list.end(); _monitor++)    {
       return (*_monitor)->collect_data();
    }
}

char* hardware_monitor::collect_data()
{
    return get_update();
}
