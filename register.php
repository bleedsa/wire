<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/theme.php">
	</head>
	<body>
		<div class="main">
			<h1>register</h1>
			<form method="post" action="/act/register.php">
				username: <input type="text" name="user"><br>
				password: <input type="password" name="pass"><br>
				<input type="submit" value="go">
			</form>
			<p><a href="/">go home</a></p>
			<?php include "/srv/wire/inc/bottom.php";?>
		</div>
	</body>
</html>
