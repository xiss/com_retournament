<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modellist
jimport('joomla.application.component.modellist');

/**
 * Модель ReTournamentTeam
 */
class ReTournamentModelTeam extends JModelList
{
	/**
	 * Возвращает данные о команде
	 *
	 * @return object
	 */
	public function getTeam()
	{
		// Получаем id команды по которой извлекаем информацию
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT #__rt_teams.name AS name,
                        (SELECT ROUND(AVG(rating)) FROM #__rt_participants WHERE team_id = $id) AS avg_rating,
                        (SELECT COUNT(#__rt_participants.id) from #__rt_participants WHERE team_id = $id) AS qt_teammates,
                        (SELECT SUM(warnings) FROM #__rt_participants WHERE team_id = $id) AS sum_warnings,
                        (SELECT SUM(wins) FROM #__rt_participants WHERE team_id = $id) AS sum_wins,
                        (SELECT SUM(loses) FROM #__rt_participants WHERE team_id = $id) AS sum_loses,
                        (SELECT SUM(draws) FROM #__rt_participants WHERE team_id = $id) AS sum_draws
                    FROM `#__rt_participants`
                    JOIN #__rt_teams ON #__rt_teams.id = #__rt_participants.team_id
                    WHERE #__rt_participants.team_id = $id
                    LIMIT 1
					";
		$db->setQuery($query);
		$results = $db->loadObject();

		return $results;
	}

	/**
	 * Возвращает массив объектов с сокомандниками
	 *
	 * @return array
	 */
	public function getTeammates()
	{
		// Получаем id команды по которой извлекаем информацию
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT  IF(ISNULL(nick), CONCAT_WS(' ', surname, jos_rt_participants.name), nick) AS name,
							`rating`,
							`rating_change`,
							`wins`,
							`draws`,
							`loses`,
							`miss_hits`,
							`inf_hits`,
							warnings,
							qt_tournaments,
							jos_rt_participants.state AS state,
							jos_rt_participants.id AS id,
							jos_rt_tournaments.name AS tournament_name,
							jos_rt_tournaments.date AS tournament_date,
							jos_rt_tournaments.id AS tournament_id
					FROM `jos_rt_participants`
					JOIN `jos_rt_tournaments` ON jos_rt_tournaments.id = jos_rt_participants.tournament_id
					JOIN `jos_rt_teams` ON jos_rt_teams.id = jos_rt_participants.team_id
					WHERE jos_rt_participants.team_id = $id
					ORDER BY state, `rating` DESC
					";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		return $results;
	}
}
