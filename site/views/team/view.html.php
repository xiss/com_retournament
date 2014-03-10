<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');

/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewTeam extends JView
{
	/**
	 * Данные о команде
	 *
	 * @var
	 */
	protected $team;
	/**
	 * Сокомандники
	 *
	 * @var
	 */
	protected $teammates;

	/**
	 * Переопределяем метод display класса JView
	 *
	 * @param string $tpl Имя файла шаблона.
	 *
	 * @return void
	 */
	public function display($tpl = null)
	{
		try {
			// Получаем данные из модели
			$this->team = $this->get('Team');
			$this->teammates = $this->get('Teammates');

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
		$this->document->setTitle($this->escape($this->getTitle()));
	}

	/**
	 * Возвращает заголовк для страницы
	 *
	 * @return string
	 */
	public function getTitle()
	{
		$team = $this->get('Team');

		return $team->name;
	}

	/**
	 * Возвращает оформленное значение роста рейтинга
	 *
	 * @param $change Значение изменения рейтинга
	 *
	 * @return string Значение в теге <span> с необходимым стилем
	 */
	protected function prepareRatingChange($change)
	{
		// TODO Убрать в хелперы
		// Если рейтинг вырос
		if ($change > 0) {
			$change = "<span class='up'>$change</span>";

			return $change;
		}
		// Если рейтинг упал
		if ($change < 0) {
			$change = "<span class='down'>" . ltrim($change, '-') . "</span>";

			return $change;
		}
		// Если это новый участник
		if (is_null($change)) {
			$change = JText::_('COM_RETOURNAMENT_LADDER_NEW_PARTICIPANT');

			return $change;
		}
		// Если рейтинг не изменился
		if ($change === '0') {
			$change = "<span class='unchanged'></span>";

			return $change;
		}
	}

	/**
	 * Преобразует дату в родительский падеж
	 *
	 * @param $date в формате принимаемом функцией strtotime
	 *
	 * @return string дату в родительском падеже 27 мая 2012 года
	 */
	protected function prepareDate($date)
	{
		// TODO Убрать когда вынесу в хелперы
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
}