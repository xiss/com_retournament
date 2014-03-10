<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->teammates as $i => $row): ?>
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
			<?php echo $this->escape($row->rating); ?>
		</td>
		<td>
			<?php echo $this->prepareRatingChange($row->rating_change); ?>
		</td>
		<td>
			<?php echo $this->escape($row->wins . "/" . $row->draws . "/" . $row->loses); ?>
		</td>
		<td>
			<?php echo $this->escape($row->inf_hits . "/" . $row->miss_hits); ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . (int)$row->tournament_id); ?>">
				<?php echo $this->prepareDate($this->escape($row->tournament_date)); ?></A>
		</td>
		<td>
			<?php echo $this->escape($row->state); ?>
		</td>
	</tr>
<?php endforeach; ?>



