<?php

session_start();
$u = SQLite3::escapeString($_POST["user"]);
$p = SQLite3::escapeString($_POST["pass"]);

$sql = new SQLite3("../wire.db");
$h = $sql->query("select hash from auth where (name like '$u')")->fetchArray()["hash"];

/* we're good! */
if (password_verify($p, $h)) {
	$_SESSION["u"] = $u;
}

header("Location: /");

?>
