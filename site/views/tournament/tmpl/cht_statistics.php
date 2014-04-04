<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class="reListTwoCol">
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_PARTICIPANTS') ?></strong><?php echo $this->tournament->qt_participants; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_FIGHTS') ?></strong><?php echo $this->tournament->qt_fights; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_WARNINGS') ?></strong><?php echo $this->tournament->qt_warnings; ?></li>
</ul>