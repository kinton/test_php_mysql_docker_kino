<?php

require '../app/config/constants.php';
require '../app/config/database.php';

require '../app/src/pdo.php';

$db = new Database();

// $db->initErrorHandling();

$movie_table = $db->highLevelOp(
	"CREATE TABLE IF NOT EXISTS movie (
		movie_id int(5) unsigned NOT NULL AUTO_INCREMENT,
		title varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
		PRIMARY KEY (movie_id)
	) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT
	CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPRESSED KEY_BLOCK_SIZE=8;");

$pictures_table = $db->highLevelOp(
	"CREATE TABLE IF NOT EXISTS pictures (
		picture_id int(5) unsigned NOT NULL AUTO_INCREMENT,
		movie_id int(5) unsigned NOT NULL,
		PRIMARY KEY (picture_id)
	) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;");

if (!$movie_table)
	echo "Movie table not created<br>";

if (!$pictures_table)
	echo "Pictures table not created<br>";

if ($movie_table && $pictures_table) {
	// заполнить бд
	$kinorium_main_link = "http://ru.kinorium.com";
	$kinorium_main_html = file_get_contents($kinorium_main_link);
	$films_main_page;
	preg_match_all(
		"/<a class='link-info-movie-type-film' data-id='(\d*)' data-type='.*' href='\/\d*\/' >[ ?]<h3>(.*)<\/h3>[ ?]<h4>(.*)<\/h4>[ ?]<\/a>/U",
		$kinorium_main_html, $films_main_page, PREG_SET_ORDER);

	foreach ($films_main_page as $film) {
		$db->perform("INSERT INTO movie (title) VALUES (?)", array($film[2]));
		$film_id = $db->lastInsertId();
		if (rand(0,1) == 1) {
			$db->perform("INSERT INTO pictures (movie_id) VALUES (?)", array($film_id));
		}
	}

	echo "Done, go home now";
}

?>

<a href="/">Home</a>