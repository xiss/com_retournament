<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');

/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewTournaments extends JView
{
	/**
	 * Информация по турниры
	 *
	 * @var
	 */
	protected $tournaments;

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
			$this->tournaments = $this->get('Tournaments');

			// Отображаем представление.
			parent::display($tpl);
		}
		catch (Exception $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('COM_RETOURNAMENT_LADDER_ERROR_OCCURRED'), 'error');
			JLog::add($e->getMessage(), JLog::ERROR, 'com_retournament');
		}
	}
}

