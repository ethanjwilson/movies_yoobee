<?php
    $title = "Onslow College - Director ";
    $description = "This is a demo website to show off a movie library";
    require('../includes/head.php');

    $sql = "SELECT directors.id, directors.director FROM directors ORDER BY directors.director ASC";
    $result = mysqli_query($dbc, $sql);

    if ($result) {
        $directors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        die("THIS IS NOT THE DATA YOU'RE LOOKING FOR");
    }
?>
    <main>
        <div class="container">
            <section>
                <div class="left">
                    <h2>Directors</h2>
                </div>
                <div class="right">
                    <p>
                        <a class="btn" href="addDirector.php">Add New Director</a>
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
                    <p>Director Added</p>
                </div>
            <?php endif; ?>
            <section>
                <table id="directorsTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-id="3" class="directors">
                            <?php foreach ($directors as $director): ?>
                                <td><a href="director.php?id=<?php echo $director['id'] ?>"><?php echo $director['director']; ?></a></td>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
<?php 
    require('../includes/footer.php');
?>