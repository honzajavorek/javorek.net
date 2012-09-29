<?php

abstract class ListControl extends Control {

	protected $model;
	protected $identifier;
	
	public function __construct() {
		$this->identifier = $id = strtolower(str_replace('Control', '', $this->reflection->name));
		$this->model = new JsonModel(APP_DIR . "/data/$id.json");
	}
	
	protected function getLanguage() {
		return $this->presenter->getParam('lang');
	}
	
	protected function createTemplate() {
		$template = parent::createTemplate();
		$this->presenter->prepareTemplate($template);
		$template->setFile(dirname(__FILE__) . '/' . $this->reflection->name . '.phtml');
		return $template;
	}
	
	abstract public function render();
	
}
