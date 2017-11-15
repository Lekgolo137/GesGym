<?php
//file: view/users/usersList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$users = $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - User List"));
?>
			<h1><?=i18n("User List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Username")?></th>
								<th><?=i18n("Password")?></th>
								<th><?=i18n("Type")?></th>
								<th><?=i18n("Telephone")?></th>
								<th><?=i18n("Address")?></th>
								<th><?=i18n("City")?></th>
								<th><?=i18n("Postal Code")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as $user): ?>
							<tr>
								<td><?=$user->getUsername()?></td>
								<td><?=$user->getPasswd()?></td>
								<td><?=$user->getTipo()?></td>
								<td><?=$user->getTlf()?></td>
								<td><?=$user->getCalle()?></td>
								<td><?=$user->getCiudad()?></td>
								<td><?=$user->getCodPostal()?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=users&amp;action=view&amp;username=<?=$user->getUsername()?>"><?=i18n("View")?></a>
									<a class="btn btn-sm btn-primary" href="index.php?controller=users&amp;action=edit&amp;username=<?=$user->getUsername()?>"><?=i18n("Modify")?></a>
									<form id="<?=$user->getUsername()?>"  method="POST" action="index.php?controller=users&amp;action=delete&amp;username=<?=$user->getUsername()?>">
										<a class="btn btn-sm btn-danger" onclick="eliminar('<?=i18n("Are you sure?")?>','<?=$user->getUsername()?>')"><?=i18n("Delete")?></a>
									</form>
								</td>
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/usersList.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
