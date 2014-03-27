<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php $a = 1; ?>
<?php foreach ($this->tournaments as $i => $row): ?>
	<tr>
		<td>
			<?php echo $a; ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . (int)$row->id); ?>">
				<?php echo $this->escape($row->name); ?></A>
		</td>
		<td>
			<?php echo viewHelper::prepareDate($this->escape($row->date)); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareTournamentType($this->escape($row->type)); ?>
		</td>
		<td>
			<?php echo $this->escape($row->qt_fights); ?>
		</td>
		<td>
			<?php echo $this->escape($row->qt_participants); ?>
		</td>
	</tr>
	<?php $a++; ?>
<?php endforeach; ?>



