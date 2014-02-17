<?php
defined('_JEXEC') or die('Restricted access');

// Подключаем логирование.
JLog::addLogger(
	array('text_file' => 'com_helloworld.php'),
	JLog::ALL,
	array('com_helloworld')
);
JError::$legacy = false;

//Импорт библиотеки контроллеров joomla
jimport('joomla.application.component.controller');

//Импорт CSS
$document =& JFactory::getDocument();
$document->addStyleSheet(JPATH_COMPONENT_SITE . "/assets/css/ladder.css");
//JHTML::stylesheet('ladder.css', JPATH_COMPONENT_SITE . "/assets/css/ladder.css");

//Получаем экземпляр контроллера расширения ReTournament
$controller = JController::getInstance('ReTournament');

// Выполняем запрос задачи
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Перенаправляем, если установлен контроллер
//$controller->redirect();

