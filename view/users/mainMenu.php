<?php
//file: view/users/mainMenu.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$errors = $view->getVariable("errors");
$view->setVariable("title", i18n("GesGym - Main Menu"));
?>
				Menú temporal:
				<br>
				<br>Para todos:
				<br><a href="#">Perfil</a>
				<br>
				<br>Para entrenadores y administradores:
				<br><a href="#">Gestión de Actividades</a>
				<br><a href="#">Gestión de Tablas</a>
				<br><a href="#">Gestión de Ejercicios</a>
				<br>
				<br>Solo para administradores:
				<br><a href="index.php?controller=users&amp;action=usersMenu">Gestión de Usuarios</a>
				<br><a href="#">Gestión de Recursos</a>
<?=$view->moveToFragment("css")?>		<link rel="stylesheet" type="text/css" href="css/mainMenuStyle.css">
