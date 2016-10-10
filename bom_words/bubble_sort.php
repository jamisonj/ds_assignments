<?php

    function bubble_sort($list, $type, ...$properties) {

//        foreach ($list as $value) {
//            $type = gettype($value);
//
//            if ($type === 'string' || $type === 'boolean') {
//                throw new Exception('Error: This array contains the value ' . $value . ', which is of the type '. $type .'. This type is not permitted.');
//            }
//        }

        $j = 0;

        while ($j < count($list)) {
            $j++;

            if ($type == 'object') {

                $p = 0;

                foreach ($properties as $property) {

                    // If this $property is the first one.
                    if ($property == $properties[0]) {

                        for ($i = 0; $i < count($list) - $j; $i++) {

                            if ($list[$i+1]->{$property} > $list[$i]->{$property}){
                                $moved = $list[$i];
                                $list[$i] = $list[$i+1];
                                $list[$i+1] = $moved;
                            }
                        }
                    }

                    else {
                        for ($i = 0; $i < count($list) - $j; $i++) {

                            if ($list[$i+1]->{$properties[$p-1]} == $list[$i]->{$properties[$p-1]}) {
                                if ($list[$i+1]->{$property} < $list[$i]->{$property}){
                                    $moved = $list[$i];
                                    $list[$i] = $list[$i+1];
                                    $list[$i+1] = $moved;
                                }
                            }
                        }
                    }

                    $p++;
                }
            }

            else {
                for ($i = 0; $i < count($list) - $j; $i++) {

                    if ($list[$i+1] > $list[$i]){
                        $moved = $list[$i];
                        $list[$i] = $list[$i+1];
                        $list[$i+1] = $moved;
                    }
                }
            }


        }

        return $list;
    }

?>