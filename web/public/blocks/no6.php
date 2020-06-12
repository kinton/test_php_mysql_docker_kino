<?php
	// $films = array(
	// 	"f" => [
	// 		"wp" => [
	// 			1, 2, 3
	// 		],
	// 		"np" => [
	// 			4, 5
	// 		]
	// 	]
	// );
	$films = $db->select(
		"SELECT movie.movie_id, movie.title, pictures.picture_id as image
		FROM movie LEFT JOIN pictures ON movie.movie_id = pictures.movie_id");
	$films_to_render = array(
		"Фильмы" => [
			"Фильмы с кадрами" => [],
			"Фильмы без кадров" => []
		]
	);
	if ($films)
		foreach ($films as $film) {
			if ((int)$film['image'] == 0)
				array_push($films_to_render["Фильмы"]["Фильмы без кадров"], $film['title']);
			else
				array_push(
					$films_to_render["Фильмы"]["Фильмы с кадрами"],
					$film['title'].", изображение: ".$film['image']);
		}
?>

<div class="simple-container last-tree-container">
	<header>6. Result</header>
	<div class="js-drop-tree drop-tree" data-tree_data='<?= json_encode($films_to_render) ?>'></div>
</div>