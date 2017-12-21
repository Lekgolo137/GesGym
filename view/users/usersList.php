<?php
//file: view/users/sessionsList.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$users = $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - Users List"));
$currentusertype = $view->getVariable("currentusertype");
?>
			<h1><?=i18n("Users List")?></h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th><?=i18n("Username")?></th>
								<th><?=i18n("Type")?></th>
								<th><?=i18n("Card")?></th>
								<th><?=i18n("Actions")?></th>
							</tr>
						</thead>
						<tbody>
<?php foreach ($users as $user): ?>
<?php if ($currentusertype == "administrador" || ($currentusertype == "entrenador" && $user->getTipo() == "deportista")) { ?>
							<tr>
								<td><?=$user->getUsername()?></td>
								<td><?php if($user->getTipo() == "deportista"){print i18n("Sportsman");}
										  if($user->getTipo() == "entrenador"){print i18n("Trainer");}
										  if($user->getTipo() == "administrador"){print i18n("Administrator");} ?></td>
								<td><?php if($user->getSubtipo() == null){print i18n("None");}
										  if($user->getSubtipo() == "tdu"){print i18n("College Sports");}
										  if($user->getSubtipo() == "pef"){print i18n("Get Fit");} ?></td>
								<td>
									<a class="btn btn-sm btn-success" href="index.php?controller=users&amp;action=view&amp;id=<?=$user->getId()?>"><?=i18n("View")?></a>
									<a class="btn btn-sm btn-primary" href="index.php?controller=users&amp;action=edit&amp;id=<?=$user->getId()?>"><?=i18n("Modify")?></a>
									<form id="<?=$user->getId()?>"  method="POST" action="index.php?controller=users&amp;action=delete&amp;id=<?=$user->getId()?>">
										<a class="btn btn-sm btn-danger" onclick="eliminar('<?=i18n("Are you sure?")?>','<?=$user->getId()?>')"><?=i18n("Delete")?></a>
									</form>
								</td>
							</tr>
<?php } ?>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/usersList.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/eliminar.js"></script>
