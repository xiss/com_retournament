<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->fights as $i => $row): ?>
	<!--Заголовки, названия турниров-->
	<?php if (!isset($curentTournament) or $curentTournament <> $row->tournament_id) :
		$curentTournament = $row->tournament_id; ?>
		<tr>
			<th colspan="7">
				<?php echo $this->escape($row->tournament_name . " " . $this->prepareDate($row->tournament_date)); ?>
			</th>
		</tr>
	<?php endif; ?>
	<!--Бои в турнирах-->
	<tr class='<?php echo $this->prepareCssForFight($row->fight_type) ?>'>
		<td>
			<?php echo $this->prepareStage($this->escape($row->tournament_stage)); ?>
		</td>
		<td>
			<?php echo $this->prepareInfHits($this->escape($row->inf_hits)); ?>
		</td>
		<td>
			<?php echo $this->prepareMissHits($this->escape($row->miss_hits)); ?>
		</td>
		<td>
			<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $this->escape((int)$row->opponent_id)); ?>">
				<?php echo $this->escape($row->opponent_name); ?>
			</A>
		</td>
		<td>
			<?php echo $this->escape($row->rating); ?>
		</td>
		<td>
			<?php echo $this->prepareWarnings($this->escape($row->warnings)); ?>
		</td>
		<td>
			<?php echo $this->prepareNote($this->escape($row->fight_type), $this->escape($row->inf_hits)); ?>
		</td>
	</tr>
<?php endforeach; ?>



