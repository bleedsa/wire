<?php

session_start();

if (isset($_SESSION["u"])) {
	$u = SQLite3::escapeString($_SESSION["u"]);
	$c = htmlspecialchars(SQLite3::escapeString($_POST["bio"]));

	$sql = new SQLite3("../wire.db");
	$i = $sql->query("select id from auth where (name like '$u')")->fetchArray()[0];

	/* clear previous bio */
	$sql->exec("delete from bios where (user=$i)");
	/* insert new bio */
	$sql->exec("insert into bios (user,content) values ($i,'$c')");

	header("Location: /");
} else {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/login.php");
}

?>
