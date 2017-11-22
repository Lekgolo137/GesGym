<?php
//file: view/activities/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$activity = $view->getVariable("activity");
$user = $view->getVariable("user");
$users = $view->getVariable("users");
$date = $view->getVariable("date");
$view->setVariable("title", i18n("GesGym - Modify Activity"));
$view->setVariable("header", i18n("Modify Activity"));
?>
			<div class="row">
				<div class="col-sm-4">
					<form class="form-signin" action="index.php?controller=activities&amp;action=edit&amp;activityid=<?=$activity->getActivityID()?>" method="POST">
						<?=i18n("ID")?>:
						<input disabled type="text" name="activityid" class="form-control" placeholder="<?=i18n("Activity")?>" value="<?=$activity->getActivityID()?>" required>
						<?=i18n("Places")?>:
						<input type="number" min="0" step="1" name="plazas" class="form-control" placeholder="<?=i18n("Places")?>" value="<?=$activity->getPlazas()?>" id="plazas" required>
						<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
					</form>
				</div>
				<div class="col-sm-4">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Users")?></th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($users as &$u):?>
							<tr>
								<td><?=$u["username"]?></td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<div class="col-sm-4">
					<form class="form-signin" action="index.php?controller=activities&amp;action=edit&amp;activityid=<?=$activity->getActivityID()?>" method="POST">
						<div id="error"><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
						<?=i18n("Username")?>:
						<input type="text" name="user" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user?>">
						<?=i18n("Date")?>:
						<input type="date" name="date" class="form-control" placeholder="<?=i18n("Date")?>" value="<?=$date?>">
						<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Add User")?></button>
					</form>
				</div>
			</div>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=activities&amp;action=activitiesList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editActivityStyle.css">
