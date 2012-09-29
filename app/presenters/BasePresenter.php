<?php

abstract class BasePresenter extends Presenter {

	/**
	 * Language setting
	 *
	 * @persistent
	 */
	public $lang;
	
	public function startup() {
		parent::startup();
		
		// template
		$this->prepareTemplate($this->template);
		
		$this->template->lang = $this->lang;
		$this->template->email = Environment::getVariable('email');
		$this->template->robots = Environment::getVariable('robots', 'all');
		$this->template->copyright = '© ' . ((date('Y') == 2007)? date('Y') : 2007 . '-' . date('Y'));
		
		$this->template->menu = $this->createMenu();
	}
	
	public function prepareTemplate(Template $template)	{
		$template->registerHelperLoader('ExtraTemplateHelpers::loader');
		$template->setTranslator(new Translator($this->lang));
	}
	
	protected function createMenu() {
		$targets = array(
			'Default:default',
			'Default:references',
			'Default:contact',
		);
		$menu = array();
		foreach ($targets as $target) {
			$action = strtoupper(ltrim(strstr($target, ':'), ':'));
			$menu[$target] = $this->template->translate($action . '.HEADER');
		}
		return $menu;
	}

	public function afterRender() {
		// auto meta tags
		if (empty($this->template->keywords)) {
			$this->template->keywords = $this->template->translate('LAYOUT.KEYWORDS');
		}
		if (empty($this->template->description)) {
			$this->template->description = $this->template->translate('LAYOUT.DESCRIPTION');
		}
	}

}
