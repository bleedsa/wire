<?php

session_start();

/* check if user is logged in */
if (isset($_SESSION["u"])) {
	$n = htmlspecialchars(SQLite3::escapeString($_POST["name"]));
	$c = htmlspecialchars(SQLite3::escapeString($_POST["content"]));
	$b = SQLite3::escapeString($_POST["board"]);

	$sql = new SQLite3('../wire.db');

	/* author */
	/* TODO: is it safe to assume that [0] is the correct user? */
	$a = $sql->query("select id from auth where (name like '{$_SESSION["u"]}')")->fetchArray()[0];
	/* board id */
	$bi = $sql->query("select id from boards where (name like '$b')")->fetchArray()[0];
	$sql->exec("insert into threads (name,author,board) values ('$n',$a,$bi)");

	/* thread id */
	$i = $sql->query("select id from threads where (id=LAST_INSERT_ROWID())")->fetchArray()[0];
	$sql->exec("insert into posts (author,at,content,thread) values ($a,strftime('%s','now'),'$c',$i)");
	header("Location: /thread.php?id=$i");
} else {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/");
}

?>
