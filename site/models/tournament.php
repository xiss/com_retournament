<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modellist
jimport('joomla.application.component.modellist');

/**
 * Модель ReTournamentTournament
 */
class ReTournamentModelTournament extends JModelList
{
	/**
	 * Получаем данные для таблицы рейтинга
	 *
	 * @return object
	 */
	public function getTournament()
	{
		// Получаем id турнира для которого ищем статистику
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT 
                        `name`, 
                        `date`,
                        `type`,
                         place_1_id,
                         place_2_id,
                         place_3_id,
                         (SELECT IF(ISNULL(nick), CONCAT_WS(' ', surname, name), nick) FROM #__rt_participants WHERE id = place_1_id) AS place_1_name,
                         (SELECT IF(ISNULL(nick), CONCAT_WS(' ', surname, name), nick) FROM #__rt_participants WHERE id = place_2_id) AS place_2_name,
                         (SELECT IF(ISNULL(nick), CONCAT_WS(' ', surname, name), nick) FROM #__rt_participants WHERE id = place_3_id) AS place_3_name,
						 qt_participants,
                    -- Количество боев в турнире
                        (SELECT COUNT(id) FROM `#__rt_fights` WHERE `tournament_id` = $id) AS qt_fights,
                    -- Количество ничьих
                        (SELECT COUNT(id) FROM `#__rt_fights` WHERE `tournament_id` = $id AND (inf_hits_1 <> 3 AND inf_hits_2 <> 3) ) AS qt_draws,
                    -- Количество предупреждений
                        (SELECT (SUM(warnings_1)+ SUM(warnings_2)) FROM `#__rt_fights` WHERE `tournament_id` = $id) AS qt_warnings
                    FROM `#__rt_tournaments` WHERE id = $id";
		$db->setQuery($query);
		$results = $db->loadObject();

		return $results;
	}

	/**
	 * Возвращает список боев турнира с параметрами
	 *
	 * @return array
	 */
	public function getFights()
	{
		// Получаем id турнира для которого ищем статистику
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
                    SELECT `fighter_id_1`,
                        `inf_hits_1`,
                        `warnings_1`,
                        `rating_1`,
                        `rating_change_1`,
                        `fighter_id_2`,
                        `inf_hits_2`,
                        `warnings_2`,
                        `rating_2`,
                        `rating_change_2`,
                        `fight_type`,
                        `tournament_stage`,
                        `tournament_part`,
                        UNIX_TIMESTAMP(#__rt_tournaments.date) AS tournament_date_ts,
                        #__rt_tournaments.type AS tournament_type,
                        team_fighter_1.name AS team_name_1,
                        team_fighter_1.id AS team_id_1,
                        team_fighter_2.name AS team_name_2,
                        team_fighter_2.id AS team_id_2,
                        IF(ISNULL(fighter_1.nick), CONCAT_WS(' ', fighter_1.surname, fighter_1.name), fighter_1.nick) AS name_1,
                        IF(ISNULL(fighter_2.nick), CONCAT_WS(' ', fighter_2.surname, fighter_2.name), fighter_2.nick) AS name_2
                    FROM #__rt_fights
                    LEFT JOIN  #__rt_participants AS fighter_1 ON fighter_1.id = #__rt_fights.fighter_id_1
                    LEFT JOIN  #__rt_participants AS fighter_2 ON fighter_2.id = #__rt_fights.fighter_id_2
                    LEFT JOIN  #__rt_teams AS team_fighter_1 ON team_fighter_1.id = fighter_1.team_id
                    LEFT JOIN  #__rt_teams AS team_fighter_2 ON team_fighter_2.id = fighter_2.team_id
                    JOIN #__rt_tournaments ON #__rt_tournaments.id = #__rt_fights.tournament_id
                    WHERE #__rt_fights.tournament_id = $id
        ";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		// Сортируем бои в порядке очередности
		usort($results, array('modelHelper', 'uSortFights'));

		return $results;
	}
}