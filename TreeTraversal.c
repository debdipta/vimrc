#include <stdio.h>
#include <stdlib.h>

typedef struct tree
{
    int data;
    struct tree *left;
    struct tree *right;
} *pDataTree, DataTree;

pDataTree getNode(int data)
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

void in_preorder(pDataTree root)
{
    if(root == NULL )
        return;
    print_preorder(root->left);
    printf("%2d -> ", root->data);
    print_preorder(root->right);
}

void post_preorder(pDataTree root)
{
    if(root == NULL )
        return;
    print_preorder(root->left);
    print_preorder(root->right);
    printf("%2d -> ", root->data);
}
void Create_Node(pDataTree *root)
{
    *root = getNode(5);
    (*root)->left = getNode(2);
    (*root)->right = getNode(7);
    (*root)->left->left = getNode(9);
    (*root)->left->left->left = getNode(3);
    (*root)->left->left->right = getNode(4);

    (*root)->right->left = getNode(8);
    (*root)->right->right = getNode(1);
    (*root)->right->right->left = getNode(6);
}

int main(int argc, char * argv[])
{
    pDataTree root = NULL;
    Create_Node(&root); 
    printf("Printing Preorder\n");
    print_preorder(root);
    printf("Printing Inorder\n");
    in_preorder(root);
    printf("Printing PostOrder\n");
    post_preorder(root);
    printf("NULL\n");
    return 0;
}
