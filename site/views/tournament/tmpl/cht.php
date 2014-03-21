<?php
defined('_JEXEC') or die('Restricted access');
?>

<div
	class="item-page">
	<h2>
		<?php echo $this->escape($this->tournament->name . " " . viewHelper::prepareDate($this->tournament->date)); ?>    </h2>
	<?php echo $this->loadTemplate('statistics'); ?>
	<table width="100%" class="reTable">
		<thead><?php echo $this->loadTemplate('fights_head'); ?></thead>
		<tbody><?php echo $this->loadTemplate('fights_body'); ?></tbody>
	</table>
</div>


