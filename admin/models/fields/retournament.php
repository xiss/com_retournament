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
	/**
	 * Тип поля
	 *
	 * @var string
	 */
	protected $type = 'ReTournament';

	/**
	 * Метод для получения списка опций для поля списка
	 *
	 * @return array Массив JHtml опций
	 */
	protected function getOptions()
	{
		// Получаем объект базы данных
		$db = JFactory::getDBO();

		//Конструируем SQL апрос
		$query = $db->getQuery(true);
		$query->select('id, nick, surname, name, middle_name, dob, phone, team_id, rating, wins, draws, loses, miss_hits, inf_hits, tournament_id, qt_tournaments, warnings, state');
		$query->from('#__rt_participants');
		$query->order('id');
		$db->setQuery((string)$query);
		$messages = $db->loadObjectList();

		//Массив JHtml опций
		$options = array();

		if ($messages) {
			foreach ($messages as $message) {
				$options[] = JHtml::_('select.option',
					$message->id,
					$message->nick,
					$message->surname,
					$message->name,
					$message->middle_name,
					$message->dob,
					$message->phone,
					$message->team_id,
					$message->rating,
					$message->wins,
					$message->draws,
					$message->loses,
					$message->miss_hits,
					$message->inf_hits,
					$message->tournament_id,
					$message->qt_tournaments,
					$message->warnings,
					$message->state);
			}
		}
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}
}