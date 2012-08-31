<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');

/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewReTournament extends JView
{
    // Перезаписываем JView метод display
    function display($tpl = null)
    {
        // Назначаем данные для просмотра
        $this->msg = "Hello1!!";

        // Показываем представление
        parent::display($tpl);
    }
}


