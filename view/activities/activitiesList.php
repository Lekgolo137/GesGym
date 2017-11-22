<?php
//file: view/activities/activitiesList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activities= $view->getVariable("activities");
$view->setVariable("title", i18n("GesGym - Activities List"));
?>
			<h1><?=i18n("Activities List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("ID")?></th>
								<th><?=i18n("Places")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($activities as $activity): ?>
							<tr>
								<td><?=$activity->getActivityID()?></td>
								<td><?=$activity->getPlazas()?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=activities&amp;action=view&amp;activityid=<?=$activity->getActivityID()?>"><?=i18n("View")?></a>
									<a class="btn btn-sm btn-primary" href="index.php?controller=activities&amp;action=edit&amp;activityid=<?=$activity->getActivityID()?>"><?=i18n("Modify")?></a>
									<form id="<?=$activity->getActivityID()?>"  method="POST" action="index.php?controller=activities&amp;action=delete&amp;activityid=<?=$activity->getActivityID()?>">
										<a class="btn btn-sm btn-danger" onclick="eliminar('<?=i18n("Are you sure?")?>','<?=$activity->getActivityID()?>')"><?=i18n("Delete")?></a>
									</form>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/activitiesList.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>