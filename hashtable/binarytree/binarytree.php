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

				// echo 'Key: ' . $key . PHP_EOL;
				// echo 'Selected Key: ' . $selected->key . PHP_EOL;

				$value = $selected->value;

				if (trim($key) === trim($selected->key)) {
					// echo 'Equal to ' . $selected->key . PHP_EOL;
					$value = $selected->value;
					$selected = '-';
				}

				// Check if the key is greater than, less than, or equal to the specified key.
				elseif (trim($key) < trim($selected->key)) {
					// echo 'Less than ' . $selected->key . PHP_EOL;
					$selected = $selected->left; // Reassign $selected.

					if ($selected === '-') {
						$value = null;
					}
				}

				elseif (trim($key) > trim($selected->key)) {
					// echo 'More than ' . $selected->key . PHP_EOL;
					$selected = $selected->right; // Reassign $selected.

					if ($selected === '-') {
						$value = null;
					} 
				}
			}

			// echo $value;

			if ($value === null) {
				throw new Exception('Error: This value does not exist in the tree.');
			}

			else {
				return $value;
			}
		}

		function remove($key) {
			
			$q = new SplQueue();
			$q->enqueue($this->root);

			while (count($q) > 0) {

				$node = $q->dequeue();
				
				if (trim($node->key) == trim($key)) {

					/* If the node has no children... */
					if ($node->left == '-' && $node->right == '-') {

						if (gettype($node->parent) == 'object') {

							if ($node->parent->left == $node) {
								$node->parent->left = '-';
							}

							elseif ($node->parent->right == $node) {
								$node->parent->right = '-';
							}
						}
					}

					/* If the node has one child... */
					elseif (gettype($node->left) == 'object' && $node->right == '-') {

						if (gettype($node->parent) == 'object') {
							if ($node->parent->left == $node) {
								$node->parent->left = $node->left;
								$node->left->parent = $node->parent;
							}

							elseif ($node->parent->right == $node) {
								$node->parent->right = $node->left;
								$node->left->parent = $node->parent;
							}
						}
					}

					elseif (gettype($node->right) == 'object' && $node->left == '-') {
						
						if (gettype($node->parent) == 'object') {
							if ($node->parent->left == $node) {
								$node->parent->left = $node->right;
								$node->right->parent = $node->parent;
							}

							elseif ($node->parent->right == $node) {
								$node->parent->right = $node->right;
								$node->right->parent = $node->parent;
							}
						}
					}

					/* If both children are objects... */
					elseif (gettype($node->left) == 'object' && gettype($node->right) == 'object') {

						$new_root = $node;

						$q2 = new SplQueue();
						$q2->enqueue($new_root);

						$check_value = $new_root->key;
						$greatest = $new_root->left->key; 
						$deleted_object = $new_root->left;

						// Loop to find the greatest element inside left tree.
						while (count($q2) > 0) {

							$removed = $q2->dequeue();

							// Reassign $greatest to the $removed->key if $removed->key is greater than $greatest and less than $check_value.
							if ($removed->key > $greatest && $removed->key < $check_value) {
								$greatest = $removed->key;
								$deleted_object = $removed;
							}

							if ($removed->left !== '-') {
								$q2->enqueue($removed->left);
							}

							if ($removed->right !== '-') {
								$q2->enqueue($removed->right);
							}
						}

						// Recursive call to remove the $greatest child node from deeper in the tree.
						$this->remove($greatest);

						// Reassigning the data structure pointers.
						$deleted_object->parent = $node->parent;

						if ($node->left !== '-') {
							$deleted_object->left = $node->left;
							$deleted_object->left->parent = $deleted_object;
						}

						if ($node->right !== '-') {
							$deleted_object->right = $node->right;
							$deleted_object->right->parent = $deleted_object;
						}
						
						if ($node->parent->left == $node) {
							$node->parent->left = $deleted_object;
						}

						elseif ($node->parent->right == $node) {
							$node->parent->right = $deleted_object;
						}
					}
				}

				if ($node->left !== '-') {
					$q->enqueue($node->left);
				}

				if ($node->right !== '-') {
					$q->enqueue($node->right);
				}
			}
		}

		function walk_dfs_inorder($node) {

			$output = '';

			if (gettype($node->left) == 'object') {
				$output .= $this->walk_dfs_inorder($node->left);
			}

			$output .= $node->value . PHP_EOL;

			if (gettype($node->right) == 'object') {
				$output .= $this->walk_dfs_inorder($node->right);
			}

			return $output;
		}

		function walk_dfs_preorder($node) {
			
			$output = '';
			$output .= $node->value . PHP_EOL;

			if (gettype($node->left) == 'object') {
				$output .= $this->walk_dfs_preorder($node->left);
			}

			if (gettype($node->right) == 'object') {
				$output .= $this->walk_dfs_preorder($node->right);
			}

			return $output;
		}

		function walk_dfs_postorder($node) {
			
			$output = '';

			if (gettype($node->left) == 'object') {
				$output .= $this->walk_dfs_postorder($node->left);
			}

			if (gettype($node->right) == 'object') {
				$output .= $this->walk_dfs_postorder($node->right);
			}

			$output .= $node->value . PHP_EOL;

			return $output;
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
				
				$output .= $node->value . PHP_EOL;
			}

			return $output;
		}

		function debug_print() {

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
				
				$output .= $node->to_string() . PHP_EOL;
			}

			return $output;
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

		function to_string() {
			if ($this->parent !== '-') {
				return $this->key . '(' . $this->parent->key . ')';
			}

			else {
				return $this->key . '(' . $this->parent . ')';
			}
			
		}
	}

?>