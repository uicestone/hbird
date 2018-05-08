<?php
preg_match('/^(\d+\/\d+)\/(.*?)$/', $_GET['upload_path'], $matches);
?>
<!DOCTYPE html>
<html>
<head>
	<style>
		body {
			margin: 0;
			padding: 0;
		}
		img {
			width: 100%;
		}
	</style>
</head>
<body>
	<img src="<?=wp_upload_dir($matches[1])['url']?>/<?=$matches[2]?>">
</body>
</html>