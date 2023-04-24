<?php

session_start();

/* check if user is logged in */
if (isset($_SESSION["u"])) {
	$c = htmlspecialchars(SQLite3::escapeString($_POST["content"]));
	$ti = SQLite3::escapeString($_POST["thread"]);

	$sql = new SQLite3('../wire.db');

	/* author */
	/* TODO: is it safe to assume that [0] is the correct user? */
	$a = $sql->query("select id from auth where (name like '{$_SESSION["u"]}')")->fetchArray()[0];

	/* add to db */
	$sql->exec("insert into posts (author,at,content,thread) values ($a,strftime('%s','now'),'$c',$ti)");
	header("Location: /thread.php?id=$ti");
} else {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/");
}

?>
