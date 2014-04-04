<?php
defined('_JEXEC') or die('Restricted access');
?>

<div
    class = "item-page">
    <h2>
        <?php echo $this->escape($this->tournament->name . " " . viewHelper::prepareDate($this->tournament->date)); ?>    </h2>
    <?php echo $this->loadTemplate('statistics'); ?>

    <div id = "chartDivFiling" style = "width: 980px; height: 550px;"></div>
    <br>
    <table width = "100%" class = "reTable">
        <thead><?php echo $this->loadTemplate('fights_head'); ?></thead>
        <tbody><?php echo $this->loadTemplate('fights_body'); ?></tbody>
    </table>
</div>


