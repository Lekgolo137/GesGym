<?php
//file: view/tables/sessionsMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", "GesGym - ".i18n("Manage Sessions"));
$currentusertype = $view->getVariable("currentusertype");
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-6">
					  <a href="index.php?controller=sessions&amp;action=add">
						<span class="glyphicon glyphicon-hourglass"></span>
						<br><?=i18n("Create new session")?>
					  </a>
					</div>
					<div class="col-sm-6">
						<a href="index.php?controller=sessions&amp;action=sessionsList">
							<span class="glyphicon glyphicon-list"></span>
							<br><?=i18n("Sessions List")?>
						</a>
					</div>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/tablesMenuStyle.css">
