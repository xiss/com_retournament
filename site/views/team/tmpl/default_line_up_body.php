<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->teammates as $i => $row): ?>
	<!--Заголовки-->
	<?php if (!isset($currentStateGroup) or $currentStateGroup <> $row->state) :
		$currentStateGroup = $row->state;
		$a = 1;?>
		<tr>
			<th colspan="9">
				<?php
				// TODO Еще подумать над названиями этих двух групп
				if ($row->state == 'active') {
					echo JText::_('COM_RETOURNAMENT_TEAM_LINE_UP_HEADING_ACTIVE');
				}
				if ($row->state == 'inactive') {
					echo JText::_('COM_RETOURNAMENT_TEAM_LINE_UP_HEADING_INACTIVE');
				}?>
			</th>
		</tr>
	<?php endif; ?>


	<tr <?php if (($i % 2) == 0) {
		echo "class='odd'";
	} ?>>
		<td>
			<?php echo $a; ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . (int)$row->id); ?>">
				<?php echo $this->escape($row->name); ?></A>
		</td>
		<td>
			<?php echo $this->escape($row->rating); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareRatingChange($row->rating_change); ?>
		</td>
		<td>
			<?php echo $this->escape($row->wins . "/" . $row->draws . "/" . $row->loses); ?>
		</td>
		<td>
			<?php echo $this->escape($row->inf_hits . "/" . $row->miss_hits); ?>
		</td>
		<td>
			<?php echo $this->escape($row->warnings); ?>
		</td>
		<td>
			<?php echo $this->escape($row->qt_tournaments); ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . (int)$row->tournament_id); ?>">
				<?php echo viewHelper::prepareDate($this->escape($row->tournament_date)); ?></A>
		</td>
	</tr>
	<?php $a++;
endforeach; ?>



