<?php 
	include "hashtable.php";

	echo "<pre>";

	$output = '';

	$stringhashtable = new StringHashTable();

	$filename = "strings.txt";
	$contents = file($filename);

	foreach($contents as $line) {
	    $stringhashtable->set(strtolower($line), $line);
	}

	$output .= 'String hash table:' . PHP_EOL;
	$output .= $stringhashtable->debug_print();

	$output .= PHP_EOL . 'String lookups:' . PHP_EOL;
	$output .= $stringhashtable->get('indian meal moth');
	$output .= $stringhashtable->get('orb-weaving spiders (banded garden spider)');

	$guidhashtable = new GuidHashTable();

	$filename = "guids.txt";
	$contents = file($filename);

	foreach($contents as $line) {
	    $guidhashtable->set(strtolower($line), $line);
	}

	$output .= PHP_EOL . 'Guid hash table:' . PHP_EOL;
	$output .= $guidhashtable->debug_print();

	$output .= PHP_EOL . 'Guid lookups:' . PHP_EOL;
	$output .= $guidhashtable->get('00000158691797bd77464883000a001800388ccf');
	$output .= $guidhashtable->get('00000158691797bd7746488c000a001991ef0003');

	$imagehashtable = new ImageHashTable();

	$directory = "images/";

	if (is_dir($directory)) {
	    if ($handle = opendir($directory)) {
	        while (($file = readdir($handle)) !== false) {
	            if (filetype($directory . $file) !== "dir") {
	            	$image_data = file_get_contents($directory . $file);
	            	$encoded_image = base64_encode($image_data);
					$imagehashtable->set(strtolower($file), $file);
	            }
	        }
	        closedir($handle);
	    }
	}

	$output .= PHP_EOL . 'Image hash table:' . PHP_EOL;
	$output .= $imagehashtable->debug_print();
	
	$output .= PHP_EOL . 'Image lookups:' . PHP_EOL;
	$output .= $imagehashtable->get('document.png') . PHP_EOL;
	$output .= $imagehashtable->get('security_keyandlock.png');

	echo $output;
	echo "</pre>";

	// Writing to the output.txt file. This also creates it if it doesn't already exist.
	$file = fopen("output.txt", "w") or die("Could not open file.");
	fwrite($file, $output);
?>