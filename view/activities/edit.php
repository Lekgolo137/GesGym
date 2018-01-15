<?php
//file: view/activities/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$recursosA = $view->getVariable("recursosA");
$recursos = $view->getVariable("recursos");
$entrenadores = $view->getVariable("entrenadores");
$view->setVariable("title", i18n("GesGym - Modify Activity"));
$view->setVariable("header", i18n("Modify Activity"));
?>
			<div class="row">
					<form class="form-signin" action="index.php?controller=activities&amp;action=edit&amp;id=<?=$activity->getId()?>" method="POST">
						<div class="col-sm-6">
							<?=i18n("Name")?>:
							<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>" id="nombre" required>
						</div>
					<div class="col-sm-3">
						<?=i18n("Beginning")?>:
						<input type="time" name="hora_inicio" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>" id="hora_inicio" required>
					</div>
					<div class="col-sm-3">
						<?=i18n("Ending")?>:
						<input type="time" name="hora_fin" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>" id="hora_fin" required>
					</div>
					<div class="col-sm-6">
						<?=i18n("Places")?>:
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required>
					</div>
					<div class="col-sm-6">
						<?=i18n("Trainer")?>:
						<select class="form-control" name="entrenador" id="entrenador" required>
<?php foreach ($entrenadores as $entrenador): ?>
							<option value="<?=$entrenador->getId()?>"><?=$entrenador->getUsername()?></opcion>
<?php endforeach; ?>
						</select>
					</div>
					<div class="row">
					<div class="col-sm-5">
					<?=i18n("Select days:")?>:
						<select class="form-control" name="days[]" multiple size="6" required><br>
							<option value="lunes"><?=i18n("Monday")?></opcion>
							<option value="martes"><?=i18n("Tuersday")?></opcion>
							<option value="miercoles"><?=i18n("Wednesday")?></opcion>
							<option value="jueves"><?=i18n("Thursday")?></opcion>
							<option value="viernes"><?=i18n("Friday")?></opcion>
							<option value="sabado"><?=i18n("Saturday")?></opcion>
							<option value="domingo"><?=i18n("Sunday")?></opcion>
						</select>
					</div>
					<div class="col-sm-5">
						<?=i18n("Select Resources")?>:
						<select class="form-control" name="recursos[]" id="recursos[]" multiple size="6" required>
<?php foreach ($recursos as $recurso): ?>
							<option value="<?=$recurso->getID()?>"><?=$recurso->getNombre()?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
					<div class="col-ms-12" class="form-control">
						<div><?=i18n("Description")?>:</div>
						<textarea type="text" name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$activity->getDescripcion()?>" id="descripcion"></textarea>
					</div>
						<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesList"><?=i18n("Cancel")?></a>
			</form>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editActivityStyle.css">
