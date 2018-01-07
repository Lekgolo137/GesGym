<?php
//file: view/activities/activitiesWUserList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$users= $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - Activities With Users List"));
?>
			<h1><?=i18n("Activities And Users List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("ID")?></th>
								<th><?=i18n("User")?></th>
								<th><?=i18n("Confirmed")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as $user): ?>
							<tr>
								<td><?=$user->getUsuario()?></td>
								<td><?=$user->getConf()?></td>
								<td>
									<form id="<?=$user->getUsuario()?>"  method="POST" action="index.php?controller=activities&amp;action=confUser&amp;id=<?=$user->getActividad()?>&amp;user=<?=$user->getUsuario()?>">
										<a class="btn btn-sm btn-danger" onclick="confirmar('<?=i18n("Are you sure?")?>','<?=$user->getUsuario()?>')"><?=i18n("Confirm")?></a>
									</form>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/activitiesList.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/confirmar.js"></script>
