<?php

    function insertion_sort($list) {

        foreach ($list as $value) {
            $type = gettype($value);

            if ($type === 'object' || $type === 'string' || $type === 'boolean') {
                throw new Exception('Error: This array contains the value ' . $value . ', which is of the type '. $type .'. This type is not permitted.');
            }
        }

        $count = count($list);
        $new_list = array();

        for ($i = 0; $i < $count - 1; $i++) {

            echo 'Old list: <br>';
            print_r($list);

            if ($list[$i+1] < $list[$i]) {
                $moved = $list[$i];
                $list[$i] = $list[$i+1];
                $list[$i+1] = $moved;
            }

            $new_list[$i] = $list[$i];

//            if ($i = ($count - 1)) {
//                $new_list[$i+1] = $list[$i+1];
//            }

            //TODO: Figure out how to get the last value added!

            echo 'New List: <br>';
            print_r($new_list);

            for ($j = count($new_list) - 1; $j > 0; $j--) {

                if ($new_list[$j] < $new_list[$j-1]) {
//                    echo 'Swap ' . $new_list[$j] . ' and ' . $new_list[$j-1] . '<br>';
                    $moved = $new_list[$j];
                    $new_list[$j] = $new_list[$j-1];
                    $new_list[$j-1] = $moved;
                }
            }
//            array_splice($list, 0, 1);

        }

//        }

//        print_r($new_list);

        return $new_list;
    }
?>