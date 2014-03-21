<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class="reListTwoCol">
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_PARTICIPANTS') ?></strong><?php echo $this->escape($this->tournament->qt_participants); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_PLACE_1') ?></strong>
		<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $this->escape($this->tournament->place_1_id)); ?>">
			<?php echo $this->escape($this->tournament->place_1_name); ?>
		</A>
	</li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_FIGHTS') ?></strong><?php echo $this->escape($this->tournament->qt_fights); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_PLACE_2') ?></strong>
		<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $this->escape($this->tournament->place_2_id)); ?>">
			<?php echo $this->escape($this->tournament->place_2_name); ?>
		</A>
	</li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_DRAWS') ?></strong><?php echo $this->escape($this->tournament->qt_draws); ?></li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_PLACE_3') ?></strong>
		<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $this->escape($this->tournament->place_3_id)); ?>">
			<?php echo $this->escape($this->tournament->place_3_name); ?>
		</A>
	</li>
	<li><strong><?php echo JText::_('COM_RETOURNAMENT_TOURNAMENT_STATISTICS_QT_WARNINGS') ?></strong><?php echo $this->escape($this->tournament->qt_warnings); ?></li>
</ul>