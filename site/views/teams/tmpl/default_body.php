<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->teams as $i => $row): ?>
	<tr <?php if (($i % 2) == 0) {
		echo "class='odd'";
	} ?>>
		<td><?php echo $i + 1; ?></td>
		<td>
			<?php echo viewHelper::prepareLinkTeam($row->id, $row->name); ?>
		</td>
		<td><?php echo $row->qt_participants; ?></td>
		<td><?php echo $row->rating; ?></td>
		<td><?php echo viewHelper::prepareRatingChange($row->rating_change); ?></td>
		<!--		 TODO подумать выводим или нет-->
		<td>TODO</td>
		<td><?php echo $row->sum_wins . "/" . $row->sum_draws . "/" . $row->sum_loses; ?></td>
	</tr>
<?php endforeach; ?>



