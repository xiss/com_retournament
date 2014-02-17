<?php
defined('_JEXEC') or die('Restricted access');
jimport('joomla.application.component.modellist');

/**
 * Модель списка сообщений компонента ReTournament
 */
class ReTournamentModelReTournaments extends JModelList
{
	/**
	 * Метод для построения SQL запроса для загрузки списка данных
	 *
	 * @return string SQL запрос
	 */
	protected function getListQuery()
	{
		// Создаем новый query объект
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);

		// Составляем запрос
		$query->select('id, nick, surname, name, middle_name, dob, phone, team_id, rating, wins, draws, loses, miss_hits, inf_hits, tournament_id, qt_tournaments, warnings, state');
		$query->from('#__rt_participants');
		$query->order('id');
		return $query;
	}
}