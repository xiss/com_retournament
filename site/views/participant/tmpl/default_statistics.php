<?php
defined('_JEXEC') or die('Restricted access');
?>
<ul class = "reListTwoCol">
    <li><strong>Команда: </strong><?php echo $this->participant->team_name; ?></li>
    <li><strong>Побед: </strong><?php echo "{$this->participant->wins} ({$this->participant->wins_percentage}%)"; ?></li>
    <li><strong>Посещено турниров: </strong><?php echo $this->participant->qt_tournaments; ?></li>
    <li><strong>Ничьих: </strong><?php echo "{$this->participant->draws} ({$this->participant->draws_percentage}%)"; ?></li>
    <li><strong>Текущий рейтинг: </strong><?php echo $this->participant->rating; ?></li>
    <li><strong>Поражений: </strong><?php echo "{$this->participant->loses} ({$this->participant->loses_percentage}%)"; ?></li>
    <li><strong>Максимальный рейтинг: </strong><?php echo $this->participant->max_rating; ?></li>
    <li><strong>Нанес хитов: </strong><?php echo "{$this->participant->inf_hits} ({$this->participant->inf_hits_percentage}%)"; ?></li>
    <li><strong>Предупреждений: </strong><?php echo $this->participant->warnings; ?></li>
    <li><strong>Получил хитов: </strong><?php echo "{$this->participant->miss_hits} ({$this->participant->miss_hits_percentage}%)"; ?></li>
</ul>