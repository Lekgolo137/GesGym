<?php
//file: view/activities/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activity = $view->getVariable("activity");
$users = $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - View Activity"));
$view->setVariable("header", i18n("View Activity"));
$currentusertype = $view->getVariable("currentusertype");
$currentuserid = $view->getVariable("currentuserid");
?>
			<div class="row">
				<div><?=isset($errors["usuario"])?i18n($errors["usuario"]):""?></div>
				<div class="col-sm-6">
					<?=i18n("Name")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$activity->getNombre()?>">
				</div>
				<div class="col-sm-6">
					<?=i18n("Id")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Id")?>" value="<?=$activity->getId()?>">
				</div>
				<div class="col-sm-6">
					<?=i18n("Day")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Day")?>" value="<?=$activity->getDia()?>">
				</div>
				<div class="col-sm-3">
					<?=i18n("Beginning")?>:
					<input disabled type="time" class="form-control" placeholder="<?=i18n("Beginning")?>" value="<?=$activity->getHoraInicio()?>">
				</div>
				<div class="col-sm-3">
					<?=i18n("Ending")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Ending")?>" value="<?=$activity->getHoraFin()?>">
				</div>
				<div class="col-sm-6">
					<?=i18n("Places")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>">
				</div>
				<div class="col-sm-6">
					<?=i18n("Trainer")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Trainer")?>" value="<?=$activity->getEntrenador()?>">
				</div>
<?php if($currentusertype == "administrador"){ ?>
				<div class="col-sm-12">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Users")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as &$user):?>
							<tr>
								<td><?=$user->getUsuario()?></td>
					<?php if($user->getConf()):?>
								<td><input disabled type="checkbox" checked>
					<?php else: ?>
								<td><input disabled type="checkbox">
					<?php endif; ?>
								<a class="btn btn-primary btn-ms" href="index.php?controller=activities&amp;action=confUsuario&amp;id=<?=$user->getActividad()?>&amp;user=<?=$user->getUsuario()?>"><?=i18n("Confirm")?></a>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
<?php }?>
				<div class="col-sm-12">
					<?=i18n("Description")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$activity->getDescripcion()?>">
				</div>
			</div>
<?php if($currentusertype == "deportista"){ ?>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=preDepor&amp;id=<?=$activity->getId()?>&amp;userid=<?=$currentuserid?>"><?=i18n("Check in")?></a>
<?php }?>
			<a class="btn btn-lg btn-primary btn-block" href="javascript:history.back()"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewActivityStyle.css"/>
