<?php
//file: view/activities/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$view->setVariable("title", i18n("GesGym - Modify Activity"));
$view->setVariable("header", i18n("Modify Activity"));
?>
			<div class="row">

					<form class="form-signin" action="index.php?controller=activities&amp;action=edit&amp;id=<?=$activity->getId()?>" method="POST">
						<div class="col-sm-6">
							<?=i18n("ID")?>:
							<input disabled type="text" name="id" class="form-control" placeholder="<?=i18n("Activity")?>" value="<?=$activity->getId()?>" required>
						</div>
						<div class="col-sm-6">
							<?=i18n("Name")?>:
							<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>" id="nombre" required>
						</div>
						<div class="col-sm-4">
						<?=i18n("Day")?>:
						<input type="text" name="dia" class="form-control" placeholder="<?=i18n("Day")?>" value="<?=$activity->getDia()?>" id="dia" required>
					</div>
					<div class="col-sm-4">
						<?=i18n("Beginning")?>:
						<input type="time" name="hora_inicio" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>" id="hora_inicio" required>
					</div>
					<div class="col-sm-4">
						<?=i18n("Ending")?>:
						<input type="time" name="hora_fin" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>" id="hora_fin" required>
					</div>
					<div class="col-sm-4">
						<?=i18n("Places")?>:
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required>
					</div>
					<div class="col-sm-8">
						<?=i18n("Trainer")?>:
						<input type="text" name="entrenador" class="form-control" placeholder="<?=i18n("Trainer")?>" value="<?=$activity->getEntrenador()?>" id="entrenador" required>
					</div>
					<div><?=isset($errors["entrenadores"])?i18n($errors["entrenadores"]):""?></div>
					<div class="col-ms-8">
						<?=i18n("Description")?>:
						<input type="text" name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$activity->getDescripcion()?>" id="descripcion">
					</div>
						<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesList"><?=i18n("Cancel")?></a>
			</form>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editActivityStyle.css">
