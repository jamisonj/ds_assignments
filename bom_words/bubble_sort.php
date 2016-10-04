<?php

    function bubble_sort($list) {

        foreach ($list as $value) {
            $type = gettype($value);

            if ($type === 'object' || $type === 'string' || $type === 'boolean') {
                throw new Exception('Error: This array contains the value ' . $value . ', which is of the type '. $type .'. This type is not permitted.');
            }
        }

        $j = 0;

        while ($j < count($list)) {
            $j++;

            for ($i = 0; $i < count($list) - $j; $i++) {

                if ($list[$i+1] < $list[$i]){
                    $moved = $list[$i];
                    $list[$i] = $list[$i+1];
                    $list[$i+1] = $moved;
                }
            }
        }

        return $list;
    }

?>