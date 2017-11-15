<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("GesGym - Modify User"));
$view->setVariable("header", i18n("Modify User"));
?>
			<form class="form-signin" action="index.php?controller=users&amp;action=edit&amp;username=<?=$user->getUsername()?>" method="POST">
				<div class="row">
					<div class="col-sm-6">
						<div><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
						<?=i18n("Username")?>:
						<input disabled type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>" required>
						<div><?=isset($errors["passwd"])?i18n($errors["passwd"]):""?></div>
						<?=i18n("Password")?>:
						<input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>" value="<?=$user->getPasswd()?>" id="password" required>
						<?=i18n("Repeat password")?>:
						<input type="password" class="form-control" placeholder="<?=i18n("Repeat password")?>" value="<?=$user->getPasswd()?>" oninput="check(this)" required>
						<?=i18n("Type")?>:
						<select name="tipo">
							<option value="cliente" <?php if ($user->getTipo() == "cliente") print "selected"?>><?=i18n("Client")?></option>
							<option value="entrenador" <?php if ($user->getTipo() == "entrenador") print "selected"?>><?=i18n("Trainer")?></option>
							<option value="administrador" <?php if ($user->getTipo() == "administrador") print "selected"?>><?=i18n("Administrator")?></option>
						</select>
					</div>
					<div class="col-sm-6">
						<?=i18n("Telephone")?>:
						<input type="tel" name="tlf" class="form-control" placeholder="<?=i18n("Telephone")?>" value="<?=$user->getTlf()?>" required>
						<?=i18n("Address")?>:
						<input type="text" name="calle" class="form-control" placeholder="<?=i18n("Address")?>" value="<?=$user->getCalle()?>">
						<?=i18n("City")?>:
						<input type="text" name="ciudad" class="form-control" placeholder="<?=i18n("City")?>" value="<?=$user->getCiudad()?>">
						<?=i18n("Postal Code")?>:
						<input type="text" name="codPostal" class="form-control" placeholder="<?=i18n("Postal Code")?>" value="<?=$user->getCodPostal()?>">
					</div>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=usersList"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editUserStyle.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
