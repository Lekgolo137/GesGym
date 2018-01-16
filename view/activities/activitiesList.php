<?php
//file: view/activities/activitiesList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activities= $view->getVariable("activities");
$view->setVariable("title", i18n("GesGym - Activities List"));
$currentusertype = $view->getVariable("currentusertype");
?>
			<h1><?=i18n("Activities List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Name")?></th>
								<th><?=i18n("Days")?></th>
								<th><?=i18n("Beginning")?></th>
								<th><?=i18n("Ending")?></th>
								<th><?=i18n("Places")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($activities as $activity): ?>
							<tr>
								<td><?=$activity->getNombre()?></td>
								<td><?=$activity->getDia()?></td>
								<td><?=$activity->getHoraInicio()?></td>
								<td><?=$activity->getHoraFin()?></td>
								<td><?=$activity->getPlazas()?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=activities&amp;action=view&amp;id=<?=$activity->getId()?>"><?=i18n("View")?></a>
<?php if($currentusertype == "administrador"){ ?>
									<a class="btn btn-sm btn-primary" href="index.php?controller=activities&amp;action=edit&amp;id=<?=$activity->getId()?>"><?=i18n("Modify")?></a>
									<form id="<?=$activity->getId()?>"  method="POST" action="index.php?controller=activities&amp;action=delete&amp;id=<?=$activity->getId()?>">
										<a class="btn btn-sm btn-danger" onclick="eliminar('<?=i18n("Are you sure?")?>','<?=$activity->getId()?>')"><?=i18n("Delete")?></a>
									</form>
<?php } ?>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/activitiesList.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
