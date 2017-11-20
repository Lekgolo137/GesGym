<?php
//file: core/I18n.php

// Clase singleton que gestiona los archivos de traducción y el cambio de idioma.
class I18n {

	private $messages;

	const DEFAULT_LANGUAGE="es";
	const CURRENT_LANGUAGE_SESSION_VAR="__currentlang__";

	public function __construct(){
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		if (isset($_SESSION[self::CURRENT_LANGUAGE_SESSION_VAR])) {
			$this->setLanguage(
			$_SESSION[self::CURRENT_LANGUAGE_SESSION_VAR]);
		} else{
			$this->setLanguage(self::DEFAULT_LANGUAGE);
		}
	}

	// Cambia el idioma y lo guarda en la sesión.
	public function setLanguage($language) {
		//include language file
		include(__DIR__."/../view/messages/messages_$language.php");
		$this->messages = $i18n_messages;

		//save the language in session
		$_SESSION[self::CURRENT_LANGUAGE_SESSION_VAR] = $language;
	}

	// Encuentra la traducción el la cadena pasada como parámetro
	public function i18n($key) {
		if (isset($this->messages[$key])){
			return $this->messages[$key];
		}else{
			return $key;
		}
	}

	// Singleton
	private static $i18n_singleton = null;

	// Retorna una instancia singleton de esta clase.
	public static function getInstance() {
		if (self::$i18n_singleton == NULL) {
			self::$i18n_singleton = new I18n();
		}
		return self::$i18n_singleton;
	}

	// Retorna todos los mensajes en el idioma actual.
	public function getAllMessages() {
		return $this->messages;
	}
}

// Atajo global para la función de traducción (llamada desde las vistas).
function i18n($key) {
	return I18n::getInstance()->i18n($key);
}