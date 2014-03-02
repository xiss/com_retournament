<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.controller');
/**
 * ReTournament Component Controller
 */
class ReTournamentController extends JController
{
    /**
     * Задача по отображению.
     *
     * @param   boolean $cachable Если true, то представление будет закешировано.
     * @param   array $urlparams Массив безопасных url-параметров и их валидных типов переменных.
     *
     * @return  void
     */
    public function display($cachable = false, $urlparams = array())
    {
        // Устанавливаем представление по умолчанию, если оно не было установлено.
        $input = JFactory::getApplication()->input;
        $input->set('view', $input->getCmd('view', 'Ladder'));

        parent::display($cachable);
    }
}