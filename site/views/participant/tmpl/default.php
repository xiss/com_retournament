<?php
defined('_JEXEC') or die('Restricted access');
?>

<div
	class="item-page">
	<h2>
		<?php echo $this->escape($this->prepareParticipantHeader($this->participant->participant_name, $this->participant->surname, $this->participant->middle_name, $this->participant->nick)); ?>
	</h2>
	<?php echo $this->loadTemplate('statistics'); ?>
	<table width="100%" class="reTable">
		<thead><?php echo $this->loadTemplate('fights_head'); ?></thead>
		<tbody><?php echo $this->loadTemplate('fights_body'); ?></tbody>
	</table>
</div>


