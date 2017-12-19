<?php
//file: view/resources/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$resource = $view->getVariable("resource");
$view->setVariable("title", i18n("GesGym - Modify Resource"));
$view->setVariable("header", i18n("Modify Resource"));
?>
			<form class="form-signin" action="index.php?controller=resources&amp;action=edit&amp;id=<?=$resource->getId()?>" method="POST">
				<?=i18n("Name")?>:
				<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$resource->getNombre()?>" required/>
				<?=i18n("Capacity")?>:
				<input type="number" name="aforo" class="form-control" placeholder="<?=i18n("Capacity")?>" value="<?=$resource->getAforo()?>"/>
				<?=i18n("Description")?>:
				<textarea name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$resource->getDescripcion()?>"><?=$resource->getDescripcion()?></textarea>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=resources&amp;action=resourcesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editResourceStyle.css"/>
