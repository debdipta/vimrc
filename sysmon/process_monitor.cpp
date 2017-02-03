#include "process_monitor.h"

process_monitor* process_monitor::_process_monitor = NULL;

process_monitor::process_monitor(char* _name)
{
    name = _name;
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


const char* process_monitor::collect_data()
{
    return "Mem: 2340K\n";
}

bool process_monitor::register_monitors( monitor_interface* _process)
{
    monitor_list.push_back(_process);
    return true;
}
