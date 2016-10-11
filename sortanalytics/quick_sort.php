<?php

    function bubble_sort($list, $type, ...$properties) {

        if ($type != 'integer' || $type != 'float') {
            throw new Exception('Error: The passed in data type is unsupported. This class only supports integers and floats.');
        }

        else {
            $left = 0;
            $right = count($list - 1);
        }

    }
?>