<?php
// Ограничение доступа
defined('_JEXEC') or die;

// Импорт библиотеки
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Класс выбора значений из поля для нашего компонента
 */
class JFormFieldReTournament extends JFormFieldList
{
    protected $type = 'ReTournament';

    protected function getOptions()
    {
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('id,greeting');
        $query->from('#__retournament');
        $db->setQuery((string)$query);
        $messages = $db->loadObjectList();
        $options = array();
        if ($messages)
        {
            foreach($messages as $message)
            {
                $options[] = JHtml::_('select.option', $message->id, $message->greeting);
            }
        }
        $options = array_merge(parent::getOptions(), $options);
        return $options;
    }
}