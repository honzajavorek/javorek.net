<?php

/**
 * Access to data in JSON files.
 *
 * @author     Honza Javorek, http://www.javorek.net/
 * @copyright  Copyright (c) 2008 Jan Javorek
 * @package    Javorek
 */
class JsonModel extends TextFileModel {

	private $errors = array(
	    0 => 'No error has occurred',
	    1 => 'The maximum stack depth has been exceeded',
	    3 => 'Control character error, possibly incorrectly encoded',
	    4 => 'Syntax error',
	);
	
	public $returnArray = FALSE;

	public function getContent() {
		$data = json_decode(parent::getContent(), $this->returnArray);
		if (function_exists('json_last_error')) {
			$error = json_last_error();
			if (!$data && $error) {
				throw new JsonException($this->errors[$error] . ' in file "' . $this->file . '"');
			}
		}
		return $data;
	}

}

class JsonException extends Exception {
}
