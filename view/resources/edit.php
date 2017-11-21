<?php
//file: view/resources/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$resource = $view->getVariable("resource");
$view->setVariable("title", i18n("GesGym - Modify Resource"));
$view->setVariable("header", i18n("Modify Resource"));
?>
			<form class="form-signin" action="index.php?controller=resources&amp;action=edit&amp;id=<?=$resource->getId()?>" method="POST">
				<?=i18n("ID")?>:
				<input disabled type="text" name="id" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$resource->getId()?>" required>
				<?=i18n("Type")?>:
				<select name="tipo">
					<option value="material" <?php if ($resource->getTipo() == "material") print "selected"?>><?=i18n("Equipment")?></option>
					<option value="instalacion" <?php if ($resource->getTipo() == "instalacion") print "selected"?>><?=i18n("Installation")?></option>
				</select>
				<br><?=i18n("Location")?>:
				<input type="text" name="location" class="form-control" placeholder="<?=i18n("Location")?>" value="<?=$resource->getLocation()?>" required>
				<?=i18n("Amount or Capacity")?>:
				<input type="text" name="canafo" class="form-control" placeholder="<?=i18n("Amount or Capacity")?>" value="<?=$resource->getCanafo()?>" required>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=resources&amp;action=resourcesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editResourceStyle.css">
