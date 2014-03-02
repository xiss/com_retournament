<?php
defined('_JEXEC') or die;
jimport('joomla.application.component.view');
/**
 * HTML представление редактирования сообщения
 */
class ReTournamentViewReTournament extends JView
{
    /**
     * Сообщение
     *
     * @var object
     */
    protected $item;
    /**
     * Объект формы
     *
     * @var array
     */
    protected $form;
    /**
     * Отображает представление
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
            $this->form = $this->get('Form');
            $this->item = $this->get('Item');

            // Устанавливаем панель инструментов
            $this->addToolBar();

            // Отображаем представление
            parent::display($tpl);
        }
        catch (Exception $e)
        {
            throw new Exception($e->getMessage());
        }
    }
    /**
     * Устанавливает панель инструментов
     *
     * @return void
     */
    protected function addToolBar()
    {
        JFactory::getApplication()->input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);

        JToolBarHelper::title($isNew ?
            JText::_('COM_RETOURNAMENT_RETOURNAMENT_MANAGER_NEW') :
            JText::_('COM_RETOURNAMENT_RETOURNAMENT_MANAGER_EDIT'), 'retournament');
        JToolBarHelper::apply('retournament.apply', 'JTOOLBAR_APPLY');
        JToolBarHelper::save('retournament.save');
        JToolBarHelper::cancel('retournament.cancel', $isNew ? 'JTOOLBARCANCEL' : 'JTOOLBAR_CLOSE');
    }
}
?>