<?php
//file: view/sessions/edit.php
/*
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
$sessions = $view->getVariable("sessions");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Close Session"));
$view->setVariable("header", i18n("Close Session"));
?>
			<form class="form-signin" action="index.php?controller=sessions&amp;action=close" method="POST">

        <?= isset($errors["comentarios"])?i18n($errors["comentarios"]):"" ?>
      	<textarea rows="5" class="form-control" name="comentarios" placeholder="<?=i18n("Comentarios")?>" value=""></textarea>
      	<br/>

				<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Create new session")?>">
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=sessions&amp;action=sessionsMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addSessionStyle.css">



<form action="index.php?controller=sessions&amp;action=close" method="POST">
  <input type="hidden" name="id" value="<?= $session->getSessionId() ?>">
  <a class="btn btn-sm btn-danger" href="#" onclick="if (confirm('<?= i18n("Are you sure?")?>')) {document.getElementById('close_session_<?= $session->getSessionId() ?>').submit()}"><?= i18n("Close") ?></a>
</form>
