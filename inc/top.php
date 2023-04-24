<!-- top bar -->
<span class="top">
	<b><a href="/">the wire</a></b> |
	<?php
		if (isset($_SESSION["u"])) {
			$u = htmlspecialchars($_SESSION["u"]);
			echo "[<span class=\"you\"><a href=\"/user.php?u=$u\">$u</a></span>]";
		}
	?>
	<a href="/login.php">login</a>
	<a href="/register.php">register</a>
	<a href="/about.php">about</a> |
	<?php
		$sql = new SQLite3("/srv/wire/wire.db");
		$a = $sql->query("select name from boards");
		while ($r = $a->fetchArray()) {
			$i = $r[0];
			echo "<a href=\"/board.php?b=$i\">$i</a> ";
		}
	?>
</span>
