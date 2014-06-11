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
        $id = JFactory::getApplication()->input->getInt('id', null);

        $db = $this::getDbo();
        $db->getQuery(true);
        $query = "
			SELECT jos_rt_teams.name     AS name,
				(
					SELECT ROUND(AVG(rating))
					FROM jos_rt_participants
					WHERE team_id = $id) AS avg_rating,
				(
					SELECT COUNT(jos_rt_participants.id)
					FROM jos_rt_participants
					WHERE team_id = $id) AS qt_teammates,
				(
					SELECT SUM(warnings)
					FROM jos_rt_participants
					WHERE team_id = $id) AS sum_warnings,
				(
					SELECT SUM(wins)
					FROM jos_rt_participants
					WHERE team_id = $id) AS sum_wins,
				(
					SELECT SUM(loses)
					FROM jos_rt_participants
					WHERE team_id = $id) AS sum_loses,
				(
					SELECT SUM(draws)
					FROM jos_rt_participants
					WHERE team_id = $id) AS sum_draws
			FROM `jos_rt_participants`
				JOIN jos_rt_teams ON jos_rt_teams.id = jos_rt_participants.team_id
			WHERE jos_rt_participants.team_id = $id
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
        $id = JFactory::getApplication()->input->getInt('id', null);

        $db = $this::getDbo();
        $db->getQuery(true);
        $query = "
			SELECT
				IF(ISNULL(nick), CONCAT_WS(' ', surname, jos_rt_participants.name), nick) AS name,
				`rating`,
				`rating_change`,
				`wins`,
				`draws`,
				`loses`,
				`miss_hits`,
				`inf_hits`,
				warnings,
				qt_tournaments,
				jos_rt_participants.state                                                 AS state,
				jos_rt_participants.id                                                    AS id,
				jos_rt_tournaments.name                                                   AS tournament_name,
				jos_rt_tournaments.date                                                   AS tournament_date,
				jos_rt_tournaments.id                                                     AS tournament_id
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
    /**
     * Возвращает изменения рейтинга между турнирами в связке со списком участников
     *
     * @return mixed|string
     *
     */
    public function getChartDataRating()
    {
        // Получаем id команды по которой извлекаем информацию
        $id = JFactory::getApplication()->input->getInt('id', null);

        $db = $this::getDbo();
        // Получаем данные для графика
        $db->getQuery(true);
        $query = "
			SELECT
				avg_rating,
				participants_list,
				jos_rt_tournaments.name,
				jos_rt_tournaments.date
			FROM jos_rt_teams_avg_rating
				JOIN jos_rt_tournaments ON jos_rt_tournaments.id = jos_rt_teams_avg_rating.tournament_id
			WHERE team_id = $id
			ORDER BY jos_rt_tournaments.date
		";
        $db->setQuery($query);
        $results = $db->loadObjectList();

        // Получаем список участников с id
        $db->getQuery(true);
        $query = "
			SELECT
				IF(ISNULL(nick), CONCAT_WS(' ', surname, jos_rt_participants.name), nick) AS name,
				id
			FROM jos_rt_participants
		";
        $db->setQuery($query);
        $participantsList = $db->loadAssocList('id', 'name');

        // Заменяем список id спиисоком имен с разделителем <br>
        foreach ($results as $object)
        {
            // Разбираем список айдишников
            $participantsIdList = explode(', ', $object->participants_list);

            // Заменяем каждый айдишник именем
            foreach ($participantsIdList as $key => $value)
            {
                $participantsIdList[$key] = $participantsList[$value];
            }

            // Сортируем списко участников по алфавиту
            sort($participantsIdList);

            // Собираем все обратно
            $object->participants_list = implode('<br>', $participantsIdList);
        }

        return $results;
    }
}
