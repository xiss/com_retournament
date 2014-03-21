<?php
defined('_JEXEC') or die('Restricted access');

/**
 * Содержит методы форматирования и оформлния для видов
 *
 * Class viewHelper
 */
class viewHelper
{
	/**
	 * Возвращает оформленное значение роста рейтинга
	 *
	 * @param $change integer значение изменения рейтинга
	 *
	 * @return string Значение в теге <span> с необходимым стилем
	 */
	static public function prepareRatingChange($change)
	{
		// Если рейтинг вырос
		if ($change > 0) {
			$change = "<span class='up'>$change</span>";

			return $change;
		}
		// Если рейтинг упал
		if ($change < 0) {
			$change = "<span class='down'>" . ltrim($change, '-') . "</span>";

			return $change;
		}
		// Если это новый участник
		if (is_null($change)) {
			$change = JText::_('COM_RETOURNAMENT_HELPER_VIEW_NEW_PARTICIPANT');

			return $change;
		}
		// Если рейтинг не изменился
		if ($change === '0') {
			$change = "<span class='unchanged'></span>";

			return $change;
		}

		return $change;
	}

	/**
	 * Преобразует дату в родительский падеж
	 *
	 * @param $date в формате принимаемом функцией strtotime
	 *
	 * @return string дату в родительском падеже 27 мая 2012 года
	 */
	static public function prepareDate($date)
	{
		$date = new JDate($date);
		$cur_months = $date->format('n');
		$monthsInParDeaths = array(
			1 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_JANUARY'),
			2 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_FEBRUARY'),
			3 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_MARCH'),
			4 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_APRIL'),
			5 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_MAY'),
			6 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_JUNE'),
			7 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_JULY'),
			8 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_AUGUST'),
			9 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_SEPTEMBER'),
			10 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_OCTOBER'),
			11 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_NOVEMBER'),
			12 => JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_DECEMBER')
		);

		return $date->format('j') . ' ' . $monthsInParDeaths[$cur_months] . ' ' . $date->format('Y') . JText::_('COM_RETOURNAMENT_HELPER_VIEW_PARENTAL_DEATHS_ENDING_DATE');
	}

	/**
	 * Заменяет числинные значения спрайтами
	 *
	 * @param $hits integer Количество хитов
	 *
	 * @return string Значение в теге <span> с необходимым стилем
	 */
	static public function prepareHits($hits)
	{
		$result = "";
		if ($hits == 3) {
			$style = 'oneHitWin';
		}
		else {
			$style = 'oneHitLose';
		}
		while ($hits > 0) {
			$result .= "<span class='$style'></span>";
			$hits--;
		}

		return $result;
	}


	/**
	 * Заменяет числинные значения спрайтами
	 *
	 * @param $warnings integer Количество предупреждений
	 *
	 * @return string в теге <span> с необходимым стилем
	 */
	static public function prepareWarnings($warnings)
	{
		$result = "";
		while ($warnings > 0) {
			$result .= "<span class='oneWarning'></span>";
			$warnings--;
		}

		return $result;
	}

	/**
	 * Принимает параметр этапа турнира #__rt_fights.tournament_part и возвращает название этапа
	 *
	 * @param $part string
	 *
	 * @return string
	 */
	static public function preparePart($part)
	{
		switch ($part) {
			case 'losers':
				$result = JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_STAGE_LOSERS');
				break;
			case 'winers':
				$result = JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_STAGE_WINERS');
				break;
			case 'playoff':
				$result = JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_STAGE_PLAYOFF');
				break;
			case 'rating':
				$result = JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_STAGE_RATING');
				break;
			case 'final':
				$result = JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_STAGE_FINAL');
				break;
			default:
				$result = $part;
		}

		return $result;
	}

	/**
	 * Принимает параметры этапа турнира #__rt_fights.tournament_part и #__rt_fights.tournament_stage и возвращает название этапа
	 *
	 * @param $stage string Этап турнира
	 * @param $part  string Часть турнира
	 *
	 * @return string Название этапа
	 */
	static public function prepareStage($stage, $part = '')
	{
		$stage = explode('#', $stage);
		// Если $part казан, то возвращаем модное название этапа
		if ($part === '') {
			$result = '';
			switch ($stage[0]) {
				case '1/16':
					$result .= JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/16');
					break;
				case '1/8':
					$result .= JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/8');
					break;
				case '1/4':
					$result .= JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/4');
					break;
				case '1/2':
					$result .= JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/2');
					break;
				case 'final':
					$result = $stage[1];
					break;
				default:
					$result .= $stage[0] . '#' . $stage[1];
			}
			switch ($part) {
				case 'winers':
					$result .= ' ' . JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_WINERS');
					break;
				case 'final':
					$result .= ' ' . JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_FINALS');
					break;
				case 'losers':
					$result .= ' ' . JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_LOSERS');
					break;
				default:
					$result .= $part;
			}

			return $result;
		}
		// Если не указан возвращаем частичное название
		else {
			switch ($stage[0]) {
				case '1':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1');
					break;
				case '2':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_2');
					break;
				case '3':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_3');
					break;
				case '4':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_4');
					break;
				case "top8":
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_TOP_8');
					break;
				case "top4":
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_TOP_4');
					break;
				case "top2":
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_TOP_2');
					break;
				case "place3":
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_PLACE_3');
					break;
				case '1/16':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/16');
					break;
				case '1/8':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/8');
					break;
				case '1/4':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/4');
					break;
				case '1/2':
					return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_ROUND_1/2');
					break;
				case 'final':
					return $stage[1];
					break;
			}
		}
	}

	/**
	 * Возвращает коментарии к бою
	 *
	 * @param $fightType string Тип боя
	 * @param $infHits   integer Нанесенные хиты
	 *
	 * @return string Комментарий к бою
	 */
	static public function prepareNote($fightType, $infHits)
	{
		if ($fightType == "buy") {
			return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_NOTE_BUY');
		}
		if (($fightType . $infHits) == "forfeit3") {
			return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_FORFEIT_WIN');
		}
		elseif ($fightType == "forfeit") {
			return JText::_('COM_RETOURNAMENT_HELPER_VIEW_FIGHTS_FORFEIT_LOSE');
		}
	}

	/**
	 * Возвращает CSS класс для боя
	 *
	 * @param $fightType
	 *
	 * @return string CSS class
	 */
	static public function prepareCssForFight($fightType)
	{
		if (is_null($fightType)) {
			return "";
		}
		else {
			return " semi";
		}
	}
}

?>
 