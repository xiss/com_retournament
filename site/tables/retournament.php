<?php
// Права доступа
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.database.table
jimport('joomla.database.table');

/**
 * Класс ReTournamentTableParticipants
 */
class ReTournamentTableParticipants extends JTable
{
	var $id = "";
	var $nick = null;
	var $surname = null;
	var $name = null;
	var $middle_name = null;
	var $dob = null;
	var $phone = null;
	var $team_id = null;
	var $rating = null;
	var $change = null;
	var $wins = 0;
	var $draws = 0;
	var $loses = 0;
	var $miss_hits = 0;
	var $inf_hits = 0;
	var $tournament_id = null;
	var $qt_tournaments = null;
	var $warnings = 0;
	var $state = "active";

	function __construct(&$db)
	{
		parent::__construct('#__rt_participants', 'id', $db);
	}
}

