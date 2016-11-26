<?php
	include "binarytree/binarytree.php";

	abstract class HashTable {

		public $hashtable;

		function __construct() {
			
			$this->hashtable = array();

			for ($i = 0; $i < 10; $i++) {
				$this->hashtable[] = new BinaryTree();
			}
		}

		function set($key, $value) {
			
			$index = $this->get_hash($key);
			$this->hashtable[$index]->set($key, $value);

			return $index;
		}

		function get($key) {

			$index = $this->get_hash($key);
			$value = $this->hashtable[$index]->get($key);

			return $value;
		}

		function remove($key) {
			$index = $this->get_hash($key);
			$this->hashtable[$index]->remove($key);
		}

		function debug_print() {

			$output = '';

			foreach ($this->hashtable as $value) {
				$output .= print_r($value);
			}

			foreach ($this->hashtable as $key => $value) {
				$output .= $key . ': ' . preg_replace('/[\r\n]+/', ', ', $value->walk_dfs_inorder($value->root)) . PHP_EOL;
			}

			$output = str_replace(', ' . PHP_EOL, PHP_EOL, $output);

			return $output;
		}

		abstract function get_hash($key);
	}


	class StringHashTable extends HashTable {
		
		function get_hash($key) {
			
			$text = preg_replace('/\s+/', '', $key);
			$chars = str_split($text);

			$index = 0;

			$sum = 0;

			foreach ($chars as $char) {
				$chars[$index] = ord($char) % 10;
				$sum += $chars[$index];
				$index++;
			}

			// echo $sum . PHP_EOL;

			$value = $sum % 10;

			// echo $value . PHP_EOL;

			return $value;
		}
	}

	class GuidHashTable extends HashTable {
		
		function get_hash($key) {

		}
	}

	class ImageHashTable extends HashTable {
		
		function get_hash($key) {

		}
	}
?>