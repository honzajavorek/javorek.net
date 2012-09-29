<?php

abstract class AgregatorControl extends Control {

	protected $uri;
	
	public function __construct($uri) {
		parent::__construct();
		$this->uri = $uri;
	}
	
	abstract public function render($limit = 5);

}
