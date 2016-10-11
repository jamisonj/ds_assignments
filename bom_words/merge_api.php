<?php
    // Merges two sorted lists into a new, sorted list. The new list is sorted by percent, count, alpha.
    function merge_lists($listA, $listB) {

        $new_list = array();

        if (empty($listA)) {
            $new_list = $listB;
        }

        else {
            $a = 0;
            $b = 0;

            for ($c = 0; $c < (count($listA) + count($listB)); $c++) {

                if ($a > count($listA) - 1 || $b > count($listB) - 1) {

                    if ($a > count($listA) - 1) {
                        $new_list[$c] = $listB[$b];
                        $b++;
                    }

                    elseif ($b > count($listB) - 1) {
                        $new_list[$c] = $listA[$a];
                        $a++;
                    }
                }

                else {
                    if ($listB[$b]->percent == $listA[$a]->percent) {

                        if ($listB[$b]->count == $listA[$a]->count) {

                            if ($listB[$b]->word < $listA[$a]->word) {
                                $new_list[$c] = $listB[$b];
                                $b++;
                            }

                            elseif ($listB[$b]->word > $listA[$a]->word) {
                                $new_list[$c] = $listA[$a];
                                $a++;
                            }

                            else {
                                $new_list[$c] = $listA[$a];
                                $a++;
                                $c++;
                                $new_list[$c] = $listB[$b];
                                $b++;
                            }
                        }

                        elseif ($listB[$b]->count > $listA[$a]->count) {
                            $new_list[$c] = $listB[$b];
                            $b++;
                        }

                        elseif ($listB[$b]->count < $listA[$a]->count) {
                            $new_list[$c] = $listA[$a];
                            $a++;
                        }
                    }

                    elseif ($listB[$b]->percent > $listA[$a]->percent) {
                        $new_list[$c] = $listB[$b];
                        $b++;
                    }

                    elseif ($listB[$b]->percent < $listA[$a]->percent) {
                        $new_list[$c] = $listA[$a];
                        $a++;
                    }
                }
            }
        }

        return $new_list;
    }
?>
