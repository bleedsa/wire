<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/css/theme.php">
	</head>
	<body>
		<div class="main">
			<h1>
				<?php echo htmlspecialchars($_GET["m"]);?>
			</h1>

			<p><a href="<?php echo htmlspecialchars($_GET["goto"])?>">go back</a></p>
		</div>
	</body>
</html>
