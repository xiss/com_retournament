<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modellist
jimport('joomla.application.component.modellist');

/**
 * Модель ReTournamentLadder
 */
class ReTournamentModelLadder extends JModelList
{
	/**
	 * Получаем данные для таблицы рейтинга
	 *
	 * @return object
	 */
	public function getLadderList()
	{
		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT  IF(ISNULL(nick), CONCAT_WS(' ', surname, #__rt_participants.name), nick) AS name,
							`rating`,
							`rating_change`,
							`wins`,
							`draws`,
							`loses`,
							`miss_hits`,
							`inf_hits`,
							`team_id`,
							#__rt_participants.id AS id,
							#__rt_tournaments.name AS tournament_name,
							#__rt_tournaments.date AS tournament_date,
							#__rt_tournaments.id AS tournament_id,
							#__rt_teams.name AS team_name
					FROM `#__rt_participants`
					JOIN `#__rt_tournaments` ON #__rt_tournaments.id = #__rt_participants.tournament_id
					LEFT JOIN `#__rt_teams` ON #__rt_teams.id = #__rt_participants.team_id
					WHERE #__rt_participants.state = 'active'
					ORDER BY `rating` DESC";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		return $results;
	}

	/**
	 * Получаем дату для заголовка таблицы с рейтингом
	 *
	 * @return object
	 */
	public function getLadderHeading()
	{
		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
			SELECT `date` AS last_tournament_date
			FROM `jos_rt_tournaments`
			WHERE `type` = 'rt'
			AND `state` = 'complete'
			ORDER BY `date` DESC
			LIMIT 1";
		$db->setQuery($query);
		$results = $db->loadObject();

		return $results;
	}
}
