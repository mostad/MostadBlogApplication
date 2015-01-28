<?php
chdir(dirname(__DIR__));
require './vendor/autoload.php';
Zend\Mvc\Application::init(require './config/application.config.php')->run();
