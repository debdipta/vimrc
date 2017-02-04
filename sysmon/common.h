#ifndef __COMMON__
#define __COMMON__


//This is time of resouce monitoring trigger in secs
#define MTIME 10

/*
* What types of monitoring are defined?
*/
#define __CPU__
#define __VIRTMEM__
#define __IO__

enum ERRORNO
{
    DATACOLLECTERROR = 0,
    SERVERCONNECTERR
};


#ifdef _WIN32
//define something for Windows (32-bit and 64-bit, this part is common)
#ifdef _WIN64
//define something for Windows (64-bit only)
#endif
#elif __APPLE__
#include "TargetConditionals.h"
#if TARGET_IPHONE_SIMULATOR
// iOS Simulator
#elif TARGET_OS_IPHONE
// iOS device
#elif TARGET_OS_MAC
// Other kinds of Mac OS
#else
#   error "Unknown Apple platform"
#endif
#elif __linux__
// linux
#define __LINUX__
#elif __unix__ // all unices not caught above
// Unix
#define __UNIX__
#elif defined(_POSIX_VERSION)
// POSIX
#else
#   error "Unknown compiler"
#endif

#endif
