<?php

require 'com.php';

if (!isset($_GET["b"])) {
	header("Location: /act/err.php?m=BOARD%20NOT%20FOUND&goto=/");
	exit();
}

$db = new Database("wire.db");
$me = $db->whoami();

if (!$me) {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/");
	exit();
}

$e = SQLite3::escapeString($_GET["b"]);
$b = $db->query("select * from boards where (name = '$e')")->fetchArray();
if (!$b) {
	header("Location: /act/err.php?m=BOARD%20NOT%20FOUND&goto=/");
	exit();
}
$bn = $b["name"];
$bi = $b["id"];
$bd = $b["description"];

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
			<p><i><?=$bd?></i></p>
			<h3>new thread</h3>
			<form method="post" action="/act/thread.php">
				name: <input type="text" name="name"><br>
				<textarea name="content"></textarea><br>
				<input type="hidden" name="board" value="<?=$bn?>">
				<input type="submit" value="post">
			</form>

			<br><br>

			<?php
				$v = [];
				/* threads in board */
				$t = $db->query("select * from threads where (board=$bi)");
				while ($row = $t->fetchArray()) {
					$p = $db->query(<<<SQL
						select at from posts where thread={$row["id"]}
						order by at desc
					SQL)->fetchArray();
					$p = !!$p ? $p[0] : 0;
					array_push($v, [$p, $row]);
				}

				function cmp($x, $y) {
					return $x[0] < $y[0] ? 1 : -1;
				}
				usort($v, "cmp");

				foreach ($v as $x) {
					$row = $x[1];
					/* author name */
					$a = $db->query("select name from auth where (id={$row["author"]})")->fetchArray();
					$a = $a ? $a[0] : "[???]";

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
