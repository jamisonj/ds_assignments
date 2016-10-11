<?php

//    function quick_sort_split($split_value, $list) {
//
//        $a = 0;
//        $b =
//
//        while ($list[$a] < $split_value) {
//           $new_list[$a] = $list[$a];
//        }
//    }

    function quick_sort($list, $type, $pivot) {

        if ($type == 'integer' || $type == 'float') {
            $left = 1;
            $right = count($list) - 1;

            $pivot = $list[0];

            echo 'pivot: ' . $pivot . '<br>';

            $done = false;

            while(!($done)) {

                while ($list[$left] <= $pivot && $left < $right) {
                    $left++;
                }

                while ($list[$right] >= $pivot && $left < $right) {
                    $right--;
                }

                echo 'left '. $list[$left] . '<br>';
                echo 'right '. $list[$right] . '<br>';

                if ($left >= $right) {
                    $done = true;

                }

                else {
                    $moved = $list[$left];
                    $list[$left] = $list[$right];
                    $list[$right] = $moved;
                }

                echo '<pre>';

                print_r($list);

                echo '</pre>';
            }

            return $list;

        }

        else {
            throw new Exception('Error: The passed in data type is unsupported. This class only supports integers and floats.');
        }

    }
?>