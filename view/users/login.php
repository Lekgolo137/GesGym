<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$view->setVariable("title", i18n("GesGym - Login"));
$errors = $view->getVariable("errors");
$view->setVariable("header", i18n("GesGym"));
?>
			<div id="error"><?=isset($errors["general"])?$errors["general"]:""?></div>
			<form class="form-signin" action="index.php?controller=users&amp;action=login" method="POST">
				<input type="text" name="username" class="form-control" placeholder="<?=i18n("Username")?>" required autofocus>
				<input type="password" name="passwd" class="form-control" placeholder="<?=i18n("Password")?>" required>
				<button type="submit" class="btn btn-lg btn-primary btn-block"><?=i18n("Login")?></button>
			</form>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/loginStyle.css">
