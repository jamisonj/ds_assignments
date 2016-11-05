<?php
    include 'post.php';

    function compare_scores($a, $b)
    {
        if ($a->score == $b->score) {
            return 0;
        }

        return ($a->score > $b->score) ? -1 : 1;
    }

    function search($query, $array, ...$properties) {

        echo '<pre>';

        $query_array = explode(' ', $query);
        $common_words = array("i","in","it","a","the","and","of","or","do","I","you","he","me","us","they","she","to","but","that","this","those","then","is","why","when","where","how","what","who");

        $keys = array();
        $score_array = array();
        $i = 0;

        foreach ($query_array as $word) {

            // If the word is common...
            if (array_keys($common_words, $word)) {
//                echo 'Word "' . $word . '" is common.';

                // Remove it from query array.
                $query_array = array_diff($query_array, array($word));
                print_r($query_array);
            }
        }

        foreach ($query_array as $word) {

            echo 'Word "' . $word . '".<br>';

            // If the word is in the post, add the post to the list of $keys.
            foreach ($array as $key => $value) {

                $score = 0;

                echo 'Key is ' . $key . '<br>';

                foreach ($properties as $property) {

                    $count = substr_count(strtolower($value->{$property}), strtolower($word));

                    if ($count !== 0) {
                        echo 'Found "' . $word . '" in property "' . $property . '" of key ' . $key . '. Number of times = ' . $count . '<br>';
                        $score += $count; // Score is the number of times the search term appeared in the post.
                    }
                }

                if ($score !== 0) {
                    $score_array[$i] = new score();
                    $score_array[$i]->key = $key; // Key is the ID of the post that contained the search term.
                    $score_array[$i]->score = $score;
                    $i++;
                }
            }
        }

        usort($score_array, "compare_scores");

        // Remove duplicate posts and add the scores together.
        $deduplicate = array();

        foreach ($score_array as $value) {
            if (!(in_array((string)$value, $deduplicate))) {
                echo "added " . (string)$value . " to deduplicate.<br>";
                echo "Score: " . $value->score . "<br>";
                $deduplicate[] = $value;
            }

            else {
                $key = array_search((string)$value, $deduplicate);
                echo "Old Score: " . $deduplicate[$key]->score . "<br>";
                $deduplicate[$key]->score += $value->score;

                echo "added " . (string)$value . " to deduplicate at original location.<br>";
                echo "New Score: " . $deduplicate[$key]->score . "<br>";

            }
        }

        print_r($deduplicate);

        //Populate the returned $result_array. This array contains the posts that the page will display.

        $result_array = array();
        $j = 0;

        foreach ($deduplicate as $key => $value) {

            if (array_key_exists($value->key, $array)) {
                $result_array[$j] = $array[$value->key];
            }

            $j++;
        }

        echo '</pre>';

        return $result_array;

    }

    /* Main Processing */

    session_start();

    if (!empty($_POST['search'])) {
        $_SESSION['posts'] = search($_POST['search'], $_SESSION['temp'], 'title', 'date', 'author', 'text');
    }

    else {

        $_SESSION['posts'] = array();

        for ($i = 0; $i < 10; $i++) {
            $_SESSION['posts'][$i] = new blog_post();
        }

        $titles = array(
            'What Did the Prophet Say at Conference? October 2016',
            'Why Do We Feel Damaged When Others Are Blessed?',
            'Sitting in the Space of Not Knowing',
            'Our Homing Impulse',
            'The Gift of Being Broken',
            'When #PrayforAmerica Will Start to Really Mean Something',
            'Advice for the Younger Missionary Me: We Aren’t God’s Only People',
            'What We Cannot Afford to Live Without',
            'Chucking the Church Checklist',
            'Raising Missionaries Right: 8 Skills Parents Are Overlooking'
        );

        $dates = array (
            'October 2, 2016',
            'September 15, 2016',
            'September 9, 2016',
            'August 31, 2016',
            'July 28, 2016',
            'July 15, 2016',
            'July 14, 2016',
            'June 30, 2016',
            'June 23, 2016',
            'June 21, 2016',
        );

        $authors = array (
            'LDS Blog Staff',
            'Samuel B. Hislop',
            'Ariel Szuch',
            'President Dieter F. Uchtdorf',
            'Ariel Szuch',
            'Irinna Danielson',
            'Samuel B. Hislop',
            'Irinna Danielson',
            'Irinna Danielson',
            'Irinna Danielson'
        );

        $filenames = array (
            'What did the Prophet say at Conference.txt',
            'Why do we feel Damaged.txt',
            'Sitting in the Space of Not Knowing.txt',
            'Our Homing Impulse.txt',
            'The Gift of Being Broken.txt',
            'When PrayforAmerica will Start to Really Mean Something.txt',
            'Advice for the Younger Missionary Me.txt',
            'What we Cannot Afford to Live Without.txt',
            'Chucking the Church Checklist.txt',
            'Raising Missionaries Right.txt'
        );

        $a = 0;

        foreach ($_SESSION['posts'] as $post) {
            $post->title = $titles[$a];
            $post->date = $dates[$a];
            $post->author = $authors[$a];

            $filepath = 'posts/' . $filenames[$a];
            $handle = fopen($filepath, 'r') or die('Unable to open file ' . $filepath . '!');
            $post->text = fread($handle, filesize($filepath));
            $post->short_text = substr($post->text, 0, 150);
            fclose($handle);
            $a++;
        }

        $_SESSION['temp'] = $_SESSION['posts'];
    }

//    echo '<pre>';
//    print_r($posts);
//    echo '</pre>';



?>