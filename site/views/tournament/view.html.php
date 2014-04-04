<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');

/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewTournament extends JView
{
	/**
	 * Информация по турниры
	 *
	 * @var
	 */
	protected $tournament;
	/**
	 * Массив объектов с боями
	 *
	 * @var
	 */
	protected $fights;
	protected $chartDataTournamentFilling;

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
			// Получаем данные из модели
			$this->tournament = $this->get('Tournament');
			$this->fights = $this->get('Fights');
			$this->chartDataTournamentFilling = $this->get('ChartDataTournamentFilling');

			// Подготавливаем документ
			$this->prepareDocument($this->tournament->type);

			// Назначаем layout из БД (тип турнира)
			$this->setLayout($this->tournament->type);

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
	protected function prepareDocument($tournamentType = null)
	{
		// Устанавливаем заголовок
		$this->document->setTitle($this->tournament->name);

		// Если это рейтинговый турнир, загружаем график
		if ($tournamentType == 'rt') { // Загружаем основную библиотеку AmCharts
			$this->document->addScript(JURI::base() . 'components/com_retournament/libs/amcharts/amcharts.js');

			// Загружаем требуемый Pie график
			$this->document->addScript(JURI::base() . 'components/com_retournament/libs/amcharts/pie.js');

			// Загружаем настройки графика
			$this->document->addScript(JURI::base() . 'components/com_retournament/assets/charts/pie_tournament_filling.js');

			// Загружаем тему для графика
			$this->document->addScript(JURI::base() . 'components/com_retournament/assets/charts/themes/light.js');

			// Подготавливаем данные для графика
			$this->chartDataTournamentFilling = $this->prepareDataChart($this->chartDataTournamentFilling);

			// Загружаем данные для графика
			$this->document->addScriptDeclaration('var chartData =' . $this->chartDataTournamentFilling);
		}
	}

	/**
	 * Подготавливает данные для графика: преобразует данные в JSON
	 *
	 * @param $data
	 *
	 * @return mixed|string JSON
	 */
	protected function prepareDataChart($data)
	{
		// Преобразуем в JSON
		$results = json_encode($data);

		return $results;
	}
}

