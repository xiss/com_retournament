<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modelitem
jimport('joomla.application.component.modellist');

/**
 * Модель retournament
 */
class ReTournamentModelLadder extends JModelList
{
	/**
	 * Получаем данные для таблицы рейтинга
	 *
	 * @return mixed
	 */
	public function getLadderList()
	{
		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT  #__rt_participants.id,
							`nick`,
							`rating`,
							`rating_change`,
							`wins`,
							`draws`,
							`loses`,
							`miss_hits`,
							`inf_hits`,
							#__rt_tournaments.name AS tournament_name,
							#__rt_tournaments.date AS tournament_date,
							#__rt_tournaments.id AS tournament_id,
							#__rt_teams.name AS team_name
					FROM `#__rt_participants`
					JOIN `#__rt_tournaments` ON #__rt_tournaments.id = #__rt_participants.tournament_id
					JOIN `#__rt_teams` ON #__rt_teams.id = #__rt_participants.team_id
					WHERE #__rt_participants.state = 'active'
					AND #__rt_tournaments.date > (
						SELECT MIN(datelist.date) from(
							SELECT `date`
							FROM `#__rt_tournaments`
							WHERE `date` IS NOT NULL
							AND `state` = 'complete'
							ORDER BY `date` DESC
							LIMIT 5) AS datelist)
					ORDER BY `rating` DESC";
		// Reset the query using our newly populated query object.
		$db->setQuery($query);
		$results = $db->loadAssocList();
		return $results;
	}

	/**
	 * Получаем дату для заголовка таблицы с рейтингом
	 *
	 * @return mixed
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
		$results = $db->loadRow();
		return $results;
	}
}