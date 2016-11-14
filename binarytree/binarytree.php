<?php

	class BinaryTree {
		
		public $root;

		function set($key, $value) {

			if ($key < 0) {
				throw new Exception('Error: '. $key . ' is not an acceptable key.');
			}
			
			if (!isset($this->root)) {
				$this->root = new Node($key, $value, '-', '-', '-');
			}

			else {

				$selected = $this->root; // 'c'

				while ($selected !== '-') {

					// echo 'Starting Key: ' . $selected->key . PHP_EOL;

					// Check if the key is greater than, less than, or equal to the specified key.
					if ($key < $selected->key) {
						
						// echo 'Less than ' . $selected->key . PHP_EOL;

						if ($selected->left == '-') {
							// echo "Create new node" . PHP_EOL;
							$node = new Node($key, $value, $selected, '-', '-');
							$selected->left = $node; // Point $selected left pointer to new node.
						}

						$selected = $selected->left; // Reassign $selected.
					}

					elseif ($key > $selected->key) {
						// echo 'More than ' . $selected->key . PHP_EOL;

						if ($selected->right == '-') {
							// echo "Create new node" . PHP_EOL;
							$node = new Node($key, $value, $selected, '-', '-');
							$selected->right = $node; // Point $selected left pointer to new node.
						}

						$selected = $selected->right; // Reassign $selected.
					}

					elseif ($key == $selected->key) {
						// echo 'Equal to ' . $selected->key . PHP_EOL;
						$selected = '-';
					}
				}
			}
		}

		function get($key) {

			$selected = $this->root; // 'c'

			while ($selected !== '-') {

				// echo 'Starting Key: ' . $selected->key . PHP_EOL;

				$value = $selected->value;

				if ($key == $selected->key) {
					// echo 'Equal to ' . $selected->key . PHP_EOL;
					$value = $selected->value;
					$selected = '-';
				}

				// Check if the key is greater than, less than, or equal to the specified key.
				elseif ($key < $selected->key) {
					// echo 'Less than ' . $selected->key . PHP_EOL;
					$selected = $selected->left; // Reassign $selected.

					if ($selected == '-') {
						$value = null;
					}
				}

				elseif ($key > $selected->key) {
					// echo 'More than ' . $selected->key . PHP_EOL;
					$selected = $selected->right; // Reassign $selected.

					if ($selected == '-') {
						$value = null;
					} 
				}
			}

			return $value;
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

			$q = new SplQueue();
			$q->enqueue($this->root);

			$output = '';

			while (count($q) > 0) {
				$node = $q->dequeue();

				if ($node->left !== '-') {
					$q->enqueue($node->left);
				}

				if ($node->right !== '-') {
					$q->enqueue($node->right);
				}
				
				$output .= $node->key;
			}

			return $output;
		}

		function debug_print() {
			
			$output = '';
			$selected = $this->root;
			$output = $selected->key . '(' . $selected->parent . ')';

			return $output;
		}

		function generate($selected) {

			// if (gettype($selected) == 'object') {
				yield $selected->key;
			// }

			// if (gettype($selected->right) == 'object') {
			// 	yield $selected->right;
			// }
			
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