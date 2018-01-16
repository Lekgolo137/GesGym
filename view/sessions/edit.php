<?php
//file: view/sessions/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$sessions = $view->getVariable("sessions");
$errors = $view->getVariable("errors");
$view->setVariable("title", "GesGym - ".i18n("Close Session"));
$view->setVariable("header", i18n("Close Session"));
?>
			<form class="form-signin" action="index.php?controller=sessions&amp;action=close" method="POST">
				<?= i18n("Coments") ?>: <?= isset($errors["comentarios"])?i18n($errors["comentarios"]):"" ?>
				<textarea rows="5" class="form-control" name="comentarios" ></textarea>
				<br/>
				<input type="hidden" name="id" value="<?= $sessions->getSessionId() ?>">
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Close current session")?>">
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=sessions&amp;action=sessionsList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addSessionStyle.css">
