<?php use system\Babar; ?>

<!DOCTYPE html>
<html>
<head>
	<title>BabarCode :: Supermicro PHP Framework</title>
	<style type="text/css">
		*{
			font-size: 12px;
			font-family: Arial;
		}
		body{
			margin-top: 5%;
		}
		.container{
			margin:12px auto;
			width: 65%;
			background: #ecf0f1;
			border-radius: 4px;
			border:1px solid #bdc3c7;
			padding: 24px;
			box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05);
		}
		.link{
			color: #3498db; cursor: pointer;
		}
		.title{font-size: 20px;}
		small{font-size: 10px;}
	</style>
</head>
<body>
	<div align="center">
		<div class="container">
			<h3 class="title">Error</h3>
			<small><i><?=$error;?></i></small><br>
			<small>Load Time: <?=Babar::get_load_time();?> seconds</small>
		</div>
	</div>
</body>
</html>