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
				<div><?=isset($errors["nombre"])?i18n($errors["nombre"]):""?></div>
				<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$resource->getNombre()?>" required autofocus/>
				<input type="number" name="aforo" class="form-control" placeholder="<?=i18n("Capacity")?>" value="<?=$resource->getAforo()?>"/>
				<textarea name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$resource->getDescripcion()?>"><?=$resource->getDescripcion()?></textarea>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create new resource")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=resources&amp;action=resourcesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addResourceStyle.css"/>
