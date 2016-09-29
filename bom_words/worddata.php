<?php
    // Data about a single word
    class WordData {

        function __construct($book, $word, $count, $percent) {
            // Constructor
            $this->book = $book;
            $this->word = $word;
            $this->count = $count;
            $this->percent = $percent;
        }
    }
?>