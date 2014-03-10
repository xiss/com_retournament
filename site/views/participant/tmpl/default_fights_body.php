<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->fights as $i => $row): ?>
	<!--Заголовки, названия турниров-->
	<?php if (!isset($curentTournament) or $curentTournament <> $row->tournament_id) :
		$curentTournament = $row->tournament_id; ?>
		<tr>
			<th colspan="7">
				<A href="<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . $this->escape((int)$row->tournament_id)); ?>">
					<?php echo $this->escape($row->tournament_name . " " . viewHelper::prepareDate($row->tournament_date)); ?>
				</A>
			</th>
		</tr>
	<?php endif; ?>
	<!--Бои в турнирах-->
	<tr class='odd<?php echo viewHelper::prepareCssForFight($row->fight_type) ?>'>
		<td>
			<?php echo viewHelper::prepareStage($this->escape($row->tournament_stage)); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareInfHits($this->escape($row->inf_hits)); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareMissHits($this->escape($row->miss_hits)); ?>
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
			<?php echo viewHelper::prepareWarnings($this->escape($row->warnings)); ?>
		</td>
		<td>
			<?php echo viewHelper::prepareNote($this->escape($row->fight_type), $this->escape($row->inf_hits)); ?>
		</td>
	</tr>
<?php endforeach; ?>



