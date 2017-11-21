<?php
//file: view/resources/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$resource = $view->getVariable("resource");
$view->setVariable("title", i18n("GesGym - New Resource"));
$view->setVariable("header", i18n("New Resource"));
?>
			<form class="form-signin" action="index.php?controller=resources&amp;action=add" method="POST">
				<div><?=isset($errors["id"])?i18n($errors["id"]):""?></div>
				<input type="text" name="id" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$resource->getId()?>" required autofocus>
				<div class="form-control"><?=i18n("Type")?>:
					<select name="tipo">
						<option value="material" <?php if ($resource->getTipo() == "material") print "selected"?>><?=i18n("Equipment")?></option>
						<option value="instalacion" <?php if ($resource->getTipo() == "instalacion") print "selected"?>><?=i18n("Installation")?></option>
					</select>
				</div>
				<input type="text" name="location" class="form-control" placeholder="<?=i18n("Location")?>" value="<?=$resource->getLocation()?>">
				<input type="text" name="canafo" class="form-control" placeholder="<?=i18n("Amount or Capacity")?>" value="<?=$resource->getCanafo()?>">
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create new resource")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=resources&amp;action=resourcesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addResourceStyle.css">
