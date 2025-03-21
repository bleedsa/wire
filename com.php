<?php

function is($x) {
	return isset($x) && strlen($x) > 0;
}

class Database {
	public $sql;

	public function __construct($f) {
		$this->sql = new SQLite3($f);
	}

	public function query($x) {
		return $this->sql->query($x);
	}

	public function exec($x) {
		return $this->sql->exec($x);
	}

	public function whoami() {
		if (isset($_COOKIE["sesh"])) {
			$h = $_COOKIE["sesh"];

			$a = $this->query("select user from sessions where hash = '$h'")->fetchArray();
			if (!$a) return false;
			$i = $a[0];
			
			$u = $this->query("select * from auth where id = $i")->fetchArray();
			if (!$u) return false;
			return $u;

		}
		return false;
	}
}

?>
