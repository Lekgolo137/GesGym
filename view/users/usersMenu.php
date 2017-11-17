<?php
//file: view/users/mainMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Manage Users"));
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-6">
						<a href="index.php?controller=users&amp;action=add">
							<span class="glyphicon glyphicon-user"></span>
							<br><?=i18n("New User")?>
						</a>
					</div>
					<div class="col-sm-6">
						<a href="index.php?controller=users&amp;action=usersList">
							<span class="glyphicon glyphicon-list"></span>
							<br><?=i18n("Users List")?>
						</a>
					</div>
				</div>
			</div>		
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/usersMenuStyle.css">
