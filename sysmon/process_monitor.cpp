#include "process_monitor.h"

process_monitor* process_monitor::_process_monitor = NULL;

process_monitor::process_monitor(char* _name)
{
    name = _name;
    register_monitors();
}

process_monitor::~process_monitor()
{
}

process_monitor* process_monitor::get_instance()
{
    if( NULL == _process_monitor)
        _process_monitor = new process_monitor("process_monitor");
    return _process_monitor;        
}


char* process_monitor::collect_data()
{
    return "Mem: 2340K";
}

bool process_monitor::register_monitors()
{
//TODO: Read file and register processes for monitoring here
}
