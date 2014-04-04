<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class="reListTwoCol">
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TEAM_STATISTICS_AVG_RATING') ?></strong><?php echo $this->team->avg_rating; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TEAM_STATISTICS_SUM_WINS') ?></strong><?php echo $this->team->sum_wins; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TEAM_STATISTICS_QT_TEAMMATE') ?></strong><?php echo $this->team->qt_teammates; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TEAM_STATISTICS_SUM_LOSES') ?></strong><?php echo $this->team->sum_loses; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TEAM_STATISTICS_SUM_WARNINGS') ?></strong><?php echo $this->team->sum_warnings; ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TEAM_STATISTICS_SUM_DRAWS') ?></strong><?php echo $this->team->sum_draws; ?></li>
</ul>