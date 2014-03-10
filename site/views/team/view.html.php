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
}