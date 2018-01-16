<?php
//file: view/activities/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$recursosA = $view->getVariable("recursosA");
$recursos = $view->getVariable("recursos");
$sportsmansA = $view->getVariable("sportsmansA");
$sportsmans = $view->getVariable("sportsmans");
$entrenadores = $view->getVariable("entrenadores");
$view->setVariable("title", i18n("GesGym - Modify Activity"));
$view->setVariable("header", i18n("Modify Activity"));
?>
			<form class="form-signin" action="index.php?controller=activities&amp;action=edit&amp;id=<?=$activity->getId()?>" method="POST">
				<div class="row">
					<div class="col-sm-6">
						<?=i18n("Name")?>:
						<input type="text" name="nombre" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>" id="nombre" required>
						<?=i18n("Description")?>:
						<textarea rows=5 type="text" name="descripcion" class="form-control" placeholder="<?=i18n("Description")?>" id="descripcion"><?=$activity->getDescripcion()?></textarea>
						<?=i18n("Beginning")?>:
						<input type="time" name="hora_inicio" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>" id="hora_inicio" required>
						<?=i18n("Ending")?>:
						<input type="time" name="hora_fin" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>" id="hora_fin" required>
						<?=i18n("Places")?>:
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required>
						<?=i18n("Trainer")?>:
						<select class="form-control" name="entrenador" id="entrenador" required>
							<option value="-" <?php if ($activity->getEntrenador() == null) print "selected"?>><?=i18n("None")?></option>
<?php foreach ($entrenadores as $entrenador): ?>
							<option value="<?=$entrenador->getId()?>" <?php if ($activity->getEntrenador() == $entrenador->getId()) print "selected"?>><?=$entrenador->getUsername()?></option>
<?php endforeach; ?>
						</select>
					</div>
					<div class="col-sm-6">
						<?=i18n("Days")?>:
						<select class="form-control" name="days[]" multiple size="7"><br>
							<option value="lunes" <?php if(strpos($activity->getDia(),'lunes')!==false){print "selected";}?>><?=i18n("Monday")?></option>
							<option value="martes" <?php if(strpos($activity->getDia(),'martes')!==false){print "selected";}?>><?=i18n("Tuesday")?></option>
							<option value="miercoles" <?php if(strpos($activity->getDia(),'miercoles')!==false){print "selected";}?>><?=i18n("Wednesday")?></option>
							<option value="jueves" <?php if(strpos($activity->getDia(),'jueves')!==false){print "selected";}?>><?=i18n("Thursday")?></option>
							<option value="viernes" <?php if(strpos($activity->getDia(),'viernes')!==false){print "selected";}?>><?=i18n("Friday")?></option>
							<option value="sabado" <?php if(strpos($activity->getDia(),'sabado')!==false){print "selected";}?>><?=i18n("Saturday")?></option>
							<option value="domingo" <?php if(strpos($activity->getDia(),'domingo')!==false){print "selected";}?>><?=i18n("Sunday")?></option>
						</select>
						<?=i18n("Sportsman")?>s:
						<select class="form-control" name="sportsmans[]" id="sportsmans[]" multiple size="7" >
<?php foreach ($sportsmans as $sportsman): ?>
							<option value="<?=$sportsman->getID()?>" <?php if(in_array($sportsman, $sportsmansA)){print "selected";} ?>><?=$sportsman->getUsername()?></option>
<?php endforeach; ?>
						</select>
						<?=i18n("Resources")?>:
						<select class="form-control" name="recursos[]" id="recursos[]" multiple size="7" >
<?php foreach ($recursos as $recurso): ?>
							<option value="<?=$recurso->getID()?>" <?php if(in_array($recurso, $recursosA)){print "selected";} ?>><?=$recurso->getNombre()?></option>
<?php endforeach; ?>
						</select>
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editActivityStyle.css">
