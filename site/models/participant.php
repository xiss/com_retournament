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
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		// TODO Изменить max_rating на основе ифа
		$query = "
					SELECT  `nick`,
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
			                (SELECT MAX( `rating_1` ) AS `max`
                            FROM `#__rt_fights`
                            WHERE `fighter_id_1` =$id
                            AND `tournament_part` = 'rating'
                            UNION ALL
                            SELECT MAX( `rating_2` )
                            FROM `#__rt_fights`
                            WHERE `fighter_id_2` =$id
                            AND `tournament_part` = 'rating'
                            ORDER BY `max` DESC
                            LIMIT 1) AS max_rating,
		                    #__rt_participants.name AS participant_name,
							#__rt_teams.name AS team_name
					FROM `#__rt_participants`
					JOIN `#__rt_teams` ON #__rt_teams.id = #__rt_participants.team_id
					WHERE #__rt_participants.id = $id
					";
		$db->setQuery($query);
		$results = $db->loadObject();

		//Расчет процентных долей
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
		$id = JFactory::getApplication()->input->get('id');

		$db = $this::getDbo();
		$db->getQuery(true);
		$query = "
					SELECT
                    IF(`fighter_id_1` = '$id', inf_hits_1, inf_hits_2) AS inf_hits,
                    IF(`fighter_id_1` = '$id', warnings_1, warnings_2) AS warnings,
                    IF(`fighter_id_1` = '$id', rating_1, rating_2) AS rating,
                    IF(`fighter_id_1` = '$id', rating_change_1, rating_change_2) AS rating_change,
                    IF(`fighter_id_1` = '$id', inf_hits_2, inf_hits_1) AS miss_hits,
                    IF(`fighter_id_1` = '$id', fighter_id_2, fighter_id_1) AS opponent_id,
					IF(`fighter_id_1` = '$id',
						IF(ISNULL(properties_fighter_2.nick), CONCAT_WS(' ', properties_fighter_2.surname, properties_fighter_2.name), properties_fighter_2.nick),
						IF(ISNULL(properties_fighter_1.nick), CONCAT_WS(' ', properties_fighter_1.surname, properties_fighter_1.name), properties_fighter_1.nick)
					) AS opponent_name,
                    `fight_type`,
                    #__rt_tournaments.name AS tournament_name,
                    #__rt_tournaments.id AS tournament_id,
                    `tournament_stage`,
                    `tournament_part`,
                    #__rt_tournaments.type AS tournament_type,
                    UNIX_TIMESTAMP(#__rt_tournaments.date) AS tournament_date_ts,
                    #__rt_tournaments.date AS tournament_date
                    FROM `#__rt_fights`
                    JOIN `#__rt_tournaments` ON #__rt_tournaments.id = #__rt_fights.tournament_id
                    LEFT JOIN `#__rt_participants` AS properties_fighter_1 ON #__rt_fights.fighter_id_1 = properties_fighter_1.id
                    LEFT JOIN `#__rt_participants` AS properties_fighter_2 ON #__rt_fights.fighter_id_2 = properties_fighter_2.id
                    WHERE (`fighter_id_1` = $id OR `fighter_id_2` = $id)
                    ORDER BY tournament_date DESC
					";
		$db->setQuery($query);
		$results = $db->loadObjectList();

		// Сортируем бои в порядке очередности
		usort($results, array('modelHelper', 'uSortFights'));

		return $results;
	}
}
