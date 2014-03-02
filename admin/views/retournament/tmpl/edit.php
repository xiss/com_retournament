<?php
defined('_JEXEC') or die;

JHtml::_('behavior.tooltip');
?>

<form action = "<?php echo JRoute::_('index.php?option=com_retournament&layout=edit&id=' . (int)$this->item->id); ?>"
      method = "post" name = "adminForm" id = "retournament-form">
    <fieldset>
        <legend>
            <?php echo JText::_('COM_RETOURNAMENT_RETOURNAMENT_DETAILS'); ?>

        </legend>
        <ul>
            <?php foreach ($this->form->getFieldset() as $field) : ?>
                <li><?php echo $field->label;
                    echo $field->input; ?></li>
            <?php endforeach; ?>
        </ul>
    </fieldset>
    <div>
        <input type = "hidden" name = "task" value = ""/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>