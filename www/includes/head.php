<?php require('../includes/connect.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $description; ?>"/>

	<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
	<link rel="stylesheet" href="../css/styles.css">
</head>
<body>
	<header>
			<div class="container">
				<div class="left title">
					<h3><a href="index.php">Movie Library</a></h3>
				</div>
				<div class="right">
					<?php include('../includes/top_nav.php')?>
				</div>
			</div>
	</header>