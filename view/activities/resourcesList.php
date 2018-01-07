<?php
//file: view/activities/resourcesList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$resources = $view->getVariable("recursos");
$actividad = $view->getVariable("actividad");
$view->setVariable("title", i18n("GesGym - Resources List"));
?>
			<h1><?=i18n("Resources List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Name")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($resources as $resource): ?>
							<tr>
								<td><?=$resource->getNombre()?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=resources&amp;action=view&amp;id=<?=$resource->getId()?>"><?=i18n("View")?></a>
									<form id="<?=$resource->getId()?>"  method="POST" action="index.php?controller=activities&amp;action=deleteResource&amp;recurso=<?=$resource->getId()?>&amp;id=<?=$actividad?>">
										<a class="btn btn-sm btn-danger" onclick="eliminar('<?=i18n("Are you sure?")?>','<?=$resource->getId()?>')"><?=i18n("Delete")?></a>
									</form>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<a class="btn btn-sm btn-primary" href="index.php?controller=activities&amp;action=addResource&amp;id=<?=$actividad?>"><?=i18n("Add Resource")?></a>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/resourcesList.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
