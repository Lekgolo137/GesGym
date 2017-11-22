<?php
//file: view/users/profile.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Profile"));
$currentusername = $view->getVariable("currentusername");
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-4">
						<a href="index.php?controller=users&amp;action=editProfile">
							<span class="glyphicon glyphicon-cog"></span>
							<br><?=i18n("Modify Profile")?>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="index.php?controller=sessions&amp;action=add">
							<span class="glyphicon glyphicon-hourglass"></span>
							<br><?=i18n("New Session")?>
						</a>
					</div>
					<div class="col-sm-4">
						<a href="index.php?controller=sessions&amp;action=sessionsList">
							<span class="glyphicon glyphicon-list"></span>
							<br><?=i18n("Sessions List")?>
						</a>
					</div>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/mainMenuStyle.css">
