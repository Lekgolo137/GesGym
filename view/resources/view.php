<?php
//file: view/resources/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$resource = $view->getVariable("resource");
$activities = $view->getVariable("activities");
$view->setVariable("title", i18n("GesGym - View Resource"));
$view->setVariable("header", i18n("View Resource"));
?>
			<div class="row">
				<div class="col-sm-6">
					<?=i18n("Name")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Name")?>" value="<?=$resource->getNombre()?>">
					<?=i18n("Aforo")?>:
					<input disabled type="number" class="form-control" placeholder="<?=i18n("Capacity")?>" value="<?=$resource->getAforo()?>">
					<?=i18n("Description")?>:
					<textarea disabled class="form-control" placeholder="<?=i18n("Description")?>" value="<?=$resource->getDescripcion()?>"><?=$resource->getDescripcion()?></textarea>
				</div>
				<div class="col-sm-6">
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<thead>
								<tr>
									<th><?=i18n("Activities that use this resource")?></th>
								</tr>
							</thead>
							<tbody>
<?php foreach ($activities as $activity): ?>
								<tr>
									<td><a href="index.php?controller=activities&amp;action=view&amp;id=<?=$activity->getId()?>"><?=$activity->getNombre()?></a></td>
								</tr>
<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=resources&amp;action=resourcesList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewResourceStyle.css">
