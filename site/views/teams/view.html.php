<?php
defined('_JEXEC') or die('Restricted access');

// импорт библиотеки контроллеров joomla
jimport('joomla.application.component.view');

/**
 * HTML представление класса для компонента retourney
 */
class ReTournamentViewTeams extends JView
{
	/**
	 * Данные о командах
	 *
	 * @var
	 */
	protected $teams;
	protected $params;


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
			$this->teams = $this->get('Teams');

			// Получаем параметры приложения
			$app = JFactory::getApplication();
			$this->params = $app->getParams();

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
	 * Подготавливает документ.
	 *
	 * @return  void
	 */
	protected function prepareDocument()
	{
		$app = JFactory::getApplication();
		$menus = $app->getMenu();
		$title = null;

		// Так как приложение устанавливает заголовок страницы по умолчанию, мы получаем его из пункта меню.
		$menu = $menus->getActive();

		if ($menu) {
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else {
			$this->params->def('page_heading', JText::_('COM_RETOURNAMENT_TEAMS_DEFAULT_PAGE_TITLE'));
		}

		// Получаем заголовок страницы в браузере из параметров.
		$title = $this->params->get('page_title', '');

		if (empty($title)) {
			$title = $app->getCfg('sitename');
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 1) {
			$title = JText::sprintf('JPAGETITLE', $app->getCfg('sitename'), $title);
		}
		elseif ($app->getCfg('sitename_pagetitles', 0) == 2) {
			$title = JText::sprintf('JPAGETITLE', $title, $app->getCfg('sitename'));
		}

		if (empty($title)) {
			$title = $this->item;
		}

		// Устанавливаем заголовок страницы в браузере.
		$this->document->setTitle($title);
	}
}