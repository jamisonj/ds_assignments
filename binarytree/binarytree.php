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

		function walk_bfs($tree) {

			// $selected = $this->root;

			// yield $selected;

			foreach ($tree as $selected) {

				print_r($selected);
				// if ($selected->left !== '-') {
				// 	yield from $this->walk_bfs($selected->left);
				// 	continue;
				// }

				// if ($selected->right !== '-') {
				// 	yield from $this->walk_bfs($selected->right);
				// 	continue;
				// }
			}

			yield $selected->key;

			// yield $selected;

			// yield $selected;
			
			// $selected = $this->root; // 'c'

			// $q = new SplQueue();
			// $q->enqueue($selected);

			// print_r($selected->left);
			// print_r($selected->right);

			// if (gettype($selected->left == 'object')) {
			// 	$q->enqueue($selected->left);
			// 	echo "Called left" . PHP_EOL;
			// }

			// if (gettype($selected->right == 'object')) {
			// 	$q->enqueue($selected->left);
			// 	echo "Called right" . PHP_EOL;
			// }

			// foreach ($this->generate($selected) as $value) {
			//     print_r($value);
			// }

			// foreach ($this->generate(8) as $item) {

			// 	print_r($this->generate($selected));
				
			// 	// if ($this->generate($selected->left)) {
			// 	// 	// $q->enqueue($selected->left);
			// 	// 	echo "Called left" . PHP_EOL;
			// 	// }

			// 	// if ($this->generate($selected->right)) {
			// 	// 	// $q->enqueue($selected->right);
			// 	// 	echo "Called right" . PHP_EOL;
			// 	// }

			// 	// print_r($item);
			// 	// $q->enqueue($item);
			// }

			

			// foreach ($q as $item) {
			// 	echo $item->key . PHP_EOL;
			// }

			// $c = 0;

			
				// $q->enqueue($this->generate_left($selected->left));
				// echo $this->generate_left($selected->left)->key;
				// $q->enqueue($this->generate_right($selected->right));
				// echo $this->generate_right($selected->right)->key;
				// // $this->walk_bfs();
				// $c++;
				// echo $c . PHP_EOL;
			

			// print_r($q);

		}

		function debug_print() {
			$string = '';

			$selected = $this->root;

			$string = $selected->key . '(' . $selected->parent . ')';

			return $string;
		}

		function generate($selected) {

			if (gettype($selected) == 'object') {
				yield $selected;
			}

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