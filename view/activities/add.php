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
					<div class="col-sm-6">
						<?=i18n("Name")?>:
						<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>" id="nombre" required />
						<?=i18n("Description")?>:
						<textarea name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>"><?=$activity->getDescripcion()?></textarea>
						<div class="row">
							<div class="col-sm-6">
								<?=i18n("Beginning")?>:
								<input type="time" name="hora_inicio" class="form-control" value="<?=$activity->getHoraInicio()?>" id="hora_inicio" required />
							</div>
							<div class="col-sm-6">
								<?=i18n("Ending")?>:
								<input type="time" name="hora_fin" class="form-control" value="<?=$activity->getHoraFin()?>" id="hora_fin" required />
							</div>
						</div>
						<?=i18n("Seats")?>:
						<input type="number" min="0" step="1" name="plazas" class="form-control" value="<?=$activity->getPlazas()?>" id="plazas" required />
						<?=i18n("Trainer")?>:
						<select class="form-control" name="entrenador" id="entrenador" required>
							<option value="-" selected><?=i18n("None")?></option>
<?php foreach ($entrenadores as $entrenador): ?>
							<option value="<?=$entrenador->getId()?>"><?=$entrenador->getUsername()?></option>
<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6">
						<?=i18n("Days")?>:
						<select class="form-control" name="days[]" multiple size="7">
							<option value="lunes"><?=i18n("Monday")?></option>
							<option value="martes"><?=i18n("Tuesday")?></option>
							<option value="miercoles"><?=i18n("Wednesday")?></option>
							<option value="jueves"><?=i18n("Thursday")?></option>
							<option value="viernes"><?=i18n("Friday")?></option>
							<option value="sabado"><?=i18n("Saturday")?></option>
							<option value="domingo"><?=i18n("Sunday")?></option>
						</select>
						<?=i18n("Resources")?>:
						<select class="form-control" name="recursos[]" multiple size=10>
<?php foreach ($recursos as $recurso): ?>
							<option value="<?=$recurso->getID()?>"><?=$recurso->getNombre()?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create New Activity")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addActivityStyle.css">
