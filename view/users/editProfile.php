<?php
//file: view/users/editProfile.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("GesGym - Modify User"));
$view->setVariable("header", i18n("Modify Profile"));
?>
			<form class="form-signin" action="index.php?controller=users&amp;action=editProfile" method="POST">
				<div><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
				<?=i18n("Username")?>:
				<input disabled type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>" required/>
				<div><?=isset($errors["password"])?i18n($errors["password"]):""?></div>
				<?=i18n("Password")?>:
				<input type="password" name="password" class="form-control" placeholder="<?=i18n("Password")?>" value="" id="password" required/>
				<?=i18n("Repeat password")?>:
				<input type="password" class="form-control" placeholder="<?=i18n("Repeat password")?>" value="" oninput="check(this)" required/>
				<?=i18n("Type")?>:
				<select name="tipo" disabled>
					<option value="deportista" <?php if ($user->getTipo() == "deportista") print "selected"?>><?=i18n("Sportsman")?></option>
					<option value="entrenador" <?php if ($user->getTipo() == "entrenador") print "selected"?>><?=i18n("Trainer")?></option>
					<option value="administrador" <?php if ($user->getTipo() == "administrador") print "selected"?>><?=i18n("Administrator")?></option>
				</select>
				<?=i18n("Card")?>:
				<select name="tipo" disabled>
					<option value="-" <?php if ($user->getSubtipo() == null) print "selected"?>><?=i18n("None")?></option>
					<option value="tdu" <?php if ($user->getSubtipo() == "tdu") print "selected"?>><?=i18n("College Sports")?></option>
					<option value="pef" <?php if ($user->getSubtipo() == "pef") print "selected"?>><?=i18n("Get Fit")?></option>
				</select>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=profile"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editProfileStyle.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
