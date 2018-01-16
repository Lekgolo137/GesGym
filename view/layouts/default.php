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
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css"/>
		<link rel="stylesheet" type="text/css" href="css/layoutStyle.css"/>
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
<?php if( ($view->getVariable("title")) == i18n("GesGym - Resources List")){?>
					<li><a id="list" href="index.php?controller=resources&amp;action=resourcesMenu"><?=i18n("Manage Resources")?></a></li>
<?php } ?>
<?php if( ($view->getVariable("title")) == i18n("GesGym - Exercises List")){?>
					<li><a id="list" href="index.php?controller=exercises&amp;action=exercisesMenu"><?=i18n("Manage Exercises")?></a></li>
<?php } ?>
<?php if( ($view->getVariable("title")) == i18n("GesGym - Activities List")){?>
					<li><a id="list" href="index.php?controller=activities&amp;action=activitiesMenu"><?=i18n("Manage Activities")?></a></li>
<?php } ?>
<?php if( ($view->getVariable("title")) == i18n("GesGym - Sessions List")){?>
					<li><a id="list" href="index.php?controller=users&amp;action=profile"><?=i18n("Profile")?></a></li>
<?php } ?>
<?php if( ($view->getVariable("title")) == i18n("GesGym - Tables List")){?>
					<li><a id="list" href="index.php?controller=tables&amp;action=tablesMenu"><?=i18n("Manage Tables")?></a></li>
<?php } ?>
<?php if( ($view->getVariable("title")) == i18n("GesGym - Your Activities")){?>
					<li><a id="list" href="index.php?controller=users&amp;action=profile"><?=i18n("Profile")?></a></li>
<?php } ?>
<?php if( ($view->getVariable("title")) == "GesGym - ".i18n("Your Sportsmans")){?>
					<li><a id="list" href="index.php?controller=users&amp;action=profile"><?=i18n("Profile")?></a></li>
<?php } ?>
					<li><a id="user"><?=i18n("User")?>: <?=sprintf($currentuser)?> (<?php if($currentusertype == "deportista"){print i18n("Sportsman");}
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