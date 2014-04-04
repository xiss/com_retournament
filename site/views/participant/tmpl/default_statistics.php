<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class="reListTwoCol">
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_TEAM') ?>
		</strong>
		<?php echo viewHelper::prepareLinkTeam($this->participant->team_id, $this->escape($this->participant->team_name)) ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_WINS') ?>
		</strong>
		<?php echo $this->participant->wins . " (" . $this->participant->wins_percentage . "%)"; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_QT_TOURNAMENTS') ?>
		</strong>
		<?php echo $this->participant->qt_tournaments; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_DRAWS') ?>
		</strong>
		<?php echo $this->participant->draws . " (" . $this->participant->draws_percentage . "%)"; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_RATING') ?>
		</strong>
		<?php echo $this->participant->rating; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_LOSES') ?>
		</strong>
		<?php echo $this->participant->loses . " (" . $this->participant->loses_percentage . "%)"; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_MAX_RATING') ?>
		</strong>
		<?php echo $this->participant->max_rating; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_INF_HITS') ?>
		</strong>
		<?php echo $this->participant->inf_hits . " (" . $this->participant->inf_hits_percentage . "%)"; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_WARNINGS') ?>
		</strong>
		<?php echo $this->participant->warnings; ?>
	</li>
	<li>
		<strong>
			<?php echo JText::_('COM_RETOURNAMENT_PARTICIPANT_STATISTICS_MISS_HITS') ?>
		</strong>
		<?php echo $this->participant->miss_hits . " (" . $this->participant->miss_hits_percentage . "%)"; ?>
	</li>
</ul>