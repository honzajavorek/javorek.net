<?php

class ConferencesControl extends ListControl {

	public function render() {
		$this->model->returnArray = TRUE;
		$this->template->items = $this->model->getContent();
		$this->template->render();
	}
	
}
