<?php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$post = $view->getVariable("tables");
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - New Table"));
$view->setVariable("header", i18n("New Table"));
?>

			<form class="form-signin" action="index.php?controller=tables&amp;action=add" method="POST">
				<?= isset($errors["tableid"])?i18n($errors["tableid"]):"" ?>
				<input class="form-control" type="text" name="tableid" placeholder="<?=i18n("ID")?>" value="<?= $post->getTableid() ?>">
				<?= isset($errors["tabletipo"])?i18n($errors["tabletipo"]):"" ?>
				<div class="form-control"><?=i18n("Type")?>:
					<select name="tabletipo">
						<option value="person">person</option>
						<option value="noPerson">noPerson</option>
					</select>
				</div>
				<input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="<?=i18n("Create new table")?>">
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=tables&amp;action=tablesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addTableStyle.css">
