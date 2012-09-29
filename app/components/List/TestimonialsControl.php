<?php

class TestimonialsControl extends ListControl {

	public function render() {
		$this->model->returnArray = TRUE;
		$data = $this->model->getContent();
		
		$items = array();
		foreach (array_values($data) as $k => $t) {
			// preferred language always first, otherwise random
			$key = (($this->getLanguage() == $t['lang'])? '1' : '2') . (string)rand(0, 9) . $k;
			$items[$key] = $t;
		}
		ksort($items);
		
		$this->template->items = array_values($items);
		$this->template->render();
	}
	
}
