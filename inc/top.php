<?php

$db = new Database('/srv/wire/wire.db');

?>

<!-- top bar -->
<span class="top">
	<b><a href="/">the wire</a></b> |
	<?php
		$me = $db->whoami();
		if ($me) {
			$u = htmlspecialchars($me["name"]);
			echo "[<span class=\"you\"><a href=\"/user.php?u=$u\">$u</a></span>]";
		}
	?>
	<a href="/login.php">login</a>
	<a href="/register.php">register</a>
	<a href="/about.php">about</a> |
	<?php
		$a = $db->query("select name from boards where not hidden");
		while ($r = $a->fetchArray()) {
			$i = $r[0];
			echo "<a href=\"/board.gw?b=$i\">$i</a> ";
		}
	?>
</span>
