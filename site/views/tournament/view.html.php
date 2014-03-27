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

			// Подготавливаем документ
			$this->prepareDocument();

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
	 * Подготавливает документ, устанавливает заголовок
	 */
	protected function prepareDocument()
	{
		$this->document->setTitle($this->tournament->name);
	}
}

