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
			SELECT IF(ISNULL(nick), CONCAT_WS(' ', surname, jos_rt_participants.name), nick) AS name,
				`rating`,
				`rating_change`,
				`wins`,
				`draws`,
				`loses`,
				`miss_hits`,
				`inf_hits`,
				`team_id`,
				   jos_rt_participants.id                                                    AS id,
				   jos_rt_tournaments.name                                                   AS tournament_name,
				   jos_rt_tournaments.date                                                   AS tournament_date,
				   jos_rt_tournaments.id                                                     AS tournament_id,
				   jos_rt_teams.name                                                         AS team_name
			FROM `jos_rt_participants`
				JOIN `jos_rt_tournaments` ON jos_rt_tournaments.id = jos_rt_participants.tournament_id
				LEFT JOIN `jos_rt_teams` ON jos_rt_teams.id = jos_rt_participants.team_id
			WHERE jos_rt_participants.state = 'active'
			ORDER BY `rating` DESC
		";
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
			LIMIT 1
		";
		$db->setQuery($query);
		$results = $db->loadObject();

		return $results;
	}
}
