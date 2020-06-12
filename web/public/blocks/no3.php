<?php

// 1)
// $db — экземпляр простого класса для доступа к бд

// 2)
$example_array = [
	"movie" => "Фильм",
	"tv_series" => "Сериал",
	"script_author" => "Автор сценария",
	"director" => "Режиссёр",
	"actor" => "Актёр"
];

// 3)
$kinorium_main_link = "http://ru.kinorium.com";
$kinorium_main_html = file_get_contents($kinorium_main_link);
// curl?
// print($kinorium_main_html);

// $example_str = '<a class="link-info-movie-type-film" data-id="1645654" data-type="film" href="/1645654/"> <h3>О бесконечности</h3> <h4>Om det oändliga</h4> </a><a class="link-info-movie-type-film" data-id="16456543" data-type="film" href="/16456543/"> <h3>Оы бесконечности</h3> <h4>Omы det oändliga</h4> </a>';
$films_main_page;
preg_match_all(
	"/<a class='link-info-movie-type-film' data-id='(\d*)' data-type='.*' href='\/\d*\/' >[ ?]<h3>(.*)<\/h3>[ ?]<h4>(.*)<\/h4>[ ?]<\/a>/U",
	$kinorium_main_html, $films_main_page, PREG_SET_ORDER);

// echo "<pre>",print_r($films_main_page),"</pre>";

?>

<div class="simple-container">
	<header>3. PHP</header>

	<h3>1)</h3>
	<p>/app/src/pdo.php</p>

	<h3>2)</h3>
	<?= print_r($example_array); ?>
	<br><br>
	<select name="example_select" id="example_select">
		<?php
			foreach ($example_array as $key => $value) {
				echo "<option value=",$key,">",$value,"</option>";
			}
		?>
	</select>

	<h3>3)</h3>
	<div class="parsed-films">
		<?php
			foreach ($films_main_page as $film) {
				?>
					<a class="film" href="http://ru.kinorium.com/<?= $film[1] ?>">
						<?= $film[1] ?> <br> <?= $film[2] ?> | <?= $film[3] ?>
					</a>
				<?php
			}
		?>
	</div>
</div>