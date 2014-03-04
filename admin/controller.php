<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * Общий контролер компонента ReTournament
 */
class ReTournamentController extends JController
{
	/**
	 * @param bool  $cachable  Если True то представление будет закашировано
	 * @param array $urlparams Массив безопасных url-параметров и их валидных типов переменных
	 *
	 * @return void
	 */

	public function display($cachable = false, $urlparams = array())
	{
		// Устанавливаем представление по умолчанию если оно не было установлено
		$input = JFactory::getApplication()->input;
		$input->set('view', $input->getCmd('view', 'ReTournaments'));

		parent::display($cachable);
	}
}