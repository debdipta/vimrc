/* 
 * http://www.geeksforgeeks.org/check-for-children-sum-property-in-a-binary-tree/
 * For every node, data value must be equal to sum of data values in left and right children. Consider data value as 0
 * for NULL children.
*/

#include <stdio.h>
#include <stdlib.h>

class mytree;

class mytree  {
public:
    int data;
    mytree* left;
    mytree* right;
    mytree(int _data): data(_data), left(NULL), right(NULL) { }
} *pMytree;

// Return true if childrens sum equal to root
// Else return false
bool checksum(mytree *node)
{
    bool bret = true;
    if(NULL == node || (NULL == node->left && NULL == node->right))
        return bret;

    if(NULL != node->left && NULL != node->right)
        if((node->left->data + node->right->data) != node->data)
            bret = false;
    if(NULL == node->left && NULL != node->right)
        if((node->right->data) != node->data)
            bret = false;
    if(NULL != node->left && NULL == node->right)
        if((node->left->data) != node->data)
            bret = false;
    if(checksum(node->left) &&  checksum(node->right))
        return bret;
}

int main(int argc, char* argv[])
{
    mytree *tree = NULL;
    tree = new mytree(10);
    tree->left = new mytree(8);
    tree->right = new mytree(2);
    tree->left->left = new mytree(3);
    tree->left->right = new mytree(5);
    tree->right->left = new mytree(2);

    if (checksum(tree))
        printf("For every node, data value equal to sum of data values in left and right children\n");
    else    
        printf("For every node, sun is DIFFERENT"); 

    printf("Creating tree...\n");

    return 0;
}
