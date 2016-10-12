<?php

    /*
     * For this, you can use something like get_attr($object, $attribute_string); to get the value of the object attribute you need.
     * Then you can just use a check for that within your function, without re-writing the function all over again!
     * Thanks to John for this tip!
     */

    function insertion_sort($list, $type, ...$properties) {

        $new_list = array();
        $i = 0;

        while (count($list) > 0) {

            $new_list[$i] = $list[$i];

            for ($j = count($new_list) - 1; $j > 0; $j--) {

                $p = 0;

                if ($type == 'object') {
                    foreach ($properties as $property) {

                        $prop_type = gettype($property);

                        // If this $property is the first one.
                        if ($property == $properties[0]){

                            if ($prop_type = 'string'){
                                if ($new_list[$j]->{$property} > $new_list[$j - 1]->{$property}) {
                                    $moved = $new_list[$j];
                                    $new_list[$j] = $new_list[$j - 1];
                                    $new_list[$j - 1] = $moved;
                                }
                            }

                            else {
                                if ($new_list[$j]->{$property} < $new_list[$j - 1]->{$property}) {
                                    $moved = $new_list[$j];
                                    $new_list[$j] = $new_list[$j - 1];
                                    $new_list[$j - 1] = $moved;
                                }
                            }

                        }

                        // Otherwise, sort only within the categories of the previous sort.
                        else {
                            if ($new_list[$j]->{$properties[$p-1]} == $new_list[$j - 1]->{$properties[$p-1]}){
                                if ($prop_type = 'string') {
                                    if ($new_list[$j]->{$property} < $new_list[$j - 1]->{$property}) {
                                        $moved = $new_list[$j];
                                        $new_list[$j] = $new_list[$j - 1];
                                        $new_list[$j - 1] = $moved;
                                    }
                                }

                                else {
                                    if ($new_list[$j]->{$property} > $new_list[$j - 1]->{$property}) {
                                        $moved = $new_list[$j];
                                        $new_list[$j] = $new_list[$j - 1];
                                        $new_list[$j - 1] = $moved;
                                    }
                                }
                            }
                        }

                        $p++;
                    }
                }

                else {
                    if ($new_list[$j] < $new_list[$j - 1]) {
                        $moved = $new_list[$j];
                        $new_list[$j] = $new_list[$j - 1];
                        $new_list[$j - 1] = $moved;
                    }
                }
            }

            unset($list[$i]);
            $i++;
        }

        return $new_list;
    }
?>