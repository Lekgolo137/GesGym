<?php
//file: view/sessions/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$sessions = $view->getVariable("sessions");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - New Session"));
$view->setVariable("header", i18n("New Session"));
?>
			<form class="form-signin" action="index.php?controller=sessions&amp;action=add" method="POST">
				<input class="form-control" type="text" name="sessionid" placeholder="<?=i18n("Session ID")?>" value="<?= $sessions->getSessionid() ?>">
				<?= isset($errors["sessionid"])?i18n($errors["sessionid"]):"" ?><br>
				<input class="form-control" type="text" name="tableid" placeholder="<?=i18n("Table ID")?>" value="<?= $sessions->getTableid() ?>">
				<?= isset($errors["tableid"])?i18n($errors["tableid"]):"" ?><br>
				<input type="hidden" name="username" value="<?=sprintf($currentuser)?>">
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Create new session")?>">
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=profile"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addSessionStyle.css">
