<?php
//file: view/activities/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$entrenadores = $view->getVariable("entrenadores");
$recursos = $view->getVariable("recursos");
$view->setVariable("title", i18n("GesGym - New Activity"));
$view->setVariable("header", i18n("New Activity"));
?>
			<form class="form-signin" action="index.php?controller=activities&amp;action=add" method="POST">
				<div class="row">
					<div class="col-sm-12">
						<div><?=isset($errors["nombre"])?i18n($errors["nombre"]):""?></div>
						<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>" id="nombre" required>
						<div><?=isset($errors["descripcion"])?i18n($errors["descripcion"]):""?></div>
						<textarea name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$activity->getDescripcion()?>"><?=$activity->getDescripcion()?></textarea>
						<div><?=isset($errors["dia"])?i18n($errors["dia"]):""?></div>
						<div class="col-sm-6">
						<?=i18n("Select days:")?>:
							<select class="form-control" name="days[]" multiple size="7"><br>
								<option value="lunes"><?=i18n("Monday")?></opcion>
								<option value="martes"><?=i18n("Tuersday")?></opcion>
								<option value="miercoles"><?=i18n("Wednesday")?></opcion>
								<option value="jueves"><?=i18n("Thursday")?></opcion>
								<option value="viernes"><?=i18n("Friday")?></opcion>
								<option value="sabado"><?=i18n("Saturday")?></opcion>
								<option value="domingo"><?=i18n("Sunday")?></opcion>
							</select>
						</div>
					<div class="col-sm-6">
						<?=i18n("Beginning")?>:
						<div><?=isset($errors["hora_inicio"])?i18n($errors["hora_inicio"]):""?></div>
						<input type="time" name="hora_inicio" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>" id="hora_inicio" required >
					</div>
					<div class="col-sm-6">
						<?=i18n("Ending")?>:
						<div><?=isset($errors["hora_fin"])?i18n($errors["hora_fin"]):""?></div>
						<input type="time" name="hora_fin" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>" id="hora_fin" required >
					</div>
					<div class="col-sm-6">
						<div><?=isset($errors["plazas"])?i18n($errors["plazas"]):""?></div>
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required >
					</div>
						<div><?=isset($errors["entrenador"])?i18n($errors["entrenador"]):""?></div>
					<div class="col-sm-6">
						<?=i18n("Trainer")?>:
						<select class="form-control" name="entrenador" id="entrenador" required>
<?php foreach ($entrenadores as $entrenador): ?>
							<option value="<?=$entrenador->getId()?>"><?=$entrenador->getUsername()?></opcion>
<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-12">
						<?=i18n("Select Resources")?>:<br>
						<select class="form-control" name="recursos[]" multiple size=8>
<?php foreach ($recursos as $recurso): ?>
							<option value="<?=$recurso->getID()?>"><?=$recurso->getNombre()?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create New Activity")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addActivityStyle.css">
