<?php

abstract class LogoGridControl extends ListControl {

	public function render() {
		$data = $this->model->getContent();
		
		$items = array();
		foreach (glob(WWW_DIR . '/images/' . $this->identifier . '/*.png') as $filename) {
			$filename = basename($filename);
			$key = String::replace($filename, '#\\.png$#', '');
			$items[$filename] = (isset($data->$key))? $data->$key : '';
		}
		ksort($items);
		
		$this->template->items = $items;
		$this->template->render();
	}
	
}
