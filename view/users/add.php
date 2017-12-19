<?php
//file: view/users/add.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("GesGym - New User"));
$view->setVariable("header", i18n("New User"));
$currentusertype = $view->getVariable("currentusertype");
?>
			<form class="form-signin" action="index.php?controller=users&amp;action=add" method="POST">
				<div><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
				<input type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>" required autofocus>
				<div><?=isset($errors["password"])?i18n($errors["password"]):""?></div>
				<input type="password" name="password" class="form-control" placeholder="<?=i18n("Password")?>" value="<?=$user->getPassword()?>" id="password" required>
				<input type="password" class="form-control" placeholder="<?=i18n("Repeat password")?>" value="<?=$user->getPassword()?>" oninput="check(this)" required>
				<div class="form-control"><?=i18n("Type")?>:
					<select name="tipo" <?php if ($currentusertype != "administrador") print "disabled"?>>
						<option value="deportista" <?php if ($user->getTipo() == "deportista") print "selected"?>><?=i18n("Sportsman")?></option>
						<option value="entrenador" <?php if ($user->getTipo() == "entrenador") print "selected"?>><?=i18n("Trainer")?></option>
						<option value="administrador" <?php if ($user->getTipo() == "administrador") print "selected"?>><?=i18n("Administrator")?></option>
					</select>
				</div>
				<div class="form-control" id="card"><?=i18n("Card")?>:
					<select name="subtipo">
					<?php if ($currentusertype == "administrador") { ?>
						<option value="-" <?php if ($user->getSubtipo() == null) print "selected"?>><?=i18n("None")?></option>
					<?php } ?>
						<option value="tdu" <?php if ($user->getSubtipo() == "tdu") print "selected"?>><?=i18n("College Sports")?></option>
						<option value="pef" <?php if ($user->getSubtipo() == "pef") print "selected"?>><?=i18n("Get Fit")?></option>
					</select>
				</div>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create new user")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=usersMenu"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/addUserStyle.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
