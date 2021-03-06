<?php
//file: view/users/mainMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Main Menu"));
$currentusertype = $view->getVariable("currentusertype");
?>
<div id="menu" class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<a href="index.php?controller=users&amp;action=profile">
				<span class="glyphicon glyphicon-cog"></span>
				<br><?=i18n("Profile")?>
			</a>
		</div>
		<?php if($currentusertype == "deportista"){ ?>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=sessions&amp;action=add">
					<span class="glyphicon glyphicon-hourglass"></span>
					<br><?=i18n("Create new session")?>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=tables&amp;action=tablesListPublic">
					<span class="glyphicon glyphicon-list"></span>
					<br><?=i18n("Tables List")?>
				</a>
			</div>
		<?php } ?>
		<?php if($currentusertype == "entrenador"){ ?>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=exercises&amp;action=exercisesMenu">
					<span class="glyphicon glyphicon-leaf"></span>
					<br><?=i18n("Manage Exercises")?>
				</a>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=tables&amp;action=tablesMenu">
					<span class="glyphicon glyphicon-list-alt"></span>
					<br><?=i18n("Manage Tables")?>
				</a>
			</div>
		<?php } ?>
		<?php if($currentusertype != "administrador"){ ?>

		<?php } ?>
		<?php if($currentusertype != "entrenador"){ ?>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=activities&amp;action=activitiesMenu">
					<span class="glyphicon glyphicon-flag"></span>
					<br><?=i18n("Manage Activities")?>
				</a>
			</div>
		<?php } ?>
		<?php if($currentusertype != "deportista"){ ?>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=users&amp;action=usersMenu">
					<span class="glyphicon glyphicon-user"></span>
					<br><?=i18n("Manage Users")?>
				</a>
			</div>
		<?php } ?>
		<?php if($currentusertype == "administrador"){ ?>
			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<a href="index.php?controller=resources&amp;action=resourcesMenu">
					<span class="glyphicon glyphicon-home"></span>
					<br><?=i18n("Manage Resources")?>
				</a>
			</div>
		<?php } ?>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<a href="index.php?controller=users&amp;action=schedule">
				<span class="glyphicon glyphicon-time"></span>
				<br><?=i18n("Schedule")?>
			</a>
		</div>
	</div>
</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/mainMenuStyle.css"/>
