<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.controlleradmin');

/**
 * ReTournaments контроллер
 */
class ReTournamentControllerReTournaments extends JControllerAdmin
{
	/**
	 * Прокси метод для getModel
	 *
	 * @param string $name   Имя класса модели
	 * @param string $prefix Префикс класса модели
	 *
	 * @return object Объект модели
	 */
	public function getModel($name = 'ReTournament', $prefix = 'ReTournamentModel')
	{
		return parent::getModel($name, $prefix, array('ignore_request' => true));
	}
}

?>
 