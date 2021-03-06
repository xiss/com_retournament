<?php
defined('_JEXEC') or die('Restricted access');

// Подключаем логирование.
JLog::addLogger(
	array('text_file' => 'com_retournament.php'),
	JLog::ALL,
	array('com_retournament')
);
JError::$legacy = false;

// Импорт библиотеки контроллеров joomla
jimport('joomla.application.component.controller');

// Импорт CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JURI::base() . 'components/com_retournament/assets/css/retournament.css');

// Подключаем хелперы
JLoader::register('viewHelper', JPATH_COMPONENT . DS . 'helpers' . DS . 'view_helper.php');
JLoader::register('modelHelper', JPATH_COMPONENT . DS . 'helpers' . DS . 'model_helper.php');

// Получаем экземпляр контроллера расширения ReTournament
$controller = JController::getInstance('ReTournament');

// Выполняем запрос задачи
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task'));

// Перенаправляем, если установлен контроллер
//$controller->redirect();

