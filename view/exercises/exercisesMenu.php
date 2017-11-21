<?php
//file: view/users/exercisesMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Manage Exercises"));
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-6">
						<a href="index.php?controller=exercises&amp;action=add">
							<span class="glyphicon glyphicon-leaf"></span>
							<br><?=i18n("New Exercise")?>
						</a>
					</div>
					<div class="col-sm-6">
						<a href="index.php?controller=exercises&amp;action=exercisesList">
							<span class="glyphicon glyphicon-list"></span>
							<br><?=i18n("Exercises List")?>
						</a>
					</div>
				</div>
			</div>		
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/exercisesMenuStyle.css">
