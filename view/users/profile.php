<?php
//file: view/users/profile.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Profile"));
$currentuserid = $view->getVariable("currentuserid");
$currentusertype = $view->getVariable("currentusertype");
?>
			<div id="menu" class="container">
				<div class="row">
					<div class="col-sm-3">
						<a href="index.php?controller=users&amp;action=edit&amp;id=<?=$currentuserid?>">
							<span class="glyphicon glyphicon-cog"></span>
							<br><?=i18n("Modify Profile")?>
						</a>
					</div>
<?php if($currentusertype == "deportista") { ?>
					<div class="col-sm-3">
						<a href="index.php?controller=sessions&amp;action=sessionsList">
							<span class="glyphicon glyphicon-hourglass"></span>
							<br><?=i18n("Your Sessions")?>
						</a>
					</div>
					<div class="col-sm-3">
						<a href="index.php?controller=tables&amp;action=tablesListProp">
							<span class="glyphicon glyphicon-list-alt"></span>
							<br><?=i18n("Your Tables")?>
						</a>
					</div>
					<div class="col-sm-3">
						<a href="index.php?controller=activities&amp;action=myActivities">
							<span class="glyphicon glyphicon-flag"></span>
							<br><?=i18n("Your Activities")?>
						</a>
					</div>
<?php } if($currentusertype == "entrenador") { ?>
					<div class="col-sm-3">
						<a href="index.php?controller=users&amp;action=sportsmansList">
							<span class="glyphicon glyphicon-user"></span>
							<br><?=i18n("Your Sportsmans")?>
						</a>
					</div>
					<div class="col-sm-3">
						<a href="index.php?controller=activities&amp;action=myActivities">
							<span class="glyphicon glyphicon-flag"></span>
							<br><?=i18n("Your Activities")?>
						</a>
					</div>
<?php } ?>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/mainMenuStyle.css"/>
