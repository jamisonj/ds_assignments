<?php

include 'serialize.php';

/* Testing Objects */

// A date for a person.
class Date {

    public $year;
    public $month;
    public $day;

    function __construct($year, $month, $day) {
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }
}

// A franchise.
class Franchise {

    public $name;
    public $owner;
    public $started;

    function __construct($name, $owner, $started) {
        $this->name = $name;
        $this->owner = $owner;
        $this->started = $started;
    }
}

// A franchise.
class Person {

    public $name;
    public $gender;
    public $birth_date;
    public $is_cool;
    public $net_worth;
    public $debut_year;
    public $father;
    public $mother;
    public $franchise;

    function __construct($name, $gender, $birth_date, $is_cool, $net_worth, $debut_year, $father, $mother, $franchise) {
        $this->name = $name;
        $this->gender = $gender;
        $this->birth_date = $birth_date;
        $this->is_cool = $is_cool;
        $this->net_worth = $net_worth;
        $this->debut_year = $debut_year;
        $this->father = $father;
        $this->mother = $mother;
        $this->franchise = $franchise;
    }
}

/* Main Method */

// Person 1
$fd1 = new Date(1962, 8, 1);
$f1 = new Franchise('Spiderman', 'Marvel', $fd1);
$b1 = new Date(2011, 2, 3);
$p1 = new Person('Peter "Spidey" Parker', 'M', $b1, false, 15000.00, 1967, null, null, $f1);

// Person 2
$fd2 = new Date(1962, 8, 1);
$f2 = new Franchise('Superman', 'DC\\Comics', $fd2);
$b2 = new Date(2014, 5, 6);
$p2 = new Person('Lois Lane', 'F', $b2, true, 40000.50, 1981, null, null, $f2);

// Person 3
$fd3 = new Date(1963, 1, 1);
$f3 = new Franchise('Doctor Who', 'BBC', $fd3);
$b3 = new Date(2017, 8, 9);
$p3 = new Person('River Song/Melody Pond', 'F', $b3, true, 91234.56, 2001, $p1, $p2, $f3);

// Print
//var_dump($p3);
header('Content-Type: text/plain');
print to_json($p3);

?>
