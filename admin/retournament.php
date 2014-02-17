<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// Устанавливаем обработку ошибок в режим использования Exception
JError::$legacy = false;

// Подключаем библиотеку контроллера Joomla
jimport('joomla.application.component.controller');

// Получаем экземпляр контроллера с префиксом ReTournament
$controller = JController::getInstance('ReTournament');

// Исполняем задачу task из запроса
$input = JFactory::getApplication()->input;
$controller->execute($input->getCmd('task', 'display'));

// Perform the Request task
//$controller->execute(JRequest::getCmd('task'));

// Перенаправляем если перенапровление установлено в контроллере
$controller->redirect();
