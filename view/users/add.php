<?php
//file: view/users/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("GesGym - New User"));
$view->setVariable("header", i18n("New User"));
?>
			<form class="form-signin" action="index.php?controller=users&amp;action=add" method="POST">
				<div class="row">
					<div class="col-sm-6">
						<div><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
						<input type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>" required autofocus>
						<div><?=isset($errors["passwd"])?i18n($errors["passwd"]):""?></div>
						<input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>" value="<?=$user->getPasswd()?>" id="password" required>
						<input type="password" class="form-control" placeholder="<?=i18n("Repeat password")?>" value="<?=$user->getPasswd()?>" oninput="check(this)" required>
						<div class="form-control"><?=i18n("Type")?>:
							<select name="tipo">
								<option value="cliente" <?php if ($user->getTipo() == "cliente") print "selected"?>><?=i18n("Client")?></option>
								<option value="entrenador" <?php if ($user->getTipo() == "entrenador") print "selected"?>><?=i18n("Trainer")?></option>
								<option value="administrador" <?php if ($user->getTipo() == "administrador") print "selected"?>><?=i18n("Administrator")?></option>
							</select>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="tel" name="tlf" class="form-control" placeholder="<?=i18n("Telephone")?>" value="<?=$user->getTlf()?>" required>
						<input type="text" name="calle" class="form-control" placeholder="<?=i18n("Address")?>" value="<?=$user->getCalle()?>">
						<input type="text" name="ciudad" class="form-control" placeholder="<?=i18n("City")?>" value="<?=$user->getCiudad()?>">
						<input type="text" name="codPostal" class="form-control" placeholder="<?=i18n("Postal Code")?>" value="<?=$user->getCodPostal()?>">
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create new user")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=usersMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addUserStyle.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
