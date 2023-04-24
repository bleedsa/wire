<?php

/* TODO: is this safe? */
$u = htmlspecialchars(SQLite3::escapeString($_POST["user"]));
$p = SQLite3::escapeString($_POST["pass"]);

$sql = new SQLite3('../wire.db');
/* check if user already exists */
if (!$sql->query("select * from auth where (name like '$u')")) {
	/* if user already exists, error */
	header("Location: /act/err.php?m=user%20exists&goto=/register.php");
	exit(0);
}

/* TODO: is this a good enough hashing function? */
$h = password_hash($p, PASSWORD_DEFAULT);
/* get user ip */
$ip = $_SERVER[(isset($_SERVER['HTTP_X_FORWARDED_FOR'])) ? 'HTTP_X_FORWARDED_FOR' : 'REMOTE_ADDR'];

$sql->exec("insert into auth(name,hash,ip) values('$u','$h','$ip')");

header("Location: /");

?>
