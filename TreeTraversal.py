

class tree(object):
    def __init__(self, data):
        self.left = None
        self.right = None
        self.data = data

class traverse(object):
    def __init__(self):
        print "Calling contructor"

    def pre_order(self, root):
        if root:
            print "%2d -> ",  root.data
            self.pre_order(root.left)
            self.pre_order(root.right)

    def post_order(self, root):
        if root == None:
            return
        self.post_order( root.left)
        self.post_order( root.right)
        print "%2d -> ",  root.data
    
    def in_order(self, root):
        if root == None:
            return
        self.in_order( root.left)
        print "%2d -> ",  root.data
        self.in_order( root.right)
#Main starts from here

# creating the tree
root = tree(5)
root.left = tree(2)
root.right = tree(7)
root.left.left = tree(9)
root.left.left.right = tree(4)
root.left.left.left = tree(3)
root.right.left = tree(8)
root.right.right = tree(1)
root.right.right.left = tree(6)

func__ = traverse()
print "Printing pre order"
func__.pre_order(root)
print "Printing post order"
func__.post_order(root)
print "Printing in order"
func__.in_order(root)
