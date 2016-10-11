<?php

    include 'bubble_sort.php';
    include 'insertion_sort.php';
    include 'selection_sort.php';
    include 'quick_sort.php';

    $filenames = array(
        'list1.csv' => 'integer',
//        'list2.csv' => 'integer',
//        'list3.csv' => 'integer',
//        'list4.csv' => 'integer',
//        'list5.csv' => 'float',
//        'list6.csv' => 'integer'
    );

    class Result {

            function __construct($name, $duration, $nums) {
                $this->name = $name;
                $this->duration = $duration;
                $this->nums = $nums;
                $this->relative = NULL;
            }
    }

    /* Main processing */

    $list = array();

    foreach ($filenames as $filename => $type) {

        $handle = fopen($filename, 'r');
        $row = 0;
        $list = array();

        if ($handle !== FALSE) {

            $sublist = array();

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $sublist[$row] = $data[0] + 0;
                $row++;
            }

            $type = gettype($sublist[0]);

            for ($i = 0; $i < 1; $i++) {

                $list[$i] = $sublist;

                if ($type == 'integer') {
                    echo 'Type = integer <br>';
                    $list[$i] = quick_sort($list[$i], 'integer');
                }

                else {
                    echo 'Type = other <br>';
                    $list[$i] = quick_sort($list[$i], 'float');
                }
            }

//            $list = array(4, 3, 6, 7, 10, 63, 90, 54, 20, 46, 19);
//            $list = bubble_sort($list, 'integer');

//            fclose($handle);

            echo '<pre>';
            print_r($list);
            echo '</pre>';

        }
    }

//    $new_list = quick_sort($list, $type);
?>