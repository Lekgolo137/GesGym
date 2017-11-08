<?php
//file: view/users/mainMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Main Menu"));
?>
				Menú temporal:
				<br>
				<br><a href="index.php?controller=users&amp;action=add">Alta de Usuario</a>
				<br><a href="index.php?controller=users&amp;action=usersList">Listado de Usuarios</a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/usersMenuStyle.css">
