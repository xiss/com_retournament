<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class="reListTwoCol">
	<!--TODO вывести ссылки на странички финалистов-->
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_PARTICIPANTS') ?></strong><?php echo $this->escape($this->tournament->qt_participants); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_PLACE_1') ?></strong><?php echo $this->escape($this->tournament->place_1); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_FIGHTS') ?></strong><?php echo $this->escape($this->tournament->qt_fights); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_PLACE_2') ?></strong><?php echo $this->escape($this->tournament->place_2); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_DRAWS') ?></strong><?php echo $this->escape($this->tournament->qt_draws); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_PLACE_3') ?></strong><?php echo $this->escape($this->tournament->place_3); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_WARNINGS') ?></strong><?php echo $this->escape($this->tournament->qt_warnings); ?></li>
</ul>