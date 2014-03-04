<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->ladderList as $i => $row): ?>
	<tr <?php if (($i % 2) == 0) {
		echo "class='odd'";
	} ?>>
		<td>
			<?php echo $i + 1; ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . (int)$row->id); ?>">
				<?php echo $this->escape($row->name); ?></A>
		</td>
		<td>
			<?php echo $this->escape($row->team_name); ?>
		</td>
		<td>
			<?php echo $this->escape($row->rating); ?>
		</td>
		<td>
			<?php echo $this->prepareRatingChange($this->escape($row->rating_change)); ?>
		</td>
		<td>
			<?php echo $this->escape($row->wins . "/" . $row->draws . "/" . $row->loses); ?>
		</td>
		<td>
			<?php echo $this->escape($row->inf_hits . "/" . $row->miss_hits); ?>
		</td>
		<td>
			<?php echo $this->escape($this->prepareDate($row->tournament_date)); ?>
		</td>
	</tr>
<?php endforeach; ?>