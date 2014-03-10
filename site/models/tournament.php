<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modelitem
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
                    -- Количество Участников
                        (SELECT  COUNT( fighter_id_1)
                            FROM(
                                (SELECT DISTINCT fighter_id_1 FROM `#__rt_fights` WHERE `tournament_id` = $id) 
                            UNION 
                                (SELECT DISTINCT fighter_id_2 FROM `#__rt_fights` WHERE `tournament_id` = $id)
                                ) AS tbl) AS qt_participants,
                    -- Количество боев в турнире
                        (SELECT COUNT(id) FROM `#__rt_fights` WHERE `tournament_id` = $id) AS qt_fights,
                    -- Количество ничьих
                        (SELECT COUNT(id) FROM `#__rt_fights` WHERE `tournament_id` = $id AND (inf_hits_1 <> 3 AND inf_hits_2 <> 3) ) AS qt_draws,
                    -- Количество предупреждений
                        (SELECT (SUM(warnings_1)+ SUM(warnings_2)) FROM `#__rt_fights` WHERE `tournament_id` = $id) AS qt_warnings,
                    -- 3 место
                        (SELECT IF(inf_hits_1 = 3,
                                -- Берем либо ник либо сочетание фамилии и имени
                                IF(ISNULL(fighter_1.nick), CONCAT_WS(' ', fighter_1.surname, fighter_1.name), fighter_1.nick), 
                                IF(ISNULL(fighter_2.nick), CONCAT_WS(' ', fighter_2.surname, fighter_2.name), fighter_2.nick))
                            FROM #__rt_fights
                            LEFT JOIN #__rt_participants AS fighter_2 ON fighter_2.id = #__rt_fights.fighter_id_2
                            LEFT JOIN #__rt_participants AS fighter_1 ON fighter_1.id = #__rt_fights.fighter_id_1
                            WHERE #__rt_fights.tournament_id = $id AND `tournament_stage` = 'place3') AS place_3,
                    -- 2 место
                        (SELECT IF(inf_hits_1 <> 3,
                                -- Берем либо ник либо сочетание фамилии и имени
                                IF(ISNULL(fighter_1.nick), CONCAT_WS(' ', fighter_1.surname, fighter_1.name), fighter_1.nick),
                                IF(ISNULL(fighter_2.nick), CONCAT_WS(' ', fighter_2.surname, fighter_2.name), fighter_2.nick))
                            FROM #__rt_fights
                            LEFT JOIN #__rt_participants AS fighter_2 ON fighter_2.id = #__rt_fights.fighter_id_2
                            LEFT JOIN #__rt_participants AS fighter_1 ON fighter_1.id = #__rt_fights.fighter_id_1
                            WHERE #__rt_fights.tournament_id = $id AND `tournament_stage` = 'top2') AS place_2,
                    -- 1 место
                        (SELECT IF(inf_hits_1 = 3,
                                -- Берем либо ник либо сочетание фамилии и имени
                                IF(ISNULL(fighter_1.nick), CONCAT_WS(' ', fighter_1.surname, fighter_1.name), fighter_1.nick), 
                                IF(ISNULL(fighter_2.nick), CONCAT_WS(' ', fighter_2.surname, fighter_2.name), fighter_2.nick))
                            FROM #__rt_fights
                            LEFT JOIN #__rt_participants AS fighter_2 ON fighter_2.id = #__rt_fights.fighter_id_2
                            LEFT JOIN #__rt_participants AS fighter_1 ON fighter_1.id = #__rt_fights.fighter_id_1
                            WHERE #__rt_fights.tournament_id = $id AND `tournament_stage` = 'top2') AS place_1
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
                        `fighter_id_2`,
                        `inf_hits_2`,
                        `warnings_2`,
                        `rating_2`,
                        `fight_type`,
                        `tournament_stage`,
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
                    WHERE #__rt_fights.tournament_id = $id
        ";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		// Сортируем бои в порядке очередности
		usort($results, array($this, 'uSortFights'));

		return $results;
	}
	/**
	 * Очередность боев в рейтинговом турнире
	 *
	 * @var array
	 */
	// TODO Видимо стоит вынести в хелперы
	protected $stagesRT = array("1", "2", "3", "4", "top8", "top4", "place3", "top2");

	/**
	 * callback функция сортировки массива с боями.
	 * Сортирует  бои по порядку
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	protected function uSortFights($a, $b)
	{
		// TODO Возможно стоит объеденить эту функцию с функцией из модели participant и вынести в хелперы
		// Сравниваем тур турнира
		if (array_search($a->tournament_stage, $this->stagesRT) == array_search($b->tournament_stage, $this->stagesRT)) {
			return 0;
		};

		return (array_search($a->tournament_stage, $this->stagesRT) > array_search($b->tournament_stage, $this->stagesRT)) ? -1 : 1;
	}
}