<?php
//file: view/users/register.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$view->setVariable("title", i18n("Apunta - Register"));
$view->setVariable("header", i18n("Register"));
?>
			<form class="form-signin" action="index.php?controller=users&amp;action=register" method="POST">
				<div><?=isset($errors["username"])?i18n($errors["username"]):""?></div>
				<input type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" value="<?=$user->getUsername()?>" required autofocus>
				<div><?= isset($errors["passwd"])?i18n($errors["passwd"]):"" ?></div>
				<input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>" value="" id="password" required>
				<input type="password" class="form-control" placeholder="<?=i18n("Repeat password")?>" oninput="check(this)" required>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Create new account")?></button>
			</form>
			<a class="btn btn-lg btn-primary btn-block" href="index.php?controller=users&amp;action=login"><?=i18n("Cancel")?></a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/registerStyle.css">
<?=$view->moveToFragment("javascript")?>		<script type="text/javascript" src="js/password.js"></script>
