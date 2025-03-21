<?php

session_start();

if (isset($_SESSION["u"])) {
	$u = $_SESSION["u"];
	$us = SQLite3::escapeString($u);
	$c = $_POST["bio"];
	$cs = SQLite3::escapeString($c);

	$sql = new SQLite3("../wire.db");
	$i = $sql->query("select id from auth where (name = '$us')")->fetchArray();
	if (!$i) {
		header("Location: /act/err.php?m=USER%20NOT%20%FOUND&goto=/");
		exit();
	} else {
		$i = $i[0];
	}

	/* clear previous bio */
	$sql->exec("delete from bios where (user=$i)");
	/* insert new bio */
	$sql->exec("insert into bios (user,content) values ($i,'$cs')");

	header("Location: /");
} else {
	header("Location: /act/err.php?m=NOT%20LOGGED%20IN&goto=/login.php");
}

?>
