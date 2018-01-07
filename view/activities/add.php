<?php
//file: view/activities/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$view->setVariable("title", i18n("GesGym - New Activity"));
$view->setVariable("header", i18n("New Activity"));
?>
			<form class="form-signin" action="index.php?controller=activities&amp;action=add" method="POST">
				<div class="row">
					<div class="col-sm-12">
						<div><?=isset($errors["id"])?i18n($errors["id"]):""?></div>
						<input type="text" name="id" class="form-control" placeholder="<?=i18n("ID")?>" value="<?=$activity->getId()?>" required autofocus>
						<div><?=isset($errors["nombre"])?i18n($errors["nombre"]):""?></div>
						<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>" id="nombre" required>
						<div><?=isset($errors["descripcion"])?i18n($errors["descripcion"]):""?></div>
						<textarea name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$activity->getDescripcion()?>"><?=$activity->getDescripcion()?></textarea>
						<div><?=isset($errors["dia"])?i18n($errors["dia"]):""?></div>
						<input type="text" name="dia" class="form-control" placeholder="<?=i18n("Day")?>" value="<?=$activity->getDia()?>" id="dia" required >
						<div><?=isset($errors["hora_inicio"])?i18n($errors["hora_inicio"]):""?></div>
						<input type="time" name="hora_inicio" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>" id="hora_inicio" required >
						<div><?=isset($errors["hora_fin"])?i18n($errors["hora_fin"]):""?></div>
						<input type="time" name="hora_fin" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>" id="hora_fin" required >
						<div><?=isset($errors["plazas"])?i18n($errors["plazas"]):""?></div>
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required >
						<div><?=isset($errors["entrenador"])?i18n($errors["entrenador"]):""?></div>
						<input type="text" name="entrenador" class="form-control" placeholder="<?=i18n("Trainer")?>" value="<?=$activity->getEntrenador()?>" id="entrenador" required>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create New Activity")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addActivityStyle.css">
