<?php

class DefaultPresenter extends BasePresenter {

	public function renderDefault() {
		$this->template->title = 'javorek.net: ' . $this->template->translate('SLOGAN');
		$this->template->experienceYearsPhp = date('Y') - 2005;
		$this->template->experienceYearsPython = date('Y') - 2009;
	}
	
	public function renderReferences() {
	}
	
	public function renderServices() {
	}
	
	public function renderContact() {
	}

	public function renderAbout() {
	}
	
	public function afterRender() {
		parent::afterRender();
		
		// automatic header
		if (empty($this->template->header)) {
			$this->template->header = $this->template->translate(strtoupper($this->getView()) . '.HEADER');
		}
		
		// automatic title
		if (empty($this->template->title)) {
			$this->template->title = $this->template->header . ' - javorek.net';
		}
	}
	
	
	
	protected function createComponentTwitter() {
		return new TwitterControl('https://twitter.com/statuses/user_timeline/22777547.rss');
	}
	
	protected function createComponentClients() {
		return new ClientsControl();
	}
	
	protected function createComponentContracts() {
		return new ContractsControl();
	}
	
	protected function createComponentProjects() {
		return new ProjectsControl();
	}
	
	protected function createComponentTestimonials() {
		return new TestimonialsControl();
	}
	
	protected function createComponentConferences() {
		return new ConferencesControl();
	}
	
	protected function createComponentOrganized() {
		return new OrganizedControl();
	}
	
	protected function createComponentHonza() {
		$years = date('Y') - 2003; 
		$bio = $this->template->inject($this->template->translate('CONTACT.HONZA_BIO'), 'HONZA_YEARS', $years);
		return new ContactsControl('honza', NULL, $bio);
	}
	
	protected function createComponentCompactHonza() {
		return new ContactsControl('honza', TRUE);
	}
	
	protected function createComponentMichal() {
		$bio = $this->template->translate('CONTACT.MICHAL_BIO');
		return new ContactsControl('michal', NULL, $bio);
	}
	
	protected function createComponentCompactMichal() {
		return new ContactsControl('michal', TRUE);
	}
	
}
