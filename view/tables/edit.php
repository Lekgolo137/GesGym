<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$errors = $view->getVariable("errors");

?>
<div class="container">
<h1><?= i18n("Modify table") ?></h1>
<form class="form-signin" action="index.php?controller=tables&amp;action=edit" method="POST">
	<div class="row">
		<div class="col-sm-3">
	<?= i18n("tableid") ?>: <input class="form-control" type="text" name="tableid"
	value="<?= isset($_POST["tableid"])?$_POST["tableid"]:$tables->getTableid() ?>">
	<?= isset($errors["tableid"])?i18n($errors["tableid"]):"" ?><br>

	<?= i18n("tabletipo") ?>: <select class="form-control" name="tabletipo">
	<option value="person">person</option>
	<option value="noPerson">noPerson</option>

	<input class="form-control" type="hidden" name="id" value="<?= $tables->getTableid() ?>">
	<input class="form-control" type="submit" name="submit" value="<?= i18n("Modify post") ?>">
</form>
</div></div>
</div>
