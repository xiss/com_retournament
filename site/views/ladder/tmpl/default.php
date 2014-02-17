<?php
defined('_JEXEC') or die('Restricted access');
?>
<p class="retournament">TEST</p>
<div
	class="item-page"<?php //echo $this->pageclass_sfx Почемуто на ноутбуке нормально работает а на стационарном он не видит это свойство ?>">
<h2>
	<?php echo $this->escape(JText::_('COM_RETOURNAMENT_LADDER_HEADER_OPENING') . $this->ladderHeading[0] . JText::_('COM_RETOURNAMENT_LADDER_HEADER_ENDING')); ?>
</h2>
</div>

<table width="100%" class="gkTable2">
	<thead><?php echo $this->loadTemplate('head'); ?></thead>
	<tbody><?php echo $this->loadTemplate('body'); ?></tbody>
	<tfoot><?php echo $this->loadTemplate('foot'); ?></tfoot>
</table>

