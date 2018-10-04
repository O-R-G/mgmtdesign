<?php
// path to config file
$config = $_SERVER["DOCUMENT_ROOT"];
$config = $config."/open-records-generator/config/config.php";
require_once($config);

// specific to this 'app'
// $config_dir = $root."config/";
// require_once($config_dir."url.php");
// require_once($config_dir."request.php");

$db = db_connect("guest");

$oo = new Objects();
$mm = new Media();
$ww = new Wires();
$uu = new URL();
// $rr = new Request();

// self
if($uu->id)
	$item = $oo->get($uu->id);
else
	$item = $oo->get(0);
$name = ltrim(strip_tags($item["name1"]), ".");

// document title
$item = $oo->get($uu->id);
$title = $item["name1"];

$itemParents = $oo->ancestors($item['id']);
if (count($itemParents) > 0)
	$parent = $oo->get($itemParents[0]);

// $nav = $oo->nav($uu->ids);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>the-copy <?php if ($title) echo '/ '. ltrim($title,'.'); ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<link rel="stylesheet" href="<?= $host; ?>static/css/global.css">
		<script src="static/js/analytics.js"></script>
	</head>
<body>

	<div id='name' class='nameContainer Menu'>
		<ul>
			<li class = 'listActive'><a href='/'><img id='logo' src="/media/logo.png"></a><br/></li>
		</ul>
	</div>

	<div id='line' class='DotLineContainer'></div>
