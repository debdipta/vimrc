#include "collector.h"
#include "common.h"

collector::collector()
{
#ifdef MTIME
    timer = MTIME;
#else
    timer = 60;
#endif
}

collector::~collector()
{

}
