<?php
	include "binarytree.php";

	$tree = new BinaryTree();
	$tree->set('c', 'C');

	echo '<pre>';

	$output = '';

	$tree->set('h', 'H');
	$tree->set('a', 'A');
	$tree->set('b', 'B');
	$tree->set('e', 'E');
	$tree->set('j', 'J');
	$tree->set('d', 'D');
	$tree->set('f', 'F');
	$tree->set('i', 'I');
	$tree->set('k', 'K');
	$tree->set('g', 'G');

	$output .= 'Initial tree: ' . PHP_EOL;
	$output .= $tree->debug_print() . PHP_EOL;

	$output .= 'Lookups: ' . PHP_EOL;
	$output .= $tree->get('f') . PHP_EOL;
	$output .= $tree->get('b') . PHP_EOL;
	$output .= $tree->get('i') . PHP_EOL;

	$output .= PHP_EOL;

	$output .= 'BFS: ' . PHP_EOL;
	$output .= $tree->walk_bfs() . PHP_EOL;

	$output .= 'DFS preorder:' . PHP_EOL;
	$output .= $tree->walk_dfs_preorder($tree->root) . PHP_EOL;

	$output .= 'DFS inorder:' . PHP_EOL;
	$output .= $tree->walk_dfs_inorder($tree->root) . PHP_EOL;

	$output .= 'DFS postorder:' . PHP_EOL;
	$output .= $tree->walk_dfs_postorder($tree->root) . PHP_EOL;

	$output .= 'Remove b:' . PHP_EOL;
	$tree->remove('b');
	$output .= $tree->debug_print() . PHP_EOL;

	$output .= 'Remove f:' . PHP_EOL;
	$tree->remove('f');
	$output .= $tree->debug_print() . PHP_EOL;

	$output .= 'Remove h:' . PHP_EOL;
	$tree->remove('h');
	$output .= $tree->debug_print() . PHP_EOL;

	echo '</pre>';

	// Writing to the output.txt file. This also creates it if it doesn't already exist.
	$file = fopen("output.txt", "w") or die("Could not open file.");
	fwrite($file, $output);
?>