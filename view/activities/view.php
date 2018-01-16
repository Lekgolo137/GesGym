<?php
//file: view/activities/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activity = $view->getVariable("activity");
$users = $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - View Activity"));
$view->setVariable("header", i18n("View Activity"));
$trainer = $view->getVariable("entrenador");
$sportsmen = $view->getVariable("deportistas");
$recursos = $view->getVariable("recursos");
$currentusertype = $view->getVariable("currentusertype");
$currentuserid = $view->getVariable("currentuserid");
$currentusername = $view->getVariable("currentusername");
?>
			<div class="row">
				<div class="col-sm-6">
					<?=i18n("Name")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>">
					<?=i18n("Description")?>:
					<textarea disabled type="text" class="form-control" placeholder="<?=i18n("Description")?>"><?=$activity->getDescripcion()?></textarea>
					<?=i18n("Days")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Day")?>" value="<?=$activity->getDia()?>">
					<div class="row">
						<div class="col-sm-6">
							<?=i18n("Beginning")?>:
							<input disabled type="text" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>">
						</div>
						<div class="col-sm-6">
							<?=i18n("Ending")?>:
							<input disabled type="text" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>">
						</div>
					</div>
					<?=i18n("Places")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>">
				</div>
				<div class="col-sm-6">
<?php if(isset($trainer[0])){ ?>
					<?=i18n("Trainer")?>: <a href="index.php?controller=users&amp;action=view&amp;id=<?=$trainer[0]->getId()?>"><?=$trainer[0]->getUsername()?></a>
<?php }else{?>
					<?=i18n("Trainer")?>: <?=i18n("None")?>
<?php }?>
<?php if($currentusertype != "deportista"){ ?>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Sportsman")?></th>
								<th><?=i18n("Inscription")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as $user):?>
							<tr>
<?php foreach ($sportsmen as $man):?>
<?php if($user->getUsuario() == $man->getId()){?>
								<td><a href="index.php?controller=users&amp;action=view&amp;id=<?=$user->getUsuario()?>"><?=$man->getUsername()?></a></td>
<?php } ?>
<?php endforeach; ?>
<?php if($user->getConf()):?>
								<td><input disabled type="checkbox" checked></td>
<?php else: ?>
								<td>
									<input disabled type="checkbox">
<?php if($currentusertype == "administrador"){ ?>
									<a class="btn btn-primary btn-ms" href="index.php?controller=activities&amp;action=confUsuario&amp;id=<?=$user->getActividad()?>&amp;user=<?=$user->getUsuario()?>"><?=i18n("Confirm")?></a>
<?php } ?>
									</td>
<?php endif; ?>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
<?php } ?>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Resources")?>:</th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($recursos as $recurso):?>
						<tr>
							<td><a href="index.php?controller=resources&amp;action=view&amp;id=<?=$recurso->getId()?>"><?=$recurso->getNombre()?></a></td>
						</tr>
<?php endforeach; ?>
					</table>
				</div>
			</div>
<?php if($currentusertype == "deportista" && !in_array(new User($currentuserid, $currentusername), $sportsmen)){ ?>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=preDepor&amp;id=<?=$activity->getId()?>&amp;userid=<?=$currentuserid?>"><?=i18n("Request Inscription")?></a>
<?php }?>
<?php if($currentusertype != "administrador"){ ?>
			<a class="btn btn-lg btn-primary btn-block" href="javascript:history.back()"><?=i18n("Return")?></a>
<?php }else{ ?>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesList"><?=i18n("Return")?></a>
<?php } ?>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewActivityStyle.css"/>
