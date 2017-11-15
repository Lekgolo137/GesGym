<?php
//file: view/users/view.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("GesGym - View User"));
$view->setVariable("header", i18n("View User"));
?>
			<div class="row">
				<div class="col-sm-6">
					<?=i18n("Username")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>">
					<?=i18n("Password")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Password")?>" value="<?=$user->getPasswd()?>">
					<?=i18n("Type")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Type")?>" value="<?php if($user->getTipo() == "cliente"){print i18n("Client");}
																												  if($user->getTipo() == "entrenador"){print i18n("Trainer");}
																												  if($user->getTipo() == "administrador"){print i18n("Administrator");} ?>">
					<?=i18n("Telephone")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Telephone")?>" value="<?=$user->getTlf()?>">
					<?=i18n("Address")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Address")?>" value="<?=$user->getCalle()?>">
					<?=i18n("City")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("City")?>" value="<?=$user->getCiudad()?>">
					<?=i18n("Postal Code")?>:
					<input disabled type="text" class="form-control" placeholder="<?=i18n("Postal Code")?>" value="<?=$user->getCodPostal()?>">
				</div>
				<div class="col-sm-6">
					<div><?=i18n("Sessions")?></div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Fecha</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
						</tbody>
					</table>
					<div><?=i18n("Activities")?></div>
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Fecha</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
							<tr>
								<td>Ejemplo</td>
								<td>Ejemplo</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=usersList"><?=i18n("Return")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/viewUserStyle.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
