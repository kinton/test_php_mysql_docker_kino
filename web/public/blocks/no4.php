<?php

// 1)
$first_films = $db->select(
	"SELECT movie_id, title FROM movie WHERE
		NOT EXISTS (SELECT picture_id FROM pictures WHERE movie.movie_id = pictures.movie_id)
	ORDER BY movie_id ASC LIMIT 10");

// 2)
$no_photo_films_count = $db->selectColumn(
	"SELECT count(*) FROM movie WHERE
		NOT EXISTS (SELECT picture_id FROM pictures WHERE movie.movie_id = pictures.movie_id)");
?>

<div class="simple-container">
	<header>4. SQL</header>
	
	<h3>0)</h3>
	<a href="/init_db">Перейдите по ссылке, чтобы создать и заполнить таблицы</a>
	<p>Это понадится здесь и далее</p>

	<h3>1)</h3>
	<b>10 первых фильмов без фото</b>
	<div class="no-photo-10">
		<?php
			if ($first_films)
				foreach ($first_films as $film) {
					?>
						<div class="film"><?= $film['title'] ?></div>
					<?php
				}
		?>
	</div>

	<h3>2)</h3>
	<b>Количество фильмов без фото: </b> <?= $no_photo_films_count ? $no_photo_films_count : 0 ?>

</div>