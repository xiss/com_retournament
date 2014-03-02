<?php
defined('_JEXEC') or die('Restricted access');
?>

<?php foreach ($this->fights as $i => $row): ?>
    <tr class = 'odd'>
        <td>
            <?php echo $row->tournament_stage; ?>
        </td>
        <td>
            <?php echo $row->inf_hits; ?>
        </td>
        <td>
            <?php echo $row->miss_hits; ?>
        </td>
        <td>
            <A href = "<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . (int)$row->opponent_id); ?>">
                <?php echo $row->opponent_nick; ?>
            </A>
        </td>
        <td>
            <?php echo $row->rating; ?>
        </td>
        <td>
            <?php echo $row->warnings; ?>
        </td>
        <td>
            <?php echo $row->fight_type; ?>
        </td>
    </tr>
<?php endforeach; ?>



