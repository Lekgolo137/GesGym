<?php
//file: view/layouts/welcome.php

$view = ViewManager::getInstance();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$view->getVariable("title","Gym")?></title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/layoutStyle.css"/>
<?=$view->getFragment("css")?>
<?=$view->getFragment("javascript")?>
	</head>
	<body>
		<header>
			<h1><?=$view->getVariable("header", "Gym")?></h1>
		</header>
		<main>
			<div id="flash"><?=$view->popFlash()?></div>
			<!-- INICIO DE LA PÁGINA PRINCIPAL -->
<?=$view->getFragment(ViewManager::DEFAULT_FRAGMENT)?>
			<!-- FIN DE LA PÁGINA PRINCIPAL -->
		</main>
		<footer>
			<!-- INICIO DEL FOOTER -->
<?php include(__DIR__."/languageSelect.php"); ?>
			<!-- FIN DEL FOOTER -->
		</footer>
	</body>
</html>
