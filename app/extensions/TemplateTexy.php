<?php

/**
 * Texy! for templates.
 */
class TemplateTexy extends Texy {
	
	/**
	 * Specific settings.
	 */
	function __construct() {
		parent::__construct();

		$this->setOutputMode(Texy::HTML4_STRICT);

		$this->imageModule->root = Environment::getVariable('basePath') . 'images/';
		$this->imageModule->leftClass  = 'align-left';
		$this->imageModule->rightClass = 'align-right';
		$this->headingModule->generateID = TRUE;
		$this->headingModule->top = 2;
	}

}
