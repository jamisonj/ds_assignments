<?php

    function selection_sort($list) {

        foreach ($list as $value) {
            $type = gettype($value);

            if ($type === 'object' || $type === 'string' || $type === 'boolean') {
                throw new Exception('Error: This array contains the value ' . $value . ', which is of the type '. $type .'. This type is not permitted.');
            }
        }

        for ($i = (count($list) - 1); $i > 0; $i--) {

            $index = 0;
            $key = 0;
            $greatest = $list[0];

            while ($index < $i) {

                if ($list[$index+1] > $greatest) {
                    $greatest = $list[$index+1];
                    $key = $index+1;
                }

                $index++;
            }

            $moved = $list[$i];
            $list[$i] = $greatest;
            $list[$key] = $moved;
        }

        return $list;
    }
?>