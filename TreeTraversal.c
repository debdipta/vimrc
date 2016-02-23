#include <stdio.h>
#include <stdlib.h>

typedef struct tree
{
    int data;
    struct tree *left;
    struct tree *right;
} *pDataTree, DataTree;

pDataTree create_node(int data)
{
    pDataTree buf = malloc(sizeof(struct tree));
    buf->left = NULL;
    buf->right = NULL;
    buf->data = data;
    return buf;
}

void print_preorder(pDataTree root)
{
    if(root == NULL )
        return;
    printf("%2d -> ", root->data);
    print_preorder(root->left);
    print_preorder(root->right);
}

int main(int argc, char * argv[])
{
    pDataTree root = NULL;
    root = create_node(5);
    root->left = create_node(2);
    root->right = create_node(7);
    root->left->left = create_node(9);
    root->left->left->left = create_node(3);
    root->left->left->right = create_node(4);

    root->right->left = create_node(8);
    root->right->right = create_node(1);
    root->right->right->left = create_node(6);
    
    print_preorder(root);
    printf("NULL\n");
    return 0;
}
