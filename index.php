<?php
require 'com.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>the wire</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/theme.php">
	</head>
	<body>
		<div class="main">
			<?php include "/srv/wire/inc/top.php";?>

			<h1>welcome to the wire</h1>

			<?php
				$sql = new SQLite3("wire.db");
				$a = $sql->query("select * from boards where not hidden");
				while ($x = $a->fetchArray()) {
					$n = $x["name"];
					echo "<div class=\"board\">";
					echo "<a href=\"/board.php?b=$n\">$n</a><br>";
					echo "<i>{$x["description"]}</i>";
					echo "</div>";
				}
			?>

			<?php include "/srv/wire/inc/bottom.php";?>
		</div>
	</body>
</html>
