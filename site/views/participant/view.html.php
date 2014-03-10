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
		try {
			$this->participant = $this->get('Participant');
			$this->fights = $this->get('Fights');
			// Подготавливаем документ
			$this->prepareDocument();
			// Отображаем представление.
			parent::display($tpl);
		}
		catch (Exception $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('COM_RETOURNAMENT_LADDER_ERROR_OCCURRED'), 'error');
			JLog::add($e->getMessage(), JLog::ERROR, 'com_retournament');
		}
	}

	/**
	 * Подготавливает документ, устанавливае заголовок
	 */
	protected function prepareDocument()
	{
		$this->document->setTitle($this->escape($this->prepareParticipantHeader($this->participant->participant_name, $this->participant->surname, $this->participant->middle_name, $this->participant->nick)));
	}

	/**
	 * Заменяет числинные значения спрайтами
	 *
	 * @param $hits integer Количество хитов
	 *
	 * @return string Значение в теге <span> с необходимым стилем
	 */
	protected function prepareInfHits($hits)
	{
		// TODO Убрать в хелперы
		$result = "";
		while ($hits > 0) {
			$result .= "<span class='oneInfHit'></span>";
			$hits--;
		}

		return $result;
	}

	/**
	 * Заменяет числинные значения спрайтами
	 *
	 * @param $hits integer Количество хитов
	 *
	 * @return string Значение в теге <span> с необходимым стилем
	 */
	protected function prepareMissHits($hits)
	{
		$result = "";
		while ($hits > 0) {
			$result .= "<span class='oneMissHit'></span>";
			$hits--;
		}

		return $result;
	}

	/**
	 * Заменяет числинные значения спрайтами
	 *
	 * @param $warnings integer Количество предупреждений
	 *
	 * @return string в теге <span> с необходимым стилем
	 */
	protected function prepareWarnings($warnings)
	{
		// TODO Убрать в хелперы
		$result = "";
		while ($warnings > 0) {
			$result .= "<span class='oneWarning'></span>";
			$warnings--;
		}

		return $result;
	}

	/**
	 * Преобразует дату в родительский падеж
	 *
	 * @param $date string формате принимаемом функцией strtotime
	 *
	 * @return string дату в родительском падеже 27 мая 2012 года
	 */
	protected function prepareDate($date)
	{
		// TODO Вынести это кудато отдельно, видимо в хелперы
		$date = new JDate($date);
		$cur_months = $date->format('n');
		$monthsInParDeaths = array(
			1 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_JANUARY'),
			2 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_FEBRUARY'),
			3 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_MARCH'),
			4 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_APRIL'),
			5 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_MAY'),
			6 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_JUNE'),
			7 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_JULY'),
			8 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_AUGUST'),
			9 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_SEPTEMBER'),
			10 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_OCTOBER'),
			11 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_NOVEMBER'),
			12 => JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_DECEMBER')
		);

		return $date->format('j') . ' ' . $monthsInParDeaths[$cur_months] . ' ' . $date->format('Y') . JText::_('COM_RETOURNAMENT_PARENTAL_DEATHS_ENDING_DATE');
	}

	/**
	 * Принимает этап турнира из таблицы #__rt_fights.tournament_part и возвращает название этапа
	 *
	 * @param $stage string Этап турнира
	 *
	 * @return string Название этапа
	 */
	protected function prepareStage($stage)
	{
		// TODO Убрать в хелперы
		switch ($stage) {
			case 1:
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_1');
				break;
			case 2:
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_2');
				break;
			case 3:
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_3');
				break;
			case 4:
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_4');
				break;
			case "top8":
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_TOP_8');
				break;
			case "top4":
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_TOP_4');
				break;
			case "top2":
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_TOP_2');
				break;
			case "place3":
				return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_ROUND_PLACE_3');
				break;
			default:
				return $stage;
		}
	}

	/**
	 * Возвращает коментарии к бою
	 *
	 * @param $fightType string Тип боя
	 * @param $infHits   integer Нанесенные хиты
	 *
	 * @return string Комментарий к бою
	 */
	protected function prepareNote($fightType, $infHits)
	{
		// TODO Убрать в хелперы
		if ($fightType == "buy") {
			return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_NOTE_BUY');
		}
		if (($fightType . $infHits) == "forfeit3") {
			return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_FORFEIT_WIN');
		}
		elseif ($fightType == "forfeit") {
			return JText::_('COM_RETOURNAMENT_PARTICIPANT_FIGHTS_FORFEIT_LOSE');
		}
	}

	/**
	 * Возвращает CSS класс для боя
	 *
	 * @param $fightType
	 *
	 * @return string CSS class
	 */
	protected function prepareCssForFight($fightType)
	{
		// TODO Убрать в хелперы
		if (is_null($fightType)) {
			return "";
		}
		else {
			return " semi";
		}
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
		if (is_null($nick)) {
			$result = implode(" ", array($surname, $name, $middleName));
		}
		else {
			$result = implode(" ", array($nick, JText::_('COM_RETOURNAMENT_PARTICIPANT_HEADER_SEPARATOR'), $surname, $name, $middleName));
		}

		return $result;
	}
}

