<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modellist
jimport('joomla.application.component.modellist');

/**
 * Модель ReTournamentTournament
 */
class ReTournamentModelTournaments extends JModelList
{
	/**
	 * Получаем данные для таблицы рейтинга
	 *
	 * @return object
	 */
	public function getTournamentsStat()
	{
		// Получаем id турнира для которого ищем статистику
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT 
                        (SELECT COUNT(id) FROM #__rt_participants) AS qt_participants,
                        COUNT(id) AS qt_fights,
                        (SELECT COUNT(id) FROM #__rt_fights WHERE (inf_hits_1 <> 3 AND inf_hits_2 <>3) AND ISNULL(fight_type)) AS qt_draws,
                        (SELECT SUM(warnings_1 + warnings_2) FROM #__rt_fights) AS qt_warnings,
                        (SELECT (COUNT(id)-1) FROM #__rt_teams) AS qt_teams,
                        IF(MAX(`rating_1`)>MAX(`rating_2`), MAX(`rating_1`),MAX(`rating_2`)) AS max_rating,
                        IF(MIN(`rating_1`)<MIN(`rating_2`), MIN(`rating_1`),MIN(`rating_2`)) AS min_rating,
                        (SELECT COUNT(id)FROM #__rt_tournaments WHERE state = 'complete') AS qt_tournaments
                    FROM `#__rt_fights`
                    WHERE ISNULL(fight_type)";
		$db->setQuery($query);
		$results = $db->loadObject();

		return $results;
	}

	/**
	 * Возвращает список турниров с параметрами
	 *
	 * @return array
	 */
	public function getTournaments()
	{
		//TODO Поправить подсчет участников для турнира
		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
                SELECT `id`,
                    `name`,
                    `date`,
                    `type`,
                    (SELECT COUNT(id) FROM jos_rt_fights WHERE tournament_id = jos_rt_tournaments.id) AS qt_fights,
                    -- Количество Участников
                    (SELECT  COUNT(fighter_id_1)
                        FROM(
                            (SELECT DISTINCT fighter_id_1 FROM `jos_rt_fights` WHERE `tournament_id` = 6)
                        UNION
                            (SELECT DISTINCT fighter_id_2 FROM `jos_rt_fights` WHERE `tournament_id` = 6)
                            ) AS tbl) AS qt_participants
                FROM `jos_rt_tournaments` WHERE state = 'complete'
                ORDER BY `date`
        ";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		return $results;
	}
}