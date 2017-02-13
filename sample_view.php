<!DOCTYPE html>
<html>
<head>
	<title>BabarCode {<?=$version;?>} :: a super micro PHP framework</title>
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
			background: #fff;
			border-radius: 4px;
			border:1px solid #bdc3c7;
			padding: 24px;
			box-shadow: 0 2px 2px rgba(0, 0, 0, 0.05);
		}
		.link{
			color: #3498db; cursor: pointer;
		}
		.title{font-size: 20px; color: #3498db;}
		small{font-size: 10px;color:#1abc9c;}
	</style>
</head>
<body>
	<div align="center">
		<div class="container">
			<h3 class="title">BabarCode {<?=$version;?>}</h3>
			<small><i>a super micro PHP framework</i></small><br>
			<small>Load Time: <?=$load_time;?> seconds</small>
		</div>
	</div>
</body>
</html>