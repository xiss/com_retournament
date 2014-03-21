<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Содержит вспомогательные методы и данные для моделей
 *
 * Class modelHelper
 */
class modelHelper
{
	/**
	 * Очередность туров в рейтинговом турнире
	 *
	 * @var array
	 */
	protected static $stagesRT = array("1", "2", "3", "4", "top8", "top4", "place3", "top2");

	/**
	 * Очередность туров в турнире чемпионов
	 *
	 * @var array
	 */
	protected static $stagesCHT = array("1/16#1", "1/16#2", "1/16#3", "1/16#4", "1/16#5", "1/16#6", "1/16#7", "1/16#8",
		"1/8#1", "1/8#2", "1/8#3", "1/8#4", "1/8#5", "1/8#6", "1/8#7", "1/8#8",
		"1/4#1", "1/4#2", "1/4#3", "1/4#4",
		"1/2#1", "1/2#2", 'final#1', 'final#2',);

	/**
	 * Очередность этапов в турнире чемпионов
	 *
	 * @var array
	 */
	protected static $partsCHT = array("winers", "losers", "final");

	/**
	 * callback функция сортировки массива с боями.
	 * Сортирует  бои по порядку
	 *
	 * Структура объекта:
	 * stdClass Object
	 *        (
	 *        [tournament_stage] =>
	 *        [tournament_part] =>
	 *        [tournament_type] =>
	 *        [tournament_date_ts] =>
	 *      )
	 *
	 * @param $a
	 * @param $b
	 *
	 * @return int
	 */
	static public function uSortFights($a, $b)
	{
		// Сравниваем дату турнира
		if ($a->tournament_date_ts == $b->tournament_date_ts) {
			// Определяем тип турнира
			if ($a->tournament_type == 'rt') {
				// Сравниваем тур турнира
				if (array_search($a->tournament_stage, static::$stagesRT) == array_search($b->tournament_stage, static::$stagesRT)) {
					return 0;
				};

				return (array_search($a->tournament_stage, static::$stagesRT) > array_search($b->tournament_stage, static::$stagesRT)) ? -1 : 1;
			}
			else {
				// Если это один этап (верхняя нижняя)
				if ($a->tournament_part == $b->tournament_part) {
					// Сравниваем тур турнира
					if (array_search($a->tournament_stage, static::$stagesCHT) == array_search($b->tournament_stage, static::$stagesCHT)) {
						return 0;
					};

					return (array_search($a->tournament_stage, static::$stagesCHT) > array_search($b->tournament_stage, static::$stagesCHT)) ? -1 : 1;
				}

				return (array_search($a->tournament_part, static::$partsCHT) > array_search($b->tournament_part, static::$partsCHT)) ? -1 : 1;
			}
		}

		return ($a->tournament_date_ts > $b->tournament_date_ts) ? -1 : 1;
	}
}

?>
 