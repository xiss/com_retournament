<?php
defined('_JEXEC') or die('Restricted access');

// Загружаем библиотеку joomla.application.component.modelitem
jimport('joomla.application.component.modelitem');

/**
 * Модель retournament
 */



class ReTournamentModelReTournament extends JModelItem
{
    protected $msg;

    public function getTable($type = 'ReTournament', $prefix = 'ReTournamentTable', $config = array())
    {
        return JTable::getInstance($type, $prefix, $config);
    }

    public function getMsg()
    {
        if (!isset($this->msg))
        {
            $id = JRequest::getInt('id', 1);
            // Берем данные из TableReTournament
            $table = $this->getTable();

            // Загружаем сообщение
            $table->load($id);

            // Помещаем в msg значение поля greeting
            $this->msg['nick'] = $table->nick;
			$this->msg['id'] = $table->id;
			$this->msg['name'] = $table->name;
        }
        return $this->msg;
    }
}