<?php

    function selection_sort($list, $type, ...$properties) {

        $p = 0;

        if ($type == 'object') {
            foreach ($properties as $property) {

                // If this $property is the first one.
                if ($property == $properties[0]) {

                    for ($i = (count($list) - 1); $i > 0; $i--) {

                        $greatest = $list[0];
                        $key = 0;
                        $index = 0;

                        while ($index < $i) {

//                              echo 'Properties: ' . $list[$index + 1]->{$property} . ' and ' . $greatest->{$property} . '<br>';

                            if ($list[$index + 1]->{$property} > $greatest->{$property}) {
                                $greatest = $list[$index + 1];
                                $key = $index + 1;
//                                echo 'Index: ' . $index . '<br>';
//                                echo 'New greatest: ' . $greatest->word . '<br>';
//                                echo 'Key: ' . $key . '<br>';
                            }

                            $index++;
                        }

                        $moved = $list[$i];
                        $list[$i] = $greatest;
                        $list[$key] = $moved;
//                          echo 'Compared ' . $moved->word . ' and ' . $list[$i]->word . '. <br>';
                    }
                }

                // Otherwise, sort only within the categories of the previous sort.
                else {

                    echo "Not first <br>";

//                    $index = 0;
//                    $greatest = 0;
//                    $top = $index;

                    // Get the top value to switch with.
//                    while ($list[$index]->{$properties[$p - 1]} == $greatest->{$properties[$p - 1]}) {
//
//                        echo 'getting here';
//
//                        if ($list[$index + 1]->{$property} > $greatest->{$property}) {
//                            $top = $index + 1;
//
//                            $greatest = $list[0];
//                            $key = 0;
//                            $k = 0;
//
//                            for ($i = $top; $i > 0; $i--) {
//
//                                while ($k < $i) {
//                                    if ($list[$k + 1]->{$properties[$p - 1]} == $greatest->{$properties[$p - 1]}) {
//
//                                        echo 'Properties: ' . $list[$k + 1]->{$properties[$p - 1]} . ' and ' . $greatest->{$properties[$p - 1]} . '<br>';
//                                        if ($list[$k + 1]->{$property} > $greatest->{$property}) {
//
//                                            $j = $k + 1;
//                                            $greatest = $list[$k + 1];
//                                            $key = $k + 1;
//                                            echo 'New greatest: ' . $greatest->{$property} . '<br>';
//                                            echo '$j: ' . $j . '<br>';
//                                            echo 'Greatest ' . $greatest->{$property} . ' swapped with ' . $list[$i]->{$property} . '. <br>';
//                                        }
//                                    }
//
//                                    $k++;
//                                }
//                            }
//                        }
//
//                        $index++;
//                    }

                    $topcount = 0;

                    while ($topcount < count($list) - 1) {
                        if ($list[$topcount+1]->{$properties[$p-1]} == $list[$topcount]->{$properties[$p-1]}){
                            $topcount++;
                            echo $topcount . ' equal <br>';
                        }

                        else {

                            $bottomcount = 0;

                            for ($i = $topcount; $i > 0; $i--) {

                                $greatest = $list[0];
                                $key = 0;
                                $index = 0;

                                while ($index < $i) {

//                            echo 'Index: ' . $index . '<br>';

                                    if ($list[$index + 1]->{$properties[$p - 1]} == $greatest->{$properties[$p - 1]}) {

//                                        echo 'Properties: ' . $list[$index + 1]->{$properties[$p - 1]} . ' and ' . $greatest->{$properties[$p - 1]} . '<br>';
                                        if ($list[$index + 1]->{$property} > $greatest->{$property}) {

                                            $greatest = $list[$index + 1];
                                            $key = $index + 1;
                                            echo 'New greatest: ' . $greatest->{$property} . '<br>';
//                                            echo '$j: ' . $j . '<br>';

                                        }
                                    }

                                    $index++;
                                }

                                $moved = $list[$index + 1];
                                $list[$index + 1] = $greatest;
                                $list[$key] = $moved;
                                $bottomcount = $topcount;
                                echo 'Greatest ' . $greatest->{$property} . ' swapped with ' . $list[$i]->{$property} . '. <br>';
//                                $topcount++;
                            }

//                            $topcount++;

                        }
                    }
                }

                print_r($list);

                echo 'property ' . $p . '<br>';
                $p++;
            }
        }

        else {

            for ($i = (count($list) - 1); $i > 0; $i--) {

                $greatest = $list[0];
                $index = 0;
                $key = 0;

                while ($index < $i) {

                    if ($list[$index + 1] < $greatest) {
                        $greatest = $list[$index + 1];
                        $key = $index + 1;
                    }

                    $index++;
                }

                $moved = $list[$i];
                $list[$i] = $greatest;
                $list[$key] = $moved;
            }
        }

        return $list;
    }
?>