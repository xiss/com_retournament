<?php
defined('_JEXEC') or die('Restricted access');
?>
<div
	class="item-page"<?php //echo $this->pageclass_sfx Почемуто на ноутбуке нормально работает а на стационарном он не видит это свойство ?>>
	<h2>
		<?php echo $this->escape($this->team->name) ?>
	</h2>
</div>

<?php echo $this->loadTemplate('statistics'); ?>

<table width="100%" class="reTable">
	<thead><?php echo $this->loadTemplate('line_up_head'); ?></thead>
	<tbody><?php echo $this->loadTemplate('line_up_body'); ?></tbody>
</table>




