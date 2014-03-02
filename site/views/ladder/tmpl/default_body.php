<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach ($this->ladderList as $i => $row): ?>
    <tr <?php if (($i % 2) == 0)
    {
        echo "class='odd'";
    } ?>>
        <td>
            <?php echo $i + 1; ?>
        </td>
        <td>
            <A href = "<?php echo JRoute::_('index.php?option=com_retournament&view=participant&id=' . (int)$row->id); ?>">
                <?php echo $row->nick; ?></A>
        </td>
        <td>
            <?php echo $row->team_name; ?>
        </td>
        <td>
            <?php echo $row->rating; ?>
        </td>
        <td>
            <?php echo $this->prepareRatingChange($row->rating_change); ?>
        </td>
        <td>
            <?php echo("{$row->wins}/{$row->draws}/{$row->loses}"); ?>
        </td>
        <td>
            <?php echo("{$row->inf_hits}/{$row->miss_hits}"); ?>
        </td>
        <td>
            <?php echo $this->prepareDate($row->tournament_date); ?>
        </td>
    </tr>
<?php endforeach; ?>