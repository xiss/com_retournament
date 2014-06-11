<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php $a = 1; ?>
<?php foreach ($this->fights as $i => $row): ?>
	<!--Заголовки, названия этапа-->
	<?php if (!isset($currentPart) or $currentPart <> $row->tournament_part) :
		$currentPart = $row->tournament_part;
		$a = 1;?>
		<tr>
			<th colspan="5">
				<?php echo viewHelper::preparePart($this->escape($row->tournament_part)); ?>
			</th>
		</tr>
	<?php endif; ?>
	<!--Бои-->
	<!--Если бай-->
	<?php if ($row->fight_type == 'buy') {
		// Определяему у какого участника бай fighter_id_1 или fighter_id_2
		if (!is_null($row->fighter_id_1)) {
			?>
			<tr class='<?php if (($i % 2) == 0):echo "odd";
			endif;
			echo viewHelper::prepareCssForFight($row->fight_type);?>'>
				<td>
					<?php echo viewHelper::prepareStage($this->escape($row->tournament_stage)); ?>
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
				</td>
				<td>
					<?php echo viewHelper::prepareNote($row->fight_type, $row->inf_hits_1); ?>
				</td>
			</tr>
		<?php
		}
		if (!is_null($row->fighter_id_2)) {
			?>
			<tr class='<?php if (($i % 2) == 0):echo "odd";
			endif;
			echo viewHelper::prepareCssForFight($row->fight_type);?>'>
				<td>
					<?php echo viewHelper::prepareStage($this->escape($row->tournament_stage)); ?>
				</td>
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
				</td>
				<td>
					<?php echo viewHelper::prepareNote($row->fight_type, $row->inf_hits_2); ?>
				</td>
			</tr>

		<?php
		}
	}
	else {
		?>
		<!--Если не бай-->
		<tr class='<?php if (($i % 2) == 0):echo "odd";
		endif;
		echo viewHelper::prepareCssForFight($row->fight_type);?>'>
			<td rowspan='2'>
				<?php echo viewHelper::prepareStage($this->escape($row->tournament_stage)); ?>
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
				<?php echo viewHelper::prepareWarnings($row->warnings_1); ?>
			</td>
			<td>
				<?php echo viewHelper::prepareNote($row->fight_type, $row->inf_hits_1); ?>
			</td>
		</tr>
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
				<?php echo viewHelper::prepareWarnings($row->warnings_2); ?>
			</td>
			<td>
				<?php echo viewHelper::prepareNote($row->fight_type, $row->inf_hits_2); ?>
			</td>
		</tr>
	<?php
	}
	$a++; ?>
<?php endforeach; ?>



