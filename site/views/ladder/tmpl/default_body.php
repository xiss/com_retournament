<?php
defined('_JEXEC') or die('Restricted Access');
?>

<?php foreach ($this->ladderList as $i => $row): ?>
    <tr <?php if (($i % 2) == 0)
    {
        echo "class='odd'";
    } ?>>
        <td><?php echo $i + 1; ?></td>
        <td>
            <A href = "<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . $row->id); ?>">
                <?php echo $this->escape($row->name); ?></A>
        </td>
        <td>
            <?php echo viewHelper::prepareLinkTeam($row->team_id, $this->escape($row->team_name)); ?>
        </td>
        <td><?php echo $row->rating; ?></td>
        <td><?php echo viewHelper::prepareRatingChange($row->rating_change); ?></td>
        <td><?php echo $row->wins . "/" . $row->draws . "/" . $row->loses; ?></td>
        <td><?php echo $row->inf_hits . "/" . $row->miss_hits; ?></td>
        <td>
            <A href = "<?php echo JRoute::_('index.php?option=com_retournament&view=tournament&id=' . $row->tournament_id); ?>">
                <?php echo viewHelper::prepareDate($row->tournament_date); ?></A>
        </td>
    </tr>
<?php endforeach; ?>