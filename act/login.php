<?php

$u = SQLite3::escapeString($_POST["user"]);
$p = SQLite3::escapeString($_POST["pass"]);

$sql = new SQLite3("../wire.db");
$h = $sql->query("select * from auth where (name = '$u')")->fetchArray();

/* we're good! */
if (!!$h && password_verify($p, $h["hash"])) {
	/* session hash */
	$s = bin2hex(random_bytes(32));

	$sql->exec("insert into sessions (user,hash) values ({$h["id"]},'$s')");
	setcookie("sesh", $s, time() + (10 * 365 * 12 * 60 * 60), "/");

	header("Location: /");
} else {
	header("Location: /act/err.php?m=INVALID%20CREDENTIALS&goto=/login.php");
}

?>
