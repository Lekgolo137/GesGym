<?php
//file: view/activities/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$view->setVariable("title", i18n("GesGym - New Activity"));
$view->setVariable("header", i18n("New Activity"));
?>
			<form class="form-signin" action="index.php?controller=activities&amp;action=add" method="POST">
				<div class="row">
					<div class="col-sm-12">
						<div><?=isset($errors["activityid"])?i18n($errors["activityid"]):""?></div>
						<input type="text" name="activityid" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$activity->getActivityID()?>" required autofocus>
						<div><?=isset($errors["plazas"])?i18n($errors["plazas"]):""?></div>
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create New Activity")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addActivityStyle.css">

