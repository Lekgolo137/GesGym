<?php
//file: view/layouts/default.php

$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$currentusertype = $view->getVariable("currentusertype");
?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?=$view->getVariable("title","no title")?></title>
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="css/layoutStyle.css">
<?=$view->getFragment("css")?>
<?=$view->getFragment("javascript")?>
	</head>
	<body>
		<header>
			<div class="container">
				<ul class="nav nav-justified">
					<li><a href="index.php?controller=users&amp;action=mainMenu"><?=i18n("Main Menu")?></a></li>
<?php if( ($view->getVariable("title")) == i18n("GesGym - Users List")){?>
					<li><a id="list" href="index.php?controller=users&amp;action=usersMenu"><?=i18n("Manage Users")?></a></li>
<?php } ?>
					<li><a id="user"><?=i18n("User")?>: <?=sprintf($currentuser)?> (<?php if($currentusertype == "cliente"){print i18n("Client");}
																						if($currentusertype == "entrenador"){print i18n("Trainer");}
																						if($currentusertype == "administrador"){print i18n("Administrator");} ?>)</a></li>
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
<?php include(__DIR__."/languageSelect.php"); ?>
			<!-- FIN DEL FOOTER -->
		</footer>
	</body>
</html>