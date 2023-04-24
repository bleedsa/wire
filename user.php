<?php

session_start();

if (isset($_GET["u"])) {
	$u = htmlspecialchars(SQLite3::escapeString($_GET["u"]));
} else {
	header("Location: /act/err.php?m=USER%20NOT%20FOUND&goto=/");
}

$sql = new SQLite3("wire.db");

?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/theme.php">
	</head>
	<body>
		<div class="main">
			<?php include "/srv/wire/inc/top.php";?>
			<h1><?=$u?></h1>

			<?php
				$ui = $sql->query("select id from auth where (name like '$u')")->fetchArray()[0];
				$b = $sql->query("select content from bios where (user=$ui)")->fetchArray()[0];
				if ($b) {
					echo "<p>$b</p>";
				}
			?>

			<?php if (isset($_SESSION["u"]) && $_SESSION["u"] === $u): ?>
				<!-- bio form for logged in users -->
				<h3>user bio</h3>
				<form action="/act/settings.php" method="post">
					<textarea name="bio"></textarea><br>
					<input type="submit" value="go">
				</form>
			<?php endif ?>

			<p><a href="/">go back</a></p>
			<?php include "/srv/wire/inc/bottom.php";?>
		</div>
	</body>
</html>
