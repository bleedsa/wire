<?php

if (!isset($_GET["b"])) {
	header("Location: /act/err.php?m=BOARD%20NOT%20FOUND&goto=/");
	exit();
}

$sql = new SQLite3("wire.db");
$e = SQLite3::escapeString($_GET["b"]);
$b = $sql->query("select * from boards where (name like '$e')")->fetchArray();
if (!$b) {
	header("Location: /act/err.php?m=BOARD%20NOT%20FOUND&goto=/");
	exit();
}
$bn = $b["name"];
$bi = $b["id"];

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$bn?> -- the wire</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/theme.php">
	</head>
	<body>
		<div class="main">
			<?php include "/srv/wire/inc/top.php";?>
			<h1><?=$bn?></h1>
			<h3>new thread</h3>
			<form method="post" action="/act/thread.php">
				name: <input type="text" name="name"><br>
				<textarea name="content"></textarea><br>
				<input type="hidden" name="board" value="<?=$bn?>">
				<input type="submit" value="post">
			</form>

			<br><br>

			<?php
				/* threads in board */
				$t = $sql->query("select * from threads where (board=$bi)");
				while ($row = $t->fetchArray()) {
					/* author name */
					$a = $sql->query("select name from auth where (id={$row["author"]})")->fetchArray()[0];

					echo "<div class=\"thread\">";
					echo "<span class=\"thread-info\"><a href=\"/thread.php?id={$row["id"]}\">{$row["name"]}</a></span>";
					echo " by <a href=\"/user.php?u=$a\">$a</a>";
					echo "</div>";
				}
			?>

			<p><a href="/">go back</a></p>

			<?php include "/srv/wire/inc/bottom.php";?>
		</div>
	</body>
</html>
