#include "linux_cpu_monitor.h"
#include <stdio.h>
#include <string.h>
#include <iostream>
#include <ctype.h>
#include <sstream>
#include <fstream>


#define _PATH_PROC_CPUINFO  "/proc/cpuinfo"

linux_cpu_monitor::linux_cpu_monitor()
{

}

linux_cpu_monitor::~linux_cpu_monitor()
{

}


float get_cpu_clock_speed ()
{
    /*FILE* fp;
      char buffer[1024];
      size_t bytes_read;
    char* match;
    float clock_speed;
    fp = fopen (“/proc/cpuinfo”, “r”);
    bytes_read = fread (buffer, 1, sizeof (buffer), fp);
    fclose (fp);
    if (bytes_read == 0 || bytes_read == sizeof (buffer))
        return 0;
        buffer[bytes_read] = ‘\0’;
        match = strstr (buffer, “cpu MHz”);
        if (match == NULL)
            return 0;
        sscanf (match, “cpu MHz : %f”, &clock_speed);
        return clock_speed;*/
}

/*Reads /proc file system for number of cpu
stack@stack:/opt/stack$ cat /proc/cpuinfo | grep -i processor
processor       : 0
processor       : 1
processor       : 2
processor       : 3
*/

int linux_cpu_monitor::get_cpu_number()
{
    int number_of_cpu = 0;
    std::ifstream input( _PATH_PROC_CPUINFO );
    std::string line;
    while (std::getline(input, line))  {
        if(NULL != strstr(line.c_str(), "processor"))    {
            number_of_cpu++;
        }
    }

    return number_of_cpu;
}

const char* linux_cpu_monitor::collect_data()
{
    return "";
}
