<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');
/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewParticipant extends JView
{
    /**
     * Данные об участнике
     *
     * @var
     */
    protected $participant;
    /**
     * Список боев участника со всеми параметрами
     *
     * @var
     */
    protected $fights;
    /**
     * Переопределяем метод display класса JView
     *
     * @param   string $tpl Имя файла шаблона.
     *
     * @return  void
     */
    public function display($tpl = null)
    {
        try
        {
            $this->participant = $this->get('Participant');
            $this->fights = $this->get('Fights');
            // Отображаем представление.
            parent::display($tpl);
        }
        catch (Exception $e)
        {
            JFactory::getApplication()->enqueueMessage(JText::_('COM_RETOURNAMENT_LADDER_ERROR_OCCURRED'), 'error');
            JLog::add($e->getMessage(), JLog::ERROR, 'com_retournament');
        }
    }
}