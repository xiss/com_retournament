<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

foreach ($this->items as $i => $item): ?>
    <tr class = "row<?php echo $i % 2; ?>">
        <td>
            <?php echo $item->id; ?>
        </td>
        <td>
            <?php echo $item->nick; ?>
        </td>
        <td>
            <?php echo $item->surname; ?>
        </td>
        <td>
            <?php echo $item->name; ?>
        </td>
        <td>
            <?php echo $item->middle_name; ?>
        </td>
        <td>
            <?php echo $item->dob; ?>
        </td>
        <td>
            <?php echo $item->phone; ?>
        </td>
        <td>
            <?php echo $item->team_id; ?>
        </td>
        <td>
            <?php echo $item->rating; ?>
        </td>
        <td>
            <?php echo $item->wins; ?>
        </td>
        <td>
            <?php echo $item->draws; ?>
        </td>
        <td>
            <?php echo $item->loses; ?>
        </td>
        <td>
            <?php echo $item->miss_hits; ?>
        </td>
        <td>
            <?php echo $item->inf_hits; ?>
        </td>
        <td>
            <?php echo $item->tournament_id; ?>
        </td>
        <td>
            <?php echo $item->qt_tournaments; ?>
        </td>
        <td>
            <?php echo $item->warnings; ?>
        </td>
        <td>
            <?php echo $item->state; ?>
        </td>
    </tr>
<?php endforeach; ?>