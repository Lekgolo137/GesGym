<?php
//file: view/users/mainMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$users = $view->getVariable("users");
$view->setVariable("title", i18n("GesGym - Main Menu"));
?>
			<h1>Listado de Usuarios</h1>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>Nombre de usuario</th>
								<th>Contraseña</th>
								<th>Tipo de usuario</th>
								<th>Teléfono</th>
								<th>Dirección</th>
								<th>Ciudad</th>
								<th>Código postal</th>
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
							</tr>
<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/usersList.css">
