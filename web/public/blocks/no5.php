<?php
	$data_for_tree = array(
		"f" => [
			"wp" => [
				1, 2, 3
			],
			"np" => [
				4, 5
			]
		]
	);
?>

<div class="simple-container">
	<header>5. JS</header>
	<p>Клики по элементам и ховер работают</p>
	<div class="js-drop-tree drop-tree" data-tree_data='<?= json_encode($data_for_tree) ?>'></div>
</div>