<?php
defined('_JEXEC') or die('Restricted access');
?>

<div
	class="item-page">
	<h2>
		<!--        TODO Подтягивать заголовок из настроек-->
		TOURNAMENTS
	</h2>
	<?php echo $this->loadTemplate('statistics'); ?>
	<table width="100%" class="reTable">
		<thead><?php echo $this->loadTemplate('tournaments_head'); ?></thead>
		<tbody><?php echo $this->loadTemplate('tournaments_body'); ?></tbody>
	</table>
</div>


