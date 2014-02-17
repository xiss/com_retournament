<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');

/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewLadder extends JView
{
	/**
	 * Сообщение.
	 *
	 * @var  string
	 */
	protected $ladderList;
	protected $ladderHeading;
	protected $params;

	/**
	 * Переопределяем метод display класса JView
	 *
	 * @param   string $tpl Имя файла шаблона.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		try { // Получаем данные из модели
			$this->ladderList = $this->get('LadderList');
			$this->ladderHeading = $this->get('LadderHeading');

			//Получаем параметры приложения
			$app = JFactory::getApplication();
			$this->params = $app->getParams();

			// Подготавливаем документ
			$this->_prepareDocument();

			// Отображаем представление.
			parent::display($tpl);
		} catch (Exception $e) {
			JFactory::getApplication()->enqueueMessage(JText::_('COM_RETOURNAMENT_LADDER_ERROR_OCCURRED'), 'error');
			JLog::add($e->getMessage(), JLog::ERROR, 'com_retournament');
		}
	}

	// Подготавливает документ
	protected function _prepareDocument()
	{
		$title = null;

		// Добавляем поддержку метаданных из пункта меню
		if ($this->params->get('menu-meta_description')) {
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords')) {
			$this->document->setDescription($this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots')) {
			$this->document->setDescription($this->params->get('robots'));
		}
	}
}