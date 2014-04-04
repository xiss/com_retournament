<?php
defined('_JEXEC') or die('Restricted access');
?>
<div
	class="item-page">
	<h2>
		<?php echo $this->escape($this->team->name) ?>
	</h2>
</div>

<?php echo $this->loadTemplate('statistics'); ?>

<div id="chartDivRating" style="width: 980px; height: 490px;"></div>

<table width="100%" class="reTable">
	<thead><?php echo $this->loadTemplate('line_up_head'); ?></thead>
	<tbody><?php echo $this->loadTemplate('line_up_body'); ?></tbody>
</table>




