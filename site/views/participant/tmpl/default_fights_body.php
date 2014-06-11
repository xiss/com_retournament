<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->fights as $i => $row): ?>
	<!--Заголовки, названия турниров-->
	<?php if (!isset($curentTournament) or $curentTournament <> $row->tournament_id) :
		$curentTournament = $row->tournament_id; ?>
		<tr>
			<th colspan="7">
				<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . $row->tournament_id); ?>">
					<?php echo $this->escape($row->tournament_name . " " . viewHelper::prepareDate($row->tournament_date)); ?>
				</A>
			</th>
		</tr>
	<?php endif; ?>
	<!--Бои в турнирах-->
	<tr class='odd<?php echo viewHelper::prepareCssForFight($row->fight_type) ?>'>
		<td>
			<?php echo viewHelper::prepareStage($this->escape($row->tournament_stage), $this->escape($row->tournament_part)); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareHits($row->inf_hits); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareHits($row->miss_hits); ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $row->opponent_id); ?>">
				<?php echo $this->escape($row->opponent_name); ?>
			</A>
		</td>
		<td>
			<?php echo $row->rating; ?>
		</td>
		<td>
			<?php echo viewHelper::prepareRatingChange($row->rating_change); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareWarnings($row->warnings); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareNote($this->escape($row->fight_type), $row->inf_hits); ?>
		</td>
	</tr>
<?php endforeach; ?>



