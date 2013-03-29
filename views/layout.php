<!DOCTYPE html>
<html>
<head>
	<meta charset="uft-8" />
	<title>Redis inspector</title>
	<link rel="stylesheet" type="text/css" href="assets/style.css" />
</head>
<body>
	<header>
		<h1><a href="<?php echo $_SERVER['SCRIPT_NAME']?>">Redis inspector</a></h1>
		<form action="#" method="post">
			<p class="separator"><label>separator <input type="text" name="separator" value="<?php echo get_config('separator') ?>" placeholder="separator" /></label></p>
			<p class="prefix"><label>prefix <input type="text" name="prefix" value="<?php echo get_config('prefix') ?>" placeholder="prefix" /></label></p>
			<p class="limit"><label>limit <input type="text" name="limit" value="<?php echo get_config('limit') ?>" placeholder="limit" /></label></p>
			<p class="db"><label>db <input type="text" name="db" value="<?php echo get_config('db') ?>" placeholder="db" /></label></p>
			<p class="port"><label>port <input type="text" name="port" value="<?php echo get_config('port') ?>" placeholder="port" /></label></p>
			<p class="host"><label>host <input type="text" name="host" value="<?php echo get_config('host') ?>" placeholder="host" /></label></p>
			<p><input type="submit" value="save" /></p>
			<p><input type="submit" value="reset" name="reset" class="reset" /></p>
		</form>
	</header>
	<?php echo $content_for_layout; ?>
</body>
</html>
