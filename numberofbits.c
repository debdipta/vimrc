#include <stdio.h>
 
int numbits(unsigned long num)
{   
    unsigned int count = 0;
    while(num > 0)  {
        count = count + (num & 1);
        num = num >> 1;
    }
    return count;
}

int numofbitsalgo(unsigned long num)
{
    unsigned int count = 0;
    while(num > 0)  {
        num = (num & (num-1));
        count ++;
    }
    return count;
}

int main(int argc, char* argv[])
{
    unsigned long num = 12354213;
    printf("Number of bits=%d\n", numbits(num));
    printf("Number of bits=%d\n", numofbitsalgo(num));
    printf("Number of bits=%d\n", numofbitsalgo(num));
    return 0;
}
