<?php
//file: view/users/profile.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Profile"));
$currentusername = $view->getVariable("currentusername");
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-6">
						<a href="index.php?controller=users&amp;action=edit&amp;username=<?=$currentusername?>">
							<span class="glyphicon glyphicon-cog"></span>
							<br><?=i18n("Modify profile")?>
						</a>
					</div>
					<div class="col-sm-6">
						<a href="index.php?controller=sessions&amp;action=index">
							<span class="glyphicon glyphicon-hourglass"></span>
							<br><?=i18n("Manage sessions")?>
						</a>
					</div>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/mainMenuStyle.css">
