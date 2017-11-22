<?php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$post = $view->getVariable("tables");
$errors = $view->getVariable("errors");


?>
<div class="container">
<h1><?= i18n("Create table")?></h1>
<form class="form-signin" action="index.php?controller=tables&amp;action=add" method="POST">
	<div class="row">
		<div class="col-sm-3">
	<?= i18n("Tableid") ?>: <input class="form-control" type="text" name="tableid"
	value="<?= $post->getTableid() ?>">
	<?= isset($errors["tableid"])?i18n($errors["tableid"]):"" ?><br>

	<?= i18n("tabletipo") ?>: <select class="form-control" name="tabletipo">
	<option value="person">person</option>
	<option value="noPerson">noPerson</option>
	<?= isset($errors["tabletipo"])?i18n($errors["tabletipo"]):"" ?><br>

	<input class="form-control" type="submit" name="submit" value="submit">
</form>
</div></div>
</div>
