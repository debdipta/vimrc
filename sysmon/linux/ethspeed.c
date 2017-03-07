#define _GNU_SOURCE     /* To get defns of NI_MAXSERV and NI_MAXHOST */
#include <arpa/inet.h>
#include <sys/socket.h>
#include <netdb.h>
#include <ifaddrs.h>
#include <stdio.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <linux/if_link.h>

typedef unsigned long LINT_t;
typedef unsigned int UINT_t;

typedef struct RxTx
{
    char ifa_name[256];
    LINT_t tx_packets;
    LINT_t rx_packets;
    LINT_t tx_bytes;
    LINT_t rx_bytes;
    struct RxTx* next;
} RxTx;

static void get_net_details(struct RxTx** net_info)
{
    struct ifaddrs *ifaddr, *ifa;
    int family, s, n;
    char host[NI_MAXHOST];
    struct RxTx* more_info;
    struct RxTx* next = NULL;

    if (getifaddrs(&ifaddr) == -1) {
        perror("getifaddrs");
        exit(EXIT_FAILURE);
    }
    for (ifa = ifaddr, n = 0; ifa != NULL; ifa = ifa->ifa_next, n++) {
        if (ifa->ifa_addr == NULL)
            continue;
        family = ifa->ifa_addr->sa_family;

        if (family == AF_PACKET && ifa->ifa_data != NULL)
        {
            more_info = malloc(sizeof(struct RxTx));
            memset(more_info, 0, sizeof(struct RxTx));
            more_info->next = NULL;
            struct rtnl_link_stats *stats = ifa->ifa_data; 
            //printf("%s:", ifa->ifa_name);
            strncpy(more_info->ifa_name, ifa->ifa_name, 256);
            //printf("\t\ttx_packets = %10u; rx_packets = %10u\n" "\t\ttx_bytes = %10u; rx_bytes = %10u\n", stats->tx_packets, stats->rx_packets, stats->tx_bytes, stats->rx_bytes);
            more_info->tx_packets = stats->tx_packets;
            more_info->rx_packets = stats->rx_packets;
            more_info->tx_bytes = stats->tx_bytes;
            more_info->rx_bytes = stats->rx_bytes;
            if(NULL == *net_info)  {
                *net_info = more_info;
            }  else
                next->next = more_info;
            next = more_info;
        }

    }

    freeifaddrs(ifaddr);
}

void printall(struct RxTx** net_info)
{
    LINT_t tot_pkt_tx_frme = 0, tot_pkt_rx_frme=0;
    LINT_t tot_bytes_tx_frme = 0, tot_bytes_rx_frme = 0; 
    static LINT_t tx_packets_sav=0, rx_packets_sav=0, tx_bytes_sav=0, rx_bytes_sav=0;

    while(NULL != *net_info)   {
        //printf("%s:\ttx_packets: %-10lu rx_packets: %-10lu tx_bytes: %-10lu rx_bytes: %-10lu\n", (*net_info)->ifa_name, (*net_info)->tx_packets, (*net_info)->rx_packets, (*net_info)->tx_bytes,  (*net_info)->rx_bytes);

        tot_pkt_tx_frme += (*net_info)->tx_packets; 
        tot_pkt_rx_frme += (*net_info)->rx_packets;
        tot_bytes_tx_frme += (*net_info)->tx_bytes;
        tot_bytes_rx_frme += (*net_info)->rx_bytes;

        (*net_info) = (*net_info)->next;
    }
    tx_packets_sav = abs(tx_packets_sav - tot_pkt_tx_frme);
    rx_packets_sav = abs(rx_packets_sav - tot_pkt_rx_frme);
    tx_bytes_sav = abs(tx_bytes_sav - tot_bytes_tx_frme);
    rx_bytes_sav = abs(rx_bytes_sav - tot_bytes_rx_frme);
    printf("new_pkt_tx: %-10lu\tnew_rx_packets_sav: %-10lu\ttx_bytes_sav: %-10lu\trx_packets_sav: %-10lu\t\n",
    tx_packets_sav, rx_packets_sav,tx_bytes_sav,rx_bytes_sav);
    tx_packets_sav = tot_pkt_tx_frme;
    rx_packets_sav = tot_pkt_rx_frme;
    tx_bytes_sav = tot_bytes_tx_frme;
    rx_bytes_sav = tot_bytes_rx_frme;
}

/* Function to delete the entire linked list */
void deleteList(struct RxTx** head_ref)
{
    /* deref head_ref to get the real head */
    struct RxTx* current = *head_ref;
    struct RxTx* next;
    while (current != NULL) 
    {
        next = current->next;
        free(current);
        current = next;
    }

    /* deref head_ref to affect the real head back
       in the caller. */
    *head_ref = NULL;
}

/*
 returns a linked list of RxTx, each node have data for each interface
*/
int main(int argc, char *argv[])
{
    static struct RxTx* net_info = NULL;
    while(1)    {
        get_net_details(&net_info);
        printall(&net_info);
        sleep(1);
        deleteList(&net_info);
        net_info = NULL;
        sleep(3);
    }
    return 0; 

    /* Walk through linked list, maintaining head pointer so we
       can free list later */

    /*for (ifa = ifaddr, n = 0; ifa != NULL; ifa = ifa->ifa_next, n++) {
        if (ifa->ifa_addr == NULL)
            continue;

        family = ifa->ifa_addr->sa_family;

        printf("%-8s %s (%d)\n", ifa->ifa_name, (family == AF_PACKET) ?  "AF_PACKET" : (family == AF_INET) ?  "AF_INET" : (family == AF_INET6) ?  "AF_INET6" : "???", family);

        if (family == AF_INET || family == AF_INET6) {
            s = getnameinfo(ifa->ifa_addr, (family == AF_INET) ?  
                                sizeof(struct sockaddr_in) : 
                                sizeof(struct sockaddr_in6), host, NI_MAXHOST, NULL, 0, NI_NUMERICHOST);
            if (s != 0) {
                printf("getnameinfo() failed: %s\n", gai_strerror(s));
                exit(EXIT_FAILURE);
            }

            printf("\t\taddress: <%s>\n", host); 
        }
        else
            if (family == AF_PACKET && ifa->ifa_data != NULL)
            {
                struct rtnl_link_stats *stats = ifa->ifa_data; 
                printf("\t\ttx_packets = %10u; rx_packets = %10u\n" "\t\ttx_bytes = %10u; rx_bytes = %10u\n", stats->tx_packets, stats->rx_packets, stats->tx_bytes, stats->rx_bytes);
            }
    } */
}
