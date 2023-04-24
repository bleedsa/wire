<?php

session_start();

if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
	header("Location: /act/err.php?m=THREAD%20NOT%20FOUND&goto=/");
	exit();
}

$sql = new SQLite3("wire.db");
$id = (int)(SQLite3::escapeString($_GET["id"]));

/* thread */
$t = $sql->query("select * from threads where (id=$id)")->fetchArray();
if (!$t) {
	header("Location: /act/err.php?m=THREAD%20NOT%20FOUND&goto=/");
	exit();
}
$n = $t["name"];

/* board name */
$bn = $sql->query("select name from boards where (id={$t["board"]})")->fetchArray()[0];

?>
<!DOCTYPE html>
<html>
	<head>
		<title><?=$n?> -- the wire</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/theme.php">
	</head>
	<body>
		<div class="main">
			<?php include "/srv/wire/inc/top.php";?>
			<h1><?=$n?></h1>

			<?php
				/* posts in thread */
				$p = $sql->query("select * from posts where (thread=$id)");
				while ($row = $p->fetchArray()) {
					/* author name */
					$a = $sql->query("select name from auth where (id={$row["author"]})")->fetchArray()[0];
					/* datetime string */
					date_default_timezone_set('America/Chicago');
					$d = date("M d, Y ha:i:s e", (int)($row["at"]));
					echo "<div class=\"post\">";
					$c = (isset($_SESSION["u"])) ? (($a === $_SESSION["u"]) ? " you" : "") : "";
					echo "<span class=\"post-info\">[<span class=\"$c\">$a</span>@$d]</span>";
					echo "<div class=\"post-content\">";
					echo "{$row["content"]}";
					echo "</div>";
					echo "</div>";
				}
			?>

			<h4>new post</h4>
			<form method="post" action="/act/post.php">
				<textarea name="content"></textarea>
				<input type="hidden" name="thread" value="<?=$t["id"]?>"><br>
				<input type="submit" value="post">
			</form>

			<p><a href="/board.php?b=<?=$bn?>">go back</a></p>
			<?php include "/srv/wire/inc/bottom.php";?>
		</div>
	</body>
</html>
