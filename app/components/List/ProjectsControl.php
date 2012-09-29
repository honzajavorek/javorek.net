<?php

class ProjectsControl extends ListControl {

	protected $modelContracts;
	
	public function __construct() {
		parent::__construct();
		$this->modelContracts = new JsonModel(APP_DIR . "/data/contracts.json");
	}
	
	public function render() {
		$projects = $this->model->getContent();
		$contracts = $this->modelContracts->getContent();
		$lang = $this->getLanguage();
		
		$items = array();
		$desc = "desc-$lang";
		foreach (glob(WWW_DIR . '/images/contracts/*.png') as $filename) {
			$filename = basename($filename);
			$key = String::replace($filename, '#\\.png$#', '');
			
			$tech = explode(',', $projects->$key->tech);
			$tech = array_map('trim', $tech);
			sort($tech);
			
			$items[$filename] = array(
				'title' => $contracts->$key,
				'filename' => $filename,
				'desc' => $projects->$key->$desc,
				'tech' => $tech,
				'client' => $projects->$key->client,
			);
		}
		ksort($items);
		
		$this->template->items = $items;
		$this->template->render();
	}
	
}
