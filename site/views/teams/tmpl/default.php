<?php
defined('_JEXEC') or die('Restricted access');
?>
<div
	class="item-page">
	<h2>
		<?php echo $this->escape($this->params->get('page_heading')); ?>
	</h2>
</div>

<table width="100%" class="reTable">
	<thead><?php echo $this->loadTemplate('head'); ?></thead>
	<tbody><?php echo $this->loadTemplate('body'); ?></tbody>
</table>




