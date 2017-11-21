<?php
//file: view/users/resourcesMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Manage Resources"));
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-6">
						<a href="index.php?controller=resources&amp;action=add">
							<span class="glyphicon glyphicon-home"></span>
							<br><?=i18n("New Resource")?>
						</a>
					</div>
					<div class="col-sm-6">
						<a href="index.php?controller=resources&amp;action=resourcesList">
							<span class="glyphicon glyphicon-list"></span>
							<br><?=i18n("Resources List")?>
						</a>
					</div>
				</div>
			</div>		
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/resourcesMenuStyle.css">
