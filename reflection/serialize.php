<?php
/* Serialization to JSON */

$TAB = '\t';

// Serializes the given object to JSON, printing to the console as it goes.
function to_json($obj, $level = 0){

	$output = "";

	$tabs = "\t";
	$tabsless = "";

	for ($c = 0; $c < $level; $c++) {
		$tabs .= "\t";
		$tabsless .= "\t";
	}

    $reflector = new ReflectionClass($obj);
    $properties = $reflector->getProperties();

	$output .= "{" . PHP_EOL;

    foreach($properties as $property) {

    	$output .= $tabs . "\"" . $property->getName() . "\": ";

    	switch (gettype($property->getvalue($obj))) {
    		case 'object':
    			$level++;
	    		$object = $property->getvalue($obj);

	    		// If value is an object, we need to recursively call our method.
	    		$output .= to_json($object, $level);
	    		$level--;
    			break;

    		case 'boolean':
    			$output .= $property->getvalue($obj) ? "true" : "false" ;
    			break;

    		case 'string':
    			$string = addslashes($property->getvalue($obj));
    			$output .= "\"" . $string . "\"";
    			break;

			case 'double':
				$output .= number_format($property->getvalue($obj), 2, ".", "");
				break;

			default:
				$value = $property->getvalue($obj);

				// Handles the "null" case as well.
				$output .= isset($value) ? $value : "null";
				break;
    	}

    	$output .= "," . PHP_EOL;
    }

    $output .= $tabsless . "}";

	return $output;
}