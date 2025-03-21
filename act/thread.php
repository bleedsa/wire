<?php

include '../com.php';

$db = new Database("../wire.db");

/* check if user is logged in */
$me = $db->whoami();
if ($me) {
	$n = htmlentities(SQLite3::escapeString($_POST["name"]));
	$c = htmlentities(SQLite3::escapeString($_POST["content"]));
	$b = SQLite3::escapeString($_POST["board"]);

	/* author */
	/* TODO: is it safe to assume that [0] is the correct user?
	   NOTE(@skylar): definitely not
	 */
	$a = $db->query("select id from auth where (name = '{$me["name"]}')")->fetchArray()[0];
	/* board id */
	$bi = $db->query("select id from boards where (name = '$b')")->fetchArray()[0];
	$db->exec("insert into threads (name,author,board,hidden) values ('$n',$a,$bi,false)");

	/* thread id */
	$i = $db->query("select id from threads where (id=LAST_INSERT_ROWID())")->fetchArray()[0];
	$db->exec("insert into posts (author,at,content,thread) values ($a,strftime('%s','now'),'$c',$i)");
	header("Location: /thread.php?id=$i");
} else {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/");
}

?>
