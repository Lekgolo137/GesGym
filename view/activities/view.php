<?php
//file: view/activity/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$activity = $view->getVariable("activity");
$users = $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - View Activity"));
$view->setVariable("header", i18n("View Activity"));
?>
			<div class="row">
				<div class="col-sm-6">
					<?=i18n("ID")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Activity")?>" value="<?=$activity->getActivityID()?>">
					<?=i18n("Places")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>">
				</div>
				<div class="col-sm-6">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Users")?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($users as &$user):?>
							<tr>
								<td><?=$user["username"]?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewActivityStyle.css">
