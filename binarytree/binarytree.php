<?php

	class BinaryTree {
		
		protected $root;

		function set($key, $value) {

			if ($key < 0) {
				throw new Exception('Error: '. $key . ' is not an acceptable key.');
			}
			
			if (!isset($this->root)) {
				$this->root = new Node($key, $value, '-', '-', '-');
			}

			else {

				$selected = $this->root; // 'c'

				$parent = $selected->parent; // '-'

				while ($selected !== '-') {

					echo 'Key: ' . $selected->key . PHP_EOL;
					
					// Check if the key is greater than, less than, or equal to the specified key.
					if ($key < $selected->key) {
						echo 'Less than ' . $selected->key . PHP_EOL;
						$parent = $selected;
						$selected = $selected->left;
					}

					elseif ($key > $selected->key) {
						echo 'More than ' . $selected->key . PHP_EOL;
						$parent = $selected;
						$selected = $selected->right;
					}

					elseif ($key == $selected->key) {
						echo 'Equal to ' . $selected->key . PHP_EOL;
						$selected->key = $key;
						$selected->value = $value;
					}

					// echo $parent;
				}

				$selected = new Node($key, $value, $parent, '-', '-');

				echo 'New Key: ' . $selected->key . PHP_EOL;
			}
		}

		function get($key) {

		}

		function remove($key) {

		}

		function walk_dfs_inorder() {

		}

		function walk_dfs_preorder() {

		}

		function walk_dfs_postorder() {

		}

		function walk_bfs() {

		}

		function debug_print() {
			$string = '';

			$node = $this->root;

			$string = $node->key . '(' . $node->parent . ')';

			return $string;
		}
	}

	class Node {

		public $key;
		public $value;
		public $parent;
		public $left;
		public $right;

		function __construct($key, $value, $parent, $left, $right) {
			$this->key = $key;
			$this->value = $value;
			$this->parent = $parent;
			$this->left = $left;
			$this->right = $right;
		}
	}

?>