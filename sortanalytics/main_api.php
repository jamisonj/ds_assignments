<?php

    include '../bom_words/bubble_sort.php';
    include '../bom_words/insertion_sort.php';
    include '../bom_words/selection_sort.php';
    include 'quick_sort.php';

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

    /* Main processing */
    foreach ($filenames as $filename => $type) {
        //Run each sort function.
    }
?>