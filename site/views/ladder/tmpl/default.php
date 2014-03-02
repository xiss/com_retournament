<?php
defined('_JEXEC') or die('Restricted access');
?>
<div
    class = "item-page"<?php //echo $this->pageclass_sfx Почемуто на ноутбуке нормально работает а на стационарном он не видит это свойство ?>>
    <h2>
        <?php echo $this->escape(JText::_('COM_RETOURNAMENT_LADDER_HEADER') . $this->prepareDate($this->ladderHeading->last_tournament_date)); ?>
    </h2>
</div>


<table width = "100%" class = "reTable">
    <thead><?php echo $this->loadTemplate('head'); ?></thead>
    <tbody><?php echo $this->loadTemplate('body'); ?></tbody>
</table>

