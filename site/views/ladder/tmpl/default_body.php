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
			<?php echo $row['nick']; ?>
		</td>
		<td>
			<?php echo $row['team_name']; ?>
		</td>
		<td>
			<?php echo $row['rating']; ?>
		</td>
		<td>
			<?php echo $row['rating_change']; ?>
		</td>
		<td>
			<?php echo("{$row['wins']}/{$row['draws']}/{$row['loses']}"); ?>
		</td>
		<td>
			<?php echo("{$row['inf_hits']}/{$row['miss_hits']}"); ?>
		</td>
		<td>
			<?php echo $row['tournament_name']; ?>
		</td>
	</tr>
<?php endforeach; ?>