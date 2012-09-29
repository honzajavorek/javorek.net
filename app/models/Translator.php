<?php

class Translator extends Object implements ITranslator {

	private $values = array();
	
	public function __construct($lang) {
		$json = new JsonModel(APP_DIR . "/data/translations/$lang.json");
		$json->returnArray = TRUE;
		$this->values = $json->content;
	}
	
	public function translate($message, $count = NULL) {
		if (strrchr($message, '.') !== FALSE) {
			list($prefix, $key) = explode('.', $message);
			if (isset($this->values[$prefix][$key])) {
				return $this->values[$prefix][$key];
			}
			return "[ $message ]";
		} elseif (isset($this->values[$message])) {
			return $this->values[$message];
		}
		return "[ $message ]";
	}

}
