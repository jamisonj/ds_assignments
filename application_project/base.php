<?php
    echo "<p>Test</p>";

    include 'post.php';

    $posts = array();

    for ($i = 0; $i < 10; $i++) {
        $posts[$i] = new blog_post();
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

    foreach ($posts as $post) {
        $post->title = $titles[$a];
        $post->date = $dates[$a];
        $post->author = $authors[$a];

        $filepath = 'posts/' . $filenames[$a];
        $handle = fopen($filepath, 'r') or die('Unable to open file ' . $filepath . '!');
        $post->text = fread($handle, filesize($filepath));
        fclose($handle);
        $a++;
    }

//    echo '<pre>';
//    print_r($posts);
//    echo '</pre>';



?>