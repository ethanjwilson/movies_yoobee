<?php 
    $title = "Onslow College - Movies";
    $description = "This is a demo website to show off a movie library";

    require('../includes/head.php');
    $sql = "SELECT movies.id, movies.title, movies.description, movies.year, movies.director_id, directors.id, directors.director FROM movies INNER JOIN directors ON movies.director_id = directors.id ORDER BY movies.title ASC";
    $result = mysqli_query($dbc, $sql);

    if ($result) {
        $movies =  mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        die("THESE ARE NOT THE MOVIES YOUR LOOKING FOR");
    }
?>
<main>
    <div class="container">
        <section>
            <div class="left">
                <h2>All Movies</h2>
            </div>
            <div class="right">
                <p>
                    <a class="btn" href="addMovies.php">Add New Movies</a>
                </p>
            </div>
        </section>
        <hr>
        <section>
            <h3>Search</h3>
            <input class="inputField" type="text" name="" value="">
        </section>
        <?php if ($_GET): ?>
            <div class="success landing text-center" >
                <p>Movie Added</p>
            </div>
        <?php endif; ?>
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
                                <td><a href="director.php?id=<?php echo $movie['director_id'] ?>"><?php echo $movie['director']; ?></a></td>
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
</main>
<?php 
    require('../includes/footer.php');
?>