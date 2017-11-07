<?php
//file: view/layouts/welcome.php

$view = ViewManager::getInstance();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$view->getVariable("title","no title")?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<?=$view->getFragment("css")?>
<?=$view->getFragment("javascript")?>
	</head>
	<body>
		<header>
			<h1><?=$view->getVariable("header", "no title")?></h1>
		</header>
		<main>
			<div id="flash"><?=$view->popFlash()?></div>
			<!-- INICIO DE LA PÁGINA PRINCIPAL -->
<?=$view->getFragment(ViewManager::DEFAULT_FRAGMENT)?>
			<!-- FIN DE LA PÁGINA PRINCIPAL -->
		</main>
		<footer>
			<!-- INICIO DEL FOOTER -->
<?php include(__DIR__."/language_select_element.php"); ?>
			<!-- FIN DEL FOOTER -->
		</footer>
	</body>
</html>