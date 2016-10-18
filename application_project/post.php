<?php

    class blog_post {

        public $title;
        public $date;
        public $author;
        public $text;
        public $short_text;
    }

    class score {
        public $key;
        public $score;

        public function __toString() {
            return (string)$this->key;
        }
    }