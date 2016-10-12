<?php

    include 'bubble_sort.php';
    include 'insertion_sort.php';
    include 'selection_sort.php';
    include 'quick_sort.php';

    $filenames = array(
        'list1.csv' => 'integer',
        'list2.csv' => 'integer',
        'list3.csv' => 'integer',
        'list4.csv' => 'integer',
        'list5.csv' => 'float',
        'list6.csv' => 'integer'
    );

    class Result {

            function __construct($name, $duration, $nums) {
                $this->name = $name;
                $this->duration = round($duration, 6);
                $this->nums = $nums;
                $this->relative = NULL;
            }

            function calc_relative($fastest) {

                $relative = (100.0 * ($this->duration - $fastest) / $fastest);
                $this->relative = abs(round($relative, 0));
                return $this->relative;
            }
    }

    function sort_results_by_relative($resultA, $resultB) {
        if ($resultA->relative == $resultB->relative) {
            return 0;
        }

        return ($resultA->relative < $resultB->relative) ? -1 : 1;
    }

    /* Main processing */

    $list = array();

    $output = '';

    foreach ($filenames as $filename => $type) {

        $handle = fopen($filename, 'r');
        $row = 0;
        $list = array();

        if ($handle !== FALSE) {

            $sublist = array();

            while (($data = fgetcsv($handle, 1000, ',')) !== FALSE) {

                $sublist[$row] = $data[0] + 0;
                $row++;
            }

            /* Native sort */

            $starttime = microtime(TRUE);

            for ($i = 0; $i < 100; $i++) {

                $list[$i] = $sublist;
                sort($list[$i], SORT_NUMERIC);
            }

            $endtime = microtime(TRUE);
            $duration = $endtime - $starttime;
            $native_duration = $duration;

            $native_result = new Result('Native Language Sort', $duration, $list[0]);


            /* Insertion sort */

            $starttime = microtime(TRUE);

            for ($i = 0; $i < 100; $i++) {

                $list[$i] = $sublist;
                $list[$i] = insertion_sort($list[$i], $type);
            }

            $endtime = microtime(TRUE);
            $duration = $endtime - $starttime;

            $insertion_result = new Result('Insertion Sort', $duration, $list[0]);


            /* Selection sort */

            $starttime = microtime(TRUE);

            for ($i = 0; $i < 100; $i++) {

                $list[$i] = $sublist;
                $list[$i] = selection_sort($list[$i], $type);
            }

            $endtime = microtime(TRUE);
            $duration = $endtime - $starttime;

            $selection_result = new Result('Selection Sort', $duration, $list[0]);


            /* Bubble sort */

            $starttime = microtime(TRUE);

            for ($i = 0; $i < 100; $i++) {

                $list[$i] = $sublist;
                $list[$i] = bubble_sort($list[$i], $type);
            }

            $endtime = microtime(TRUE);
            $duration = $endtime - $starttime;

            $bubble_result = new Result('Bubble Sort', $duration, $list[0]);


            /* Quick sort */

            $starttime = microtime(TRUE);

            for ($i = 0; $i < 100; $i++) {

                $list[$i] = $sublist;
                $list[$i] = quick_sort($list[$i], $type, $list[$i][0]);
            }

            $endtime = microtime(TRUE);
            $duration = $endtime - $starttime;

            $quick_result = new Result('Quick Sort', $duration, $list[0]);

            // Build an array of Result objects.
            $results = array($native_result, $insertion_result, $selection_result, $bubble_result, $quick_result);

            // Sort the array by relative time.
            foreach($results as $result) {
                $result->calc_relative($native_duration);
            }

            usort($results, 'sort_results_by_relative');

            // Build and output the results string.
            $output .= $filename . PHP_EOL;

            foreach ($results as $result) {
                $output .= $result->name . PHP_EOL;
                $output .= $result->duration . PHP_EOL;
                $output .= $result->relative . PHP_EOL;

                $output .= 'First 10:';

                $first_ten = array_slice($result->nums, 0, 10);

                foreach ($first_ten as $list) {
                    $output .= ' ' . $list . ',';
                }

                $output = rtrim($output, ',');
                $output .= PHP_EOL . 'Last 10: ';

                $last_ten = array_slice($result->nums, -10);

                foreach ($last_ten as $list) {
                    $output .= ' ' . $list . ',';
                }

                $output = rtrim($output, ',');
                $output .= PHP_EOL;
                $output .= PHP_EOL;
            }
        }
    }

//    echo $output;

    // Writing to the output.txt file. This also creates it if it doesn't already exist.
    $file = fopen("output.txt", "w") or die("Could not open file.");
    fwrite($file, $output);

?>