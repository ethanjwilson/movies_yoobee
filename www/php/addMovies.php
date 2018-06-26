<?php
    $title = "Onslow College - Add Movies";
    $description = "This is a demo website to show off a movie library";
    require('../includes/head.php');

    if ($_POST) {
        extract($_POST);
        //var_dump($movieTitle);
        $errors = array();
        if (!$movieTitle) {
            array_push($errors, "Title Empty");
        } else if (strlen($movieTitle) < 1) {
            array_push($errors, "Title Empty");
        } else if (strlen($movieTitle) > 100) {
            array_push($errors, "Title Too Meke");
        }

        if (!$year) {
            array_push($errors, "Year Empty");
        } else if (strlen($year) < 1) {
            array_push($errors, "Year Empty");
        } else if (strlen($year) > 4) {
            array_push($errors, "Year Too Meke");
        } else if (strlen($year) != 4) {
            array_push($errors, "Year Not Right Meke");
        }

        if (!$movieDescription) {
            array_push($errors, "Description Empty");
        } else if (strlen($movieDescription) < 1) {
            array_push($errors, "Description Empty");
        }

        if (empty($errors)) {
            $movieTitle = mysqli_real_escape_string($dbc, $movieTitle);
            $year = mysqli_real_escape_string($dbc, $year);
            $directorId = mysqli_real_escape_string($dbc, $directorId);
            $movieDescription = mysqli_real_escape_string($dbc, $movieDescription);
            $rating = mysqli_real_escape_string($dbc, $rating);


            if($directorId) {

                if (!$director) {
                    array_push($errors, "Director Empty");
                } else if (strlen($director) < 1) {
                    array_push($errors, "Director Empty");
                } else if (strlen($director) > 4) {
                    array_push($errors, "Director Too Meke");
                }
                $sql = "INSERT INTO `movies` (`id`, `title`, `description`, `year`, `director_id`, `rating`) VALUES (NULL, '$movieTitle', '$movieDescription', '$year', '$directorId', '$rating');";
            } else {
                if (!$newDirector) {
                    array_push($errors, "Director Empty");
                } else if (strlen($newDirector) < 1) {
                    array_push($errors, "Director Empty");
                } else if (strlen($newDirector) > 100) {
                    array_push($errors, "Director Too Meke");
                }
                
                $sqlAddDirector = "INSERT INTO `directors` (`id`, `director`) VALUES (NULL, '$newDirector');";
                $result = mysqli_query($dbc, $sqlAddDirector);
                if ($result && mysqli_affected_rows($dbc) > 0) {
                    $newDirectorId = $dbc->insert_id;
                    $sql = "INSERT INTO `movies` (`id`, `title`, `description`, `year`, `director_id`, `rating`) VALUES (NULL, '$movieTitle', '$movieDescription', '$year', '$newDirectorId', '$rating');";
                }
            }            
            $result = mysqli_query($dbc, $sql);
            if ($result && mysqli_affected_rows($dbc) > 0) {
                header("Location: movies.php?success=true");
                //WORKS
            } else {
                die("THIS IS NOT THE DATA YOU'RE LOOKING FOR");
            }
        }  
    }

    $sql_director = "SELECT directors.id, directors.director FROM directors ORDER BY directors.director ASC";
    $result = mysqli_query($dbc, $sql_director);
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
                <h2>Add New Movie</h2>
            </div>
        </section>
        <hr>
        <?php if ($_POST && $errors): ?>
            <section class="errors">
                <ul>
                    <?php foreach($errors as $singleError): ?>
                        <li><?php echo $singleError; ?></li>
                    <?php endforeach; ?>
                </ul>
            </section>
        <?php endif; ?>
        <section>
            <form action="addMovies.php" method="post">
                <div class="form-block">
                    <label for="title">Movie Title</label>
                    <input type="text" class="inputField" id="title" name="movieTitle" placeholder="Title" value="<?php if(isset($movieTitle)) { echo $movieTitle; } ?>">
                </div>
                <div class="form-block">
                    <label for="year">Year Released</label>
                    <input type="number" class="inputField" id="year" name="year" max="9999" placeholder="Year" value="<?php if(isset($year)) { echo $year; } ?>">
                </div>
                <div class="form-block directorInput">
                    <label for="director">Director</label>
                    <input type="text" class="inputField" id="title" name="newDirector" placeholder="Director" value="<?php if(isset($newDirector)) { echo $newDirector; } ?>">
                    <select class=inputField name="directorId" value="">
                        <option value="">Or Choose Director</option>
                        <?php foreach ($directors as $singleDirector): ?> 
                            <option value="<?php if(isset($directorId)) { echo $directorId; } echo $singleDirector['id']; ?>"><?php echo $singleDirector['director']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-block">
                
                    <label for="description">Description</label>
                    <textarea name="movieDescription" rows="8" cols="80" class="inputField" placeholder="Description of Movie"><?php if(isset($movieDescription)) { echo $movieDescription; } ?></textarea>
                </div>
                <div class="form-block">
                    <label for="rating">Rating</label>
                    <select class="inputField" name="rating">
                        <option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-block">
                    <button type="submit" class="btn" name="button">Add Movie</button>
                </div>
            </form>
        </section>
    </div>
</main>
<?php 
    require('../includes/footer.php');
?>
