<?php
//file: view/users/edit.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("GesGym - Modify User"));
$view->setVariable("header", i18n("Modify User"));
$currentusertype = $view->getVariable("currentusertype");
$currentusername = $view->getVariable("currentusername");
if($user->getTipo() == "deportista"){
$entrenador = $view->getVariable("entrenador");
$trainers = $view->getVariable("trainers");
$tablas = $view->getVariable("tablas");
$tables = $view->getVariable("tables");
}
?>
			<div class="row">
				<form class="form-signin" action="index.php?controller=users&amp;action=edit&amp;id=<?=$user->getId()?>" method="POST">
					<div class="col-sm-<?php if($user->getTipo() != "deportista") print "12"; else print "6"; ?>">
						<div><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
						<?=i18n("Username")?>:
						<input type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>" required/>
						<div><?=isset($errors["password"])?i18n($errors["password"]):""?></div>
						<?=i18n("Password")?>:
						<input type="password" name="password" class="form-control" placeholder="<?=i18n("Password")?>" value="" id="password"/>
						<?=i18n("Repeat password")?>:
						<input type="password" class="form-control" placeholder="<?=i18n("Repeat password")?>" value="" oninput="check(this)"/>
						<?=i18n("Type")?>:
						<select name="tipo" <?php if ($currentusertype != "administrador" || $currentusername == $user->getUsername()) print "disabled"?>>
							<option value="deportista" <?php if ($user->getTipo() == "deportista") print "selected"?>><?=i18n("Sportsman")?></option>
							<option value="entrenador" <?php if ($user->getTipo() == "entrenador") print "selected"?>><?=i18n("Trainer")?></option>
							<option value="administrador" <?php if ($user->getTipo() == "administrador") print "selected"?>><?=i18n("Administrator")?></option>
						</select><br><br>
						<?=i18n("Card")?>:
						<select name="subtipo" <?php if ($currentusertype == "deportista" || $currentusername == $user->getUsername()) print "disabled"?>>
<?php if ($currentusername == $user->getUsername() || $currentusertype == "administrador") { ?>
							<option value="-" <?php if ($user->getSubtipo() == null) print "selected"?>><?=i18n("None")?></option>
<?php } ?>
							<option value="tdu" <?php if ($user->getSubtipo() == "tdu") print "selected"?>><?=i18n("College Sports")?></option>
							<option value="pef" <?php if ($user->getSubtipo() == "pef") print "selected"?>><?=i18n("Get Fit")?></option>
						</select>
					</div>
<?php if($user->getTipo() == "deportista") { ?>
					<div class="col-sm-6">
						<?=i18n("Trainer")?>:
						<select name="entrenador" <?php if ($currentusertype == "deportista") print "disabled"?>>
							<option value="-" <?php if ($entrenador == null) print "selected"?>><?=i18n("None")?></option>
<?php foreach ($trainers as $trainer): ?>
							<option value="<?=$trainer->getId()?>" <?php if ($entrenador != null && $trainer->getId() == $entrenador->getId()) print "selected"?>><?=$trainer->getUsername()?></option>
<?php endforeach; ?>
						</select><br><br>
						<?=i18n("Tables")?>:<br>
						<select name="tablas[]" multiple size="15">
<?php foreach ($tables as $table): ?>
							<option value="<?=$table->getTableId()?>" <?php if (in_array($table, $tablas)) print "selected"?>><?=$table->getTableNombre()?></option>
<?php endforeach; ?>
						</select>
					</div>
<?php } ?>
					<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Save changes")?></button>
				</form>
			</div>
			<a class="btn btn-lg btn-primary btn-block" href="javascript:history.back()"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/editUserStyle.css"/>
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
