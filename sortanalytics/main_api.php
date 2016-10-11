<?php
    $filenames = array(
        'list1.txt' => 'int',
        'list2.txt' => 'int',
        'list3.txt' => 'int',
        'list4.txt' => 'int',
        'list5.txt' => 'float',
        'list6.txt' => 'int'
    );

    class Result {

            function __construct($name, $duration, $nums) {
                $this->name = $name;
                $this->duration = $duration;
                $this->nums = $nums;
                $this->relative = NULL;
            }

//            function main() {
//
//            }
    }
?>