<?php 
	function factorial($num) {
		if ($num == 0) {
			return 1; // We must return 1, because otherwise we'll be multiplying $num - 1 by 0, which will return 0!
		}

		else {
			return factorial($num - 1) * $num;
		}
	}

	$number = 5;
	echo 'Input is ' . $number;

	try {
		$thingy = factorial($number);
		echo '<p> Return value: ' . $thingy . ' </p>';
	}

	catch (Exception $e) {
		echo $e;
	}
?>