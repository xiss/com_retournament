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
	protected $chartDataRating;

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
			$this->chartDataRating = $this->get('ChartDataRating');

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
	 * Подготавливает документ
	 */
	protected function prepareDocument()
	{
		// Устанавливае заголовок
		$this->document->setTitle($this->escape($this->getTitle()));

		// Загружаем основную библиотеку AmCharts
		$this->document->addScript(JURI::base() . 'components/com_retournament/libs/amcharts/amcharts.js');

		// Загружаем требуемый Serial график
		$this->document->addScript(JURI::base() . 'components/com_retournament/libs/amcharts/serial.js');

		//  Загружаем настройки графика
		$this->document->addScript(JURI::base() . 'components/com_retournament/assets/charts/serial_team_rating.js');

		// Загружаем тему для графика
		$this->document->addScript(JURI::base() . 'components/com_retournament/assets/charts/themes/light.js');

		// Подготавливаем данные для графика, преобразуем в JSON и форматируем дату
		$this->chartDataRating = $this->chartDataRating;

		// Загружаем данные для графика
		$this->document->addScriptDeclaration('var chartData =' . $this->prepareDataChart($this->chartDataRating));
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
	 * Подготавливает данные для графика: форматируем дату, преобразует данные в JSON
	 *
	 * @param $data
	 *
	 * @return mixed|string JSON
	 */
	protected function prepareDataChart($data)
	{
		// Форматируем дату
		foreach ($data as $object) {
			$object->date = viewHelper::prepareDate($object->date);
		}
		// Преобразуем в JSON
		$results = json_encode($data);

		return $results;
	}
}