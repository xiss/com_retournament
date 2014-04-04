<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class="reListTwoCol">
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_QT_PARTICIPANTS') ?></strong><?php echo $this->tournamentsStat->qt_participants; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_QT_TEAMS') ?></strong><?php echo $this->tournamentsStat->qt_teams; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_QT_FIGHTS') ?></strong><?php echo $this->tournamentsStat->qt_fights; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_MAX_RATING') ?></strong><?php echo $this->tournamentsStat->max_rating; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_QT_DRAWS') ?></strong><?php echo $this->tournamentsStat->qt_draws; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_MIN_RATING') ?></strong><?php echo $this->tournamentsStat->min_rating; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_QT_WARNINGS') ?></strong><?php echo $this->tournamentsStat->qt_warnings; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENTS_STATISTICS_QT_TOURNAMENTS') ?></strong><?php echo $this->tournamentsStat->qt_tournaments; ?></li>
</ul>