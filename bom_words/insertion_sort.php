<?php

    function insertion_sort($list) {

        foreach ($list as $value) {
            $type = gettype($value);

            if ($type === 'string' || $type === 'boolean') {
                throw new Exception('Error: This array contains the value ' . $value . ', which is of the type '. $type .'. This type is not permitted.');
            }
        }

        $new_list = array();
        $i = 0;

        while (count($list) > 0) {

            $new_list[$i] = $list[$i];
            unset($list[$i]);

            for ($j = count($new_list) - 1; $j > 0; $j--) {

                if ($new_list[$j] < $new_list[$j-1]) {
                    $moved = $new_list[$j];
                    $new_list[$j] = $new_list[$j-1];
                    $new_list[$j-1] = $moved;
                }
            }

            $i++;
        }

        return $new_list;
    }
?>