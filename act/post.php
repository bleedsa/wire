<?php

require '../com.php';
$db = new Database("../wire.db");

/* check if user is logged in */
$me = $db->whoami();
if ($me) {
	$c = $_POST["content"];
	$cs = htmlentities(SQLite3::escapeString($c));
	$t = $_POST["thread"];
	$ts = SQLite3::escapeString($t);

	/* add to db */
	$db->exec("insert into posts (author,at,content,thread) values ({$me["id"]},strftime('%s','now'),'$cs',$ts)");
	header("Location: /thread.php?id=$t");
} else {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/login.php");
}

?>
