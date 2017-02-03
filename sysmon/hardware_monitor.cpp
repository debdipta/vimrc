#include <iostream>
#include <list>
#include "hardware_monitor.h"
#include <stdio.h>
#include <string.h>

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
    if (NULL != _hardware_monitor)  {
        delete _hardware_monitor;
        _hardware_monitor = NULL;
    }
}

bool hardware_monitor::register_monitors( monitor_interface* _monitor) 
{
    monitor_list.push_back(_monitor);
    return true;
}

const char* hardware_monitor::get_update()
{
    std::list<monitor_interface*>::iterator _monitor;
    std::string _hardware_update = "";
    for( _monitor = monitor_list.begin();_monitor != monitor_list.end(); _monitor++)    {
       _hardware_update += (*_monitor)->collect_data();
    }
    return _hardware_update.c_str();
}

const char* hardware_monitor::collect_data()
{
    return get_update();
}
