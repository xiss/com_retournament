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
     * Информация об изменении в рейтинге в формате JSON
     *
     * @var
     */
    protected $ratingChange;
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
            $this->ratingChange = $this->get('RatingChange');
            //var_dump($this->ratingChange);

            // Подготавливаем документ
            $this->prepareDocument();

            // Отображаем представление.
            parent::display($tpl);
        }
        catch (Exception $e)
        {
            JFactory::getApplication()->enqueueMessage(JText::_('COM_RETOURNAMENT_LADDER_ERROR_OCCURRED'), 'error');
            JLog::add($e->getMessage(), JLog::ERROR, 'com_retournament');
        }
    }
    /**
     * Подготавливает документ
     */
    protected function prepareDocument()
    {
        // Устанавливаем заголовок
        $this->document->setTitle($this->escape($this->prepareParticipantHeader($this->participant->participant_name, $this->participant->surname, $this->participant->middle_name, $this->participant->nick)));

        // Загружаем основную библиотеку AmCharts
        $this->document->addScript(JURI::base() . 'components/com_retournament/assets/amcharts/amcharts.js');

        // Загружаем требуемый Serial график
        $this->document->addScript(JURI::base() . 'components/com_retournament/assets/amcharts/serial.js');

        //  Загружаем настройки графика
        $this->document->addScript(JURI::base() . 'components/com_retournament/assets/charts/chart_rating_change.js');

        // Загружаем данные для графика
        $this->document->addScriptDeclaration('var chartData =' . $this->ratingChange);
    }
    /**
     * Формирует заголовок-имя страницы
     *
     * @param $name       string
     * @param $surname    string
     * @param $middleName string
     * @param $nick       string
     *
     * @return string
     */
    protected function prepareParticipantHeader($name, $surname, $middleName, $nick)
    {
        if (is_null($nick))
        {
            $result = implode(" ", array($surname, $name, $middleName));
        }
        else
        {
            $result = implode(" ", array($nick, JText::_('COM_RETOURNAMENT_PARTICIPANT_HEADER_SEPARATOR'), $surname, $name, $middleName));
        }

        return $result;
    }
}

