<?php
//file: controller/LanguageController.php

require_once(__DIR__."/../core/I18n.php");

class LanguagesController {
	const LANGUAGE_SETTING = "__language__";

	// Cambia el idioma actual.
	public function change() {
		// Comprueba que se le haya pasado un idioma.
		if(!isset($_GET["lang"])) {
			throw new Exception("no lang parameter was provided");
		}
		// Inicia una sesión en caso de que no la haya.
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// Cambia el idioma
		I18n::getInstance()->setLanguage($_GET["lang"]);
		// Recarga la página.
		header("Location: ".$_SERVER["HTTP_REFERER"]);
		die();
	}

	// Para traducciones dentro de javascript añadir <script src="index.php?controller=languages&action=i18njs"></script> en la vista.
	public function i18njs() {
		header('Content-type: application/javascript');
		echo "var i18nMessages = [];\n";
		echo "function ji18n(key) { if (key in i18nMessages) return i18nMessages[key]; else return key;}\n";
		foreach (I18n::getInstance()->getAllMessages() as $key=>$value) {
			echo "i18nMessages['$key'] = '$value';\n";
		}
	}
}
