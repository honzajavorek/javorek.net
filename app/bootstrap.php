<?php

// load nette
require LIBS_DIR . '/Nette/loader.php';

// configure environment
Debug::enable();
Environment::loadConfig();

// configure application
$application = Environment::getApplication();
$application->errorPresenter = 'Error';
Html::$xhtml = FALSE;

// setup application router
$router = $application->getRouter();
$lang = Environment::getHttpRequest()->detectLanguage(array('cs', 'en'));

$router[] = new Route('<lang cs|en>/<action>/<id>/', array(
	'presenter' => 'Default',
	'action' => 'default',
	'id' => NULL,
	'lang' => 'cs',
));

$router[] = new Route('<action>/<id>/', array(
	'presenter' => 'Default',
	'action' => 'default',
	'id' => NULL,
	'lang' => ($lang)? $lang : 'cs',
));

// run the application
$application->run();

