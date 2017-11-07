<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$view->getVariable("title","no title")?></title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/headerStyle.css">
<?=$view->getFragment("css")?>
		<script src="index.php?controller=language&amp;action=i18njs"></script>
<?=$view->getFragment("javascript")?>
	</head>
	<body>
		<header>
			<div class="container">
				<ul class="nav nav-justified">
					<li class="active"><a href="index.php?controller=posts&amp;action=index"><?=i18n("Notes")?></a></li>
					<li><a><?=i18n("Logged in as")?>: <?=sprintf($currentuser)?></a></li>
					<li><a href="index.php?controller=users&amp;action=logout"><?=i18n("Logout")?></a></li>
				</ul>
			</div>
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