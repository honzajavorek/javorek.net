<?php

class ContactsControl extends ListControl {
	
	const HONZA = 'honza';
	const MICHAL = 'michal';
	
	private $person;
	private $compact;
	private $bio;
	
	public function __construct($person, $compact = FALSE, $bio = NULL) {
		parent::__construct();
		
		if (in_array($person, array(self::HONZA, self::MICHAL))) {
			$this->person = $person;
		} else {
			throw new InvalidArgumentException('Unknown person.');
		}
		$this->compact = (bool)$compact;
		$this->bio = $bio;
	}
	
	public function render() {
		$this->template->lang = $this->getLanguage();
		$this->template->id = $this->person;
		$this->template->person = $this->model->getContent()->{$this->person};
		$this->template->bio = $this->bio;
		
		$this->template->compact = $this->compact;
		$this->template->render();
	}
	
}
