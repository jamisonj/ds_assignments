<?php

    function selection_sort($list, ...$properties) {

//        foreach ($list as $value) {
//            $type = gettype($value);
//
//            if ($type === 'string' || $type === 'boolean') {
//                throw new Exception('Error: This array contains the value ' . $value . ', which is of the type '. $type .'. This type is not permitted.');
//            }
//        }

        $p = 0;

        foreach ($properties as $property) {

            print_r($list);

            echo $property . '<br>';

            for ($i = (count($list) - 1); $i > 0; $i--) {

                // If this $property is the first one.
                if ($property == $properties[0]) {

                    $greatest = $list[0];
                    $index = 0;
                    $key = 0;

                    while ($index < $i) {

//                        echo 'Properties: ' . $list[$index + 1]->{$property} . ' and ' . $greatest->{$property} . '<br>';

                        if ($list[$index + 1]->{$property} > $greatest->{$property}) {
                            $greatest = $list[$index + 1];
                            $key = $index + 1;
                            echo 'Index: ' . $index . '<br>';
                            echo 'New greatest: ' . $greatest->word . '<br>';
                            echo 'Key: ' . $key . '<br>';
                        }

                        $index++;
                    }

                    $moved = $list[$i];
                    $list[$i] = $greatest;
                    $list[$key] = $moved;
                    echo 'Compared ' . $moved->word . ' and ' . $list[$i]->word . '. <br>';

                }

                // Otherwise, sort only within the categories of the previous sort.
                else {

                    $greatest = $list[0];
                    $index = 0;
                    $key = 0;

                    while ($index < $i) {

                        // TODO: Add another loop to increase $i.

                        if ($list[$index + 1]->{$properties[$p - 1]} == $greatest->{$properties[$p - 1]}) {

                            echo 'Properties: ' . $list[$index + 1]->{$properties[$p-1]} . ' and ' . $greatest->{$properties[$p-1]} . '<br>';
                            if ($list[$index + 1]->{$property} > $greatest->{$property}) {
                                $greatest = $list[$index + 1];
                                $key = $index + 1;
                                echo 'Index: ' . $index . '<br>';
                                echo 'New greatest: ' . $greatest->word . '<br>';
                                echo 'Key: ' . $key . '<br>';
                            }
                        }

                        $index++;
                    }

                    $moved = $list[$i];
                    $list[$i] = $greatest;
                    $list[$key] = $moved;
                    echo 'Greatest ' . $greatest->word . ' swapped with ' . $moved->word . '. <br>';
                }

            }

            $p++;
        }

        return $list;
    }
?>