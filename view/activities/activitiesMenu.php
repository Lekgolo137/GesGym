<?php
//file: view/activities/activitiesMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Manage Activities "));
$currentusertype = $view->getVariable("currentusertype");
$currentuserid = $view->getVariable("currentuserid");
?>
			<div id="menu" class="container">
				<div class="row">
<?php if($currentusertype == "administrador"){ ?>
					<div class="col-sm-6">
						<a href="index.php?controller=activities&amp;action=add">
							<span class="glyphicon glyphicon-flag"></span>
							<br><?=i18n("New Activity")?>
						</a>
					</div>
<?php } ?>
					<div class="col-sm-6">
						<a href="index.php?controller=activities&amp;action=activitiesList">
							<span class="glyphicon glyphicon-list"></span>
							<br><?=i18n("Activities List")?>
						</a>
					</div>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/activitiesMenuStyle.css">
