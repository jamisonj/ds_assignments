<?php

    function quick_sort($list, $type, $pivot) {

        if ($type == 'integer' || $type == 'float') {

            $new_list = array();

            if (count($list) <= 1) {
                return $list;
            }

            else {
                $left = 1;
                $right = count($list) - 1;

                $done = false;

                while(!($done)) {

                    while (@($list[$left]) <= $pivot && $left <= $right) {
                        $left++;
                    }

                    while (@($list[$right]) >= $pivot && $left <= $right) {
                        $right--;
                    }

                    if ($left > $right) {

                        $done = true;

                        $moved = $list[0];
                        $list[0] = $list[$right];
                        $list[$right] = $moved;
                    }

                    else {
                        $moved = $list[$left];
                        $list[$left] = $list[$right];
                        $list[$right] = $moved;
                    }
                }

                if ($right >= 0 && $left <= count($list)) {

                    // Split the lists and call the function again.
                    $array1 = array_slice($list, 0, $right);
                    $array2 = array_slice($list, $left);

                    $listA = array();
                    $listB = array();

                    if (!(empty($array1))){
                        $listA = quick_sort($array1, $type, $array1[0]);
                    }

                    if (!(empty($array2))) {
                        $listB = quick_sort($array2, $type, $array2[0]);
                    }

                    $new_list = $listA;
                    $new_list[$right] = $pivot;
                    $new_list = array_merge($new_list, $listB);
                }

                return $new_list;
            }
        }

        else {
            throw new Exception('Error: The passed in data type is unsupported. This class only supports integers and floats.');
        }

    }
?>