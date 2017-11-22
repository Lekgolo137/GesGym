<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$tables = $view->getVariable("tables");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Modify Table"));
$view->setVariable("header", i18n("Modify Table"));
?>

<form class="form-signin" action="index.php?controller=tables&amp;action=edit" method="POST">

	<?= i18n("ID") ?>: <input disabled class="form-control" type="text" name="tableid"
	value="<?= isset($_POST["tableid"])?$_POST["tableid"]:$tables->getTableid() ?>">
	<?= isset($errors["tableid"])?i18n($errors["tableid"]):"" ?><br>

	<?= i18n("Type") ?>: <select class="form-control" name="tabletipo">
	<option value="person" <?php if ($tables->getTableTipo() == "person") print "selected"?>><?=i18n("Custom")?></option>
	<option value="noPerson" <?php if ($tables->getTableTipo() == "noPerson") print "selected"?>><?=i18n("Standard")?></option>
	<input class="form-control" type="hidden" name="id" value="<?= $tables->getTableid() ?>">
	<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?= i18n("Save changes") ?>">
</form>
<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=tables&amp;action=tablesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editTableStyle.css">
