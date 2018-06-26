<?php 
	$title = "Onslow College - Movie";
    $description = "This is a demo website to show off a movie library";
	require('../includes/head.php');
	
	$id = $_GET['id'];
	$sql = "SELECT movies.id, title, movies.description, movies.year, movies.rating, movies.director_id, directors.id, directors.director 
			FROM movies
			INNER JOIN directors ON movies.director_id = directors.id 
			WHERE movies.id = $id
			ORDER BY movies.title ASC";
	$result = mysqli_query($dbc, $sql);
	if ($result && mysqli_affected_rows($dbc) > 0) {
		$movie = mysqli_fetch_array($result, MYSQLI_ASSOC);
	} else if (mysqli_affected_rows($dbc) == 0) {
		header("Location: error404.php");
	} else {
		die("SOMETHING WENT WRONG");
	}

?>
<main>
	<div class="container">
		<section id="alerts">
		</section>
		<section>
			<div class="left">
				<div class="editableArea" data-column="title">
					<h2><?php echo $movie['title']; ?></h2>
				</div>
				<h4><a href="director.php?id=<?php echo $movie['director_id'] ?>"><?php echo $movie['director']; ?></a></h4>
			</div>
			<div class="right">
				<p>
					<a class="btn" id="editButton">Edit Movie</a>
					<a class="btn" href="#">Delete Movie</a>
				</p>
			</div>
		</section>
		<hr>
		<section>
			<h5><?php echo $movie['rating']; ?>/5</h5>
			<p><?php echo $movie['description']; ?></p>
		</section>
	</div>
</main>
<?php 
    require('../includes/footer.php');
?>
