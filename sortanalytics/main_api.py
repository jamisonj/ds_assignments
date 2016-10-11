#!/usr/bin/env python3

FILENAMES = [
    [ 'list1.txt', 'int'   ], 
    [ 'list2.txt', 'int'   ], 
    [ 'list3.txt', 'int'   ], 
    [ 'list4.txt', 'int'   ], 
    [ 'list5.txt', 'float' ], 
    [ 'list6.txt', 'int'   ], 
]

        
class Result:
    def __init__(self, name, duration, nums):
        self.name = name
        self.duration = duration
        self.nums = nums
        self.relative = None
        
        
def main():
    pass        
        
        
### Main runner ###
if __name__ == '__main__':
    main()