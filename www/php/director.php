<?php 
	$title = "Onslow College - Movie";
    $description = "This is a demo website to show off a movie library";
	require('../includes/head.php');
	
	$id = $_GET['id'];
	$sql = "SELECT movies.id, title, movies.description, movies.year, movies.rating, movies.director_id, directors.id, directors.director 
            FROM movies
            INNER JOIN directors ON movies.director_id = directors.id 
            WHERE movies.director_id = $id
            ORDER BY movies.title ASC";
	$result = mysqli_query($dbc, $sql);
	if ($result && mysqli_affected_rows($dbc) > 0) {
		$movies = mysqli_fetch_all($result, MYSQLI_ASSOC);
	} else if (mysqli_affected_rows($dbc) == 0) {
		header("Location: error404.php");
	} else {
		die("SOMETHING WENT WRONG");
	}

?>
	<div class="container">
        <section>
            <div class="left">
                <h2>All Movies By <?php echo $movies[0]['director']; ?></h2>
            </div>
            <div class="right">
				<p>
					<a class="btn" id="editButton">Edit Director</a>
					<a class="btn" href="#">Delete Director</a>
				</p>
			</div>
        </section>
        <hr>
        <section>
            <h3>Search</h3>
            <input class="inputField" type="text" name="" value="">
        </section>
        <section class="movieTable">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Director</th>
                        <th>Descriptions</th>
                        <th>Year Released</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($movies): ?>
                        <?php foreach ($movies as $movie): ?>
                            <tr class="movies">
                                <td><a href="movie.php?id=<?php echo $movie['id'] ?>"><?php echo $movie['title']; ?></a></td>
                                <td><?php echo $movie['director']; ?></td>
                                <td><?php echo $movie['description']; ?></td>
                                <td><?php echo $movie['year']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>There are no movies</p>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
	</div>
<?php 
    require('../includes/footer.php');
?>
