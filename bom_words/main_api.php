<?php

    include 'bubble_sort.php';
    include 'insertion_sort.php';
    include 'selection_sort.php';
    include 'worddata.php';

    $filenames = array(
        '1 Nephi' => '01-1 Nephi.txt',
        '2 Nephi' => '02-2 Nephi.txt',
        'Jacob' => '03-Jacob.txt',
        'Enos' => '04-Enos.txt',
        'Jarom' => '05-Jarom.txt',
        'Omni' => '06-Omni.txt',
        'Words of Mormon' => '07-Words of Mormon.txt',
        'Mosiah' => '08-Mosiah.txt',
        'Alma' => '09-Alma.txt',
        'Helaman' => '10-Helaman.txt',
        '3 Nephi' => '11-3 Nephi.txt',
        '4 Nephi' => '12-4 Nephi.txt',
        'Mormon' => '13-Mormon.txt',
        'Ether' => '14-Ether.txt',
        'Moroni' => '15-Moroni.txt'
    );

    /* Analyze a string of words */

    // Performs a very naive analysis of the words in the text, returning the SORTED list of WordData items
    function analyze_text($book, $text) {

        # lowercase the entire text
        $text = strtolower($text);

        # split the text by whitespace to get a list of words

        # convert each word to the longest run of characters
        # eliminate any words that are empty after conversion to characters

        $text = preg_replace('/([0-9])/', '', $text); // Numbers
        $text = preg_replace('/chapter/', '', $text); // "chapter"
        $text = preg_replace('/—/', ' ', $text); // Horrible dash.
        $text = preg_replace('/[^\w\s]|_/', '', $text); // Punctuation.
        $text = preg_replace('/\n|\r/', PHP_EOL, $text); // Newline weirdness.
        $text = str_replace(array(PHP_EOL), ' ', $text); // Newline weirdness.
        $text = preg_replace('/\s+/', ' ', $text); // Leftover spaces.
//        $text = str_replace(array('  '), ' ', $text); // Leftover spaces.

        $text = preg_split('/[ ]/', $text); // Split into an array on the spaces that matter.
        $text = array_values(array_filter($text)); // Needed to strip out any empty values.

//        foreach( $text as $key => $value ){
//            echo $value . '<br>';
//        }

//        print_r($text);

        # count up the occurance of each word into a dictionary of: word -> count
        $count_array = array_count_values($text);
//        arsort($count_array);

        # create a WordData item for each word in our list of words
        $totalcount = 0;

        foreach($count_array as $value) {
            $totalcount += $value;
        }

        $index = 0;
        $words_list = array();

        foreach ($count_array as $word => $count) {
            $percent = round(($count / $totalcount) * 100, 1);
            $word_object = new WordData($book, $word, $count, $percent);
            $words_list[$index] = $word_object;
            $index++;
        }




        # sort the WordData list using Bubble Sort, Insertion Sort, or Selection Sort:
        # 1. highest percentage [descending]
//        $word_data_list = bubble_sort_percent($words_list);
        # 2. highest count (if percentages are equal) [descending]
        # 3. lowest alpha order (if percentages and count are equal) [ascending]

//        insertion_sort($words_list);

        $list = array(1, 2, 5, 2, 1, 6, 10, 52, 32);

        $words_list = insertion_sort($words_list, 'percent', 'count', 'word');

//        $words_list = array_reverse($words_list);
//        $words_list = insertion_sort($words_list, 'word');

        print_r($words_list);

        # return
    }

    /* Prints a word list */

    // Prints a list of words
    function print_words($words, $threshold=NULL, $word=NULL) {

        # print the words over the threshold_percent or that match the given word

        # print an empty line
    }



    /* Main Loop */

    echo '<pre>';

    $master = array();

    # loop through the filenames and analyze each one

//    foreach ($filenames as $key => $filename) {
//        analyze_text($key, file_get_contents($filename));
//    }

    analyze_text('Omni', file_get_contents('06-Omni.txt'));


    # after analyzing each file, merge the master and words lists into a single, sorted list (which becomes the new master list)
    echo 'INDIVIDUAL BOOKS > 2% <br>';

    # print each book, word, count, percent in master list with percent over 2
    echo 'MASTER LIST > 2% <br>';

    # print each book, word, count, percent in master list with word == 'christ'
    echo 'MASTER LIST == christ <br>';

    # read the full text of the BoM and analyze it
    echo 'FULL TEXT > 2% <br>';

//    $list = array(-1, 17, 20, 10, 4.00, 5, 4, -10, 6, 3, 2, 1, 15, 15);
//    $new_list = selection_sort($list);
//    print_r($new_list);
    echo '</pre>';

?>