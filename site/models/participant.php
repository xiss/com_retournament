<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modellist
jimport('joomla.application.component.modellist');
/**
 * Модель ReTournamentParticipant
 */
class ReTournamentModelParticipant extends JModelList
{
    /**
     * Возвращает данные об участнике
     *
     * @return object
     */
    public function getParticipant()
    {
        // Получаем id участника по которому извлекаем информацию
        $id = JFactory::getApplication()->input->getInt('id', null);

        $db = $this::getDbo();
        $db->getQuery(true);
        $query = "
			SELECT `nick`,
				`surname`,
				`middle_name`,
				`qt_tournaments`,
				`warnings`,
				`rating`,
				`wins`,
				`draws`,
				`loses`,
				`miss_hits`,
				`inf_hits`,
				`team_id`,
				(SELECT MAX(`rating_1`) AS `max`
				 FROM `jos_rt_fights`
				 WHERE `fighter_id_1` = $id
					   AND `tournament_part` = 'rating'
				 UNION ALL
				 SELECT MAX(`rating_2`)
				 FROM `jos_rt_fights`
				 WHERE `fighter_id_2` = $id
					   AND `tournament_part` = 'rating'
				 ORDER BY `max` DESC
				 LIMIT 1)                AS max_rating,
				jos_rt_participants.name AS participant_name,
				jos_rt_teams.name        AS team_name
			FROM `jos_rt_participants`
				LEFT JOIN `jos_rt_teams` ON jos_rt_teams.id = jos_rt_participants.team_id
			WHERE jos_rt_participants.id = $id
		";
        $db->setQuery($query);
        $results = $db->loadObject();

        // Расчет процентных долей
        $results->wins_percentage = round(($results->wins / ($results->wins + $results->draws + $results->loses)) * 100);
        $results->draws_percentage = round(($results->draws / ($results->wins + $results->draws + $results->loses)) * 100);
        $results->loses_percentage = round(($results->loses / ($results->wins + $results->draws + $results->loses)) * 100);
        $results->miss_hits_percentage = round(($results->miss_hits / ($results->miss_hits + $results->inf_hits)) * 100);
        $results->inf_hits_percentage = round(($results->inf_hits / ($results->miss_hits + $results->inf_hits)) * 100);

        return $results;
    }
    /**
     * Возвращает список боев участника с параметрами
     *
     * @return mixed
     */
    public function getFights()
    {
        // Получаем id участника для которого ищем бои
        $id = JFactory::getApplication()->input->getInt('id', null);

        $db = $this::getDbo();
        $db->getQuery(true);
        $query = "
			SELECT
				IF(`fighter_id_1` = '$id', inf_hits_1, inf_hits_2)           AS inf_hits,
				IF(`fighter_id_1` = '$id', warnings_1, warnings_2)           AS warnings,
				IF(`fighter_id_1` = '$id', rating_1, rating_2)               AS rating,
				IF(`fighter_id_1` = '$id', rating_change_1, rating_change_2) AS rating_change,
				IF(`fighter_id_1` = '$id', inf_hits_2, inf_hits_1)           AS miss_hits,
				IF(`fighter_id_1` = '$id', fighter_id_2, fighter_id_1)       AS opponent_id,
				IF(`fighter_id_1` = '$id',
				   IF(ISNULL(properties_fighter_2.nick), CONCAT_WS(' ', properties_fighter_2.surname, properties_fighter_2.name), properties_fighter_2.nick),
				   IF(ISNULL(properties_fighter_1.nick), CONCAT_WS(' ', properties_fighter_1.surname, properties_fighter_1.name), properties_fighter_1.nick)
				)                                                            AS opponent_name,
				`fight_type`,
				jos_rt_tournaments.name                                      AS tournament_name,
				jos_rt_tournaments.id                                        AS tournament_id,
				`tournament_stage`,
				`tournament_part`,
				jos_rt_tournaments.type                                      AS tournament_type,
				UNIX_TIMESTAMP(jos_rt_tournaments.date)                      AS tournament_date_ts,
				jos_rt_tournaments.date                                      AS tournament_date
			FROM `jos_rt_fights`
				JOIN `jos_rt_tournaments` ON jos_rt_tournaments.id = jos_rt_fights.tournament_id
				LEFT JOIN `jos_rt_participants` AS properties_fighter_1 ON jos_rt_fights.fighter_id_1 = properties_fighter_1.id
				LEFT JOIN `jos_rt_participants` AS properties_fighter_2 ON jos_rt_fights.fighter_id_2 = properties_fighter_2.id
			WHERE (`fighter_id_1` = $id OR `fighter_id_2` = $id)
			ORDER BY tournament_date DESC
		";
        $db->setQuery($query);
        $results = $db->loadObjectList();

        // Сортируем бои в порядке очередности
        usort($results, array('modelHelper', 'uSortFights'));

        return $results;
    }
    /**
     * Возвращает изменения рейтинга в связке с боями и параметрами
     *
     * @return list of objects
     */
    public function getChartDataRating()
    {
        // Получаем id участника для которого ищем бои
        $id = JFactory::getApplication()->input->getInt('id', null);

        $db = $this::getDbo();
        $db->getQuery(true);
        $query = "
			SELECT
				IF(`fighter_id_1` = '$id', rating_1, rating_2)         AS rating,
				IF(`fighter_id_1` = '$id', fighter_id_2, fighter_id_1) AS opponent_id,
				IF(`fighter_id_1` = '$id',
				   IF(ISNULL(properties_fighter_2.nick), CONCAT_WS(' ', properties_fighter_2.surname, properties_fighter_2.name), properties_fighter_2.nick),
				   IF(ISNULL(properties_fighter_1.nick), CONCAT_WS(' ', properties_fighter_1.surname, properties_fighter_1.name), properties_fighter_1.nick)
				)                                                      AS opponent_name,
				jos_rt_tournaments.name                                AS tournament_name,
				`tournament_stage`,
				`tournament_part`,
				jos_rt_tournaments.type                                AS tournament_type,
				UNIX_TIMESTAMP(jos_rt_tournaments.date)                AS tournament_date_ts,
				jos_rt_tournaments.date                                AS tournament_date
			FROM `jos_rt_fights`
				JOIN `jos_rt_tournaments` ON jos_rt_tournaments.id = jos_rt_fights.tournament_id
				LEFT JOIN `jos_rt_participants` AS properties_fighter_1 ON jos_rt_fights.fighter_id_1 = properties_fighter_1.id
				LEFT JOIN `jos_rt_participants` AS properties_fighter_2 ON jos_rt_fights.fighter_id_2 = properties_fighter_2.id
			WHERE (`fighter_id_1` = $id OR `fighter_id_2` = $id)
				  AND IF(`fighter_id_1` = '$id', rating_1 IS NOT NULL, rating_2 IS NOT NULL)
				  AND fight_type IS NULL
		";
        $db->setQuery($query);
        $results = $db->loadObjectList();

        // Сортируем бои в порядке очередности
        usort($results, array('modelHelper', 'uSortFights'));
        // Меняем порядок на обратный
        $results = array_reverse($results);

        return $results;
    }
}
