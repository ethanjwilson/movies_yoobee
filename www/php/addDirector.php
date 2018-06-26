<?php
    $title = "Onslow College - Add Director";
    $description = "This is a demo website to show off a movie library";
    require('../includes/head.php');

    if ($_POST) {
        extract($_POST);
        //var_dump($movieTitle);
        $errors = array();
        if (!$director) {
            array_push($errors, "Title Empty");
        } else if (strlen($director) < 1) {
            array_push($errors, "Title Empty");
        } else if (strlen($director) > 100) {
            array_push($errors, "Title Too Meke");
        }

        if (empty($errors)) {
            $director = mysqli_real_escape_string($dbc, $director);

            $sql = "INSERT INTO `directors` (`id`, `director`) VALUES (NULL, '$director');";
            $result = mysqli_query($dbc, $sql);
            if ($result && mysqli_affected_rows($dbc) > 0) {
                header("Location: directors.php?success=true");
                //WORKS
            } else {
                die("THIS IS NOT THE DATA YOU'RE LOOKING FOR");
            }
        }  
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
            <form action="addDirector.php" method="post">
                <div class="form-block">
                    <label for="title">Director</label>
                    <input type="text" class="inputField" id="title" name="director" placeholder="Director" value="<?php if(isset($director)) { echo $director; } ?>">
                </div>
                <div class="form-block">
                    <button type="submit" class="btn" name="button">Add Director</button>
                </div>
            </form>
        </section>
    </div>
</main>
<?php 
    require('../includes/footer.php');
?>
