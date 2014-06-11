<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php $a = 1; ?>
<?php foreach ($this->fights as $i => $row): ?>
	<!--Заголовки, названия этапов-->
	<?php if (!isset($currentStage) or $currentStage <> $row->tournament_stage) :
		$currentStage = $row->tournament_stage;
		$a = 1;?>
		<tr>
			<th colspan="7">
				<?php echo viewHelper::prepareStage($this->escape($row->tournament_stage)); ?>
			</th>
		</tr>
	<?php endif; ?>
	<!--Бои-->
	<tr class='<?php if (($i % 2) == 0):echo "odd";
	endif;
	echo viewHelper::prepareCssForFight($row->fight_type);?>'>
		<td <?php if (!($row->fight_type == "buy")):echo "rowspan = '2'";
		endif;
		echo ">$a";
		?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $row->fighter_id_1); ?>">
				<?php echo $this->escape($row->name_1); ?></A>
		</td>
		<td>
			<?php echo viewHelper::prepareLinkTeam($row->team_id_1, $this->escape($row->team_name_1)) ?>
		</td>
		<td>
			<?php echo viewHelper::prepareHits($row->inf_hits_1); ?>
		</td>
		<td>
			<?php echo $row->rating_1; ?>
		</td>
		<td>
			<?php echo viewHelper::prepareRatingChange($row->rating_change_1); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareWarnings($row->warnings_1); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareNote($row->fight_type, $row->inf_hits_1); ?>
		</td>
	</tr>
	<?php if (!($row->fight_type == 'buy')): ?>
		<tr class='<?php if (($i % 2) == 0) {
			echo "odd";
		}
		echo viewHelper::prepareCssForFight($row->fight_type);?>'>
			<td>
				<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $row->fighter_id_2); ?>">
					<?php echo $this->escape($row->name_2); ?></A>
			</td>
			<td>
				<?php echo viewHelper::prepareLinkTeam($row->team_id_2, $this->escape($row->team_name_2)) ?>
			</td>
			<td>
				<?php echo viewHelper::prepareHits($row->inf_hits_2); ?>
			</td>
			<td>
				<?php echo $row->rating_2; ?>
			</td>
			<td>
				<?php echo viewHelper::prepareRatingChange($row->rating_change_2); ?>
			</td>
			<td>
				<?php echo viewHelper::prepareWarnings($row->warnings_2); ?>
			</td>
			<td>
				<?php echo viewHelper::prepareNote($row->fight_type, $row->inf_hits_2); ?>
			</td>
		</tr>
	<?php endif;
	$a++; ?>
<?php endforeach; ?>



