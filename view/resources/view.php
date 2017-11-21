<?php
//file: view/resources/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$resource = $view->getVariable("resource");
$view->setVariable("title", i18n("GesGym - View Resource"));
$view->setVariable("header", i18n("View Resource"));
?>
			<?=i18n("ID")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$resource->getId()?>">
			<?=i18n("Type")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Type")?>" value="<?php if($resource->getTipo() == "material"){print i18n("Equipment");}
																										  if($resource->getTipo() == "instalacion"){print i18n("Installation");} ?>">
			<?=i18n("Location")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Location")?>" value="<?=$resource->getLocation()?>">
			<?=i18n("Amount or Capacity")?>:
			<input disabled type="text" class="form-control" placeholder="<?=i18n("Amount or Capacity")?>" value="<?=$resource->getCanafo()?>">
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=resources&amp;action=resourcesList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewResourceStyle.css">
