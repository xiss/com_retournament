<?php
function reTournamentBuildRoute(&$query)
{

	//	var_dump($query);

	$segments = array();
	if (isset($query['view'])) {
		$segments[] = $query['view'];
		unset($query['view']);
	}
	if (isset($query['id'])) {
		$segments[] = $query['id'];
		unset($query['id']);
	};

	return $segments;
}

function reTournamentParseRoute($segments)
{
	//	var_dump($segments);
	$vars = array();
	switch ($segments[0]) {
		case 'ladder':
			$vars['view'] = 'ladder';
			break;
		case 'participant':
			$vars['view'] = 'participant';
			$vars['id'] = (int)$segments[1];
			break;
		case 'team':
			$vars['view'] = 'team';
			$vars['id'] = (int)$segments[1];
			break;
		case 'tournament':
			$vars['view'] = 'tournament';
			$vars['id'] = (int)$segments[1];
			break;
		case 'tournaments':
			$vars['view'] = 'tournaments';
			break;
	}

	return $vars;
}

?>
 