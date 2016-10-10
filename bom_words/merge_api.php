<?php
    // Merges two sorted lists into a new, sorted list. The new list is sorted by percent, count, alpha.
    function merge_lists($listA, $listB) {

        // Check if $listA is empty.

        $new_list = array();
        $a = 0;

        foreach ($listA as $itemA) {

            $b = 0;

            foreach ($listB as $itemB) {

                if ($itemB->percent == $itemA->percent) {

                    if ($itemB->count == $itemA->count) {

                        if ($itemB->word < $itemA->word) {
                            $new_list[$a] = $listB[$b];
                        }
                    }

                    elseif ($itemB->count > $itemA->count) {
                        $new_list[$a] = $listB[$b];
                    }
                }

                elseif ($itemB->percent > $itemA->percent) {
                    $new_list[$a] = $listB[$b];
                }

                elseif ($itemB->percent < $itemA->percent) {
                    $new_list[$a] = $listA[$a];
                }

                $b++;
            }

            $a++;
        }

        return $new_list;

//                    if ($new_list[$j]->percent < $new_list[$j-1]->percent) {
//                        $moved = $new_list[$j];
//                        $new_list[$j] = $new_list[$j-1];
//                        $new_list[$j-1] = $moved;
//                    }
//
//                    elseif ($new_list[$j]->percent == $new_list[$j-1]->percent) {
//                        if ($new_list[$j]->count < $new_list[$j-1]->count) {
//                            $moved = $new_list[$j];
//                            $new_list[$j] = $new_list[$j-1];
//                            $new_list[$j-1] = $moved;
//                        }
//
//                        elseif ($new_list[$j]->percent == $new_list[$j-1]->percent) {
//
//                        }
    }
?>
