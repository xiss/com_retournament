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
        $this->msg = $this->get('Msg');
		$this->ladder = "<table><tr><td>".$this->msg['id']."</td><td>".$this->msg['nick']."</td><td>".$this->msg['name']."</td></tr></table>";
        // Проверяем на ошибки
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        // Показываем представление
        parent::display($tpl);
    }
}