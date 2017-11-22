<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");

$sessions = $view->getVariable("sessions");
$errors = $view->getVariable("errors");


?>
<div class="container">
<h1><?= i18n("Create session")?></h1>
<form class="form-signin" action="index.php?controller=sessions&amp;action=add" method="POST">
	<div class="row">
		<div class="col-sm-3">
	<?= i18n("session id") ?>: <input class="form-control" type="text" name="sessionid"
	value="<?= $sessions->getSessionid() ?>">
	<?= isset($errors["sessionid"])?i18n($errors["sessionid"]):"" ?><br>

	<?= i18n("table id") ?>: <input class="form-control" type="text" name="tableid"
	value="<?= $sessions->getTableid() ?>">
	<?= isset($errors["tableid"])?i18n($errors["tableid"]):"" ?><br>

<input type="hidden" name="username" value="<?=sprintf($currentuser)?>">

	<input class="form-control" type="submit" name="submit" value="submit">
</form>
</div></div>
</div>
