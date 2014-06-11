<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modellist
jimport('joomla.application.component.modellist');

/**
 * Модель ReTournamentTeams
 */
class ReTournamentModelTeams extends JModelList
{
	/**
	 * Возвращает данные о командах
	 *
	 * @return object
	 */
	// TODO добавть в запрос подсчт посещенных турниров
	//SELECT DISTINCT tournament_id
	//FROM jos_rt_fights
	//WHERE
	//fighter_id_2 IN (
	//SELECT id
	//FROM jos_rt_participants
	//WHERE team_id = 7)
	//OR
	//fighter_id_1 IN (
	//SELECT id
	//FROM jos_rt_participants
	//WHERE team_id = 7)

	public function getTeams()
	{
		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
			SELECT
				name,
				id,
				(
					SELECT count(id)
					FROM jos_rt_participants
					WHERE team_id = jos_rt_teams.id) AS qt_participants,
				(
					SELECT avg_rating
					FROM jos_rt_teams_avg_rating
					WHERE team_id = jos_rt_teams.id
						  AND tournament_id = (
						SELECT id
						FROM jos_rt_tournaments
						WHERE state = 'complete'
						ORDER BY `date` DESC
						LIMIT 1))                    AS rating,
				(
					SELECT SUM(wins)
					FROM jos_rt_participants
					WHERE team_id = jos_rt_teams.id) AS sum_wins,
				(
					SELECT SUM(loses)
					FROM jos_rt_participants
					WHERE team_id = jos_rt_teams.id) AS sum_loses,
				(
					SELECT SUM(draws)
					FROM jos_rt_participants
					WHERE team_id = jos_rt_teams.id) AS sum_draws,
			# Вычмсление изменения рейтинга
				((
			# Последний турнир
					 SELECT avg_rating
					 FROM jos_rt_teams_avg_rating
					 WHERE team_id = jos_rt_teams.id
						   AND tournament_id = (
						 SELECT id
						 FROM jos_rt_tournaments
						 WHERE state = 'complete'
						 ORDER BY `date` DESC
						 LIMIT 1)) - (
			# Предпоследний турнир
					 SELECT avg_rating
					 FROM jos_rt_teams_avg_rating
					 WHERE team_id = jos_rt_teams.id
						   AND tournament_id = (
						 SELECT id
						 FROM jos_rt_tournaments
						 WHERE state = 'complete'
						 ORDER BY `date` DESC
						 LIMIT 2, 1)))               AS rating_change
			FROM jos_rt_teams
			# Выводим только те команды в которых есть участники
			WHERE (
					  SELECT id
					  FROM jos_rt_participants
					  WHERE team_id = jos_rt_teams.id
					  LIMIT 1) IS NOT NULL
			ORDER BY rating DESC
		";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		return $results;
	}
}
