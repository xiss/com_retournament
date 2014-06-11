<?php
defined('_JEXEC') or die('Restricted Access');
?>

<?php foreach ($this->tournaments as $i => $row): ?>

	<tr <?php if (($i % 2) == 0) {
		echo "class='odd'";
	} ?>>
		<td>
			<?php echo $i + 1; ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . $row->id); ?>">
				<?php echo $this->escape($row->name); ?></A>
		</td>
		<td>
			<?php echo viewHelper::prepareDate($row->date); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareTournamentType($this->escape($row->type)); ?>
		</td>
		<td>
			<?php echo $row->qt_fights; ?>
		</td>
		<td>
			<?php echo $row->qt_participants; ?>
		</td>
	</tr>
<?php endforeach; ?>



