<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');
/**
 * ReTournaments View
 */
class ReTournamentViewReTournaments extends JView
{
    /**
     * Сообщения
     *
     * @var array
     */
    protected $items;
    /**
     * Постраничная навигация
     *
     * @var object
     */
    protected $pagination;
    /**
     * Отображаем список сообщений
     *
     * @param string $tpl Имя файла шаблона
     *
     * @return void
     *
     * @throws Exception
     */
    public function display($tpl = null)
    {
        try
        {
            // Получаем данные из модели
            $this->items = $this->get('Items');

            // Получаем объект постраничной навигации
            $this->pagination = $this->get('Pagination');

            // Отображаем представление
            parent::display($tpl);
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    /**
     *Устанавливает панель инструментов
     *
     * @return void
     */
    protected function addTollBar()
    {
        JToolBarHelper::title(JText::_('COM_RETOURNAMENT_CONTROL_PANEL'), 'retournament');
        JToolBarHelper::addNew('retournament.add');
        JToolBarHelper::editList('retournament.edit');
        JToolBarHelper::divider();
        JToolBarHelper::deleteList('', 'retournaments.delete');
    }
}