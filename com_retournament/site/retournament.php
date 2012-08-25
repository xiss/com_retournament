<?php
defined('_JEXEC') or die('Restricted access');

//импорт библиотеки контроллеров joomla
jimport('joomla.application.component.controller');

// Get an instance of the controller prefixed by retournament
//Получаем экземпляр контроллера расширения retournament
$controller = JController::getInstance('ReTournament');

// Выполняем запрос задачи
$controller->execute(JRequest::getCmd('task'));

// Перенаправляем, если установлен контроллер
$controller->redirect();

