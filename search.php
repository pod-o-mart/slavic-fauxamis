<?php

$searchterm = trim(str_replace("́","",$_GET['search']));
$searchterm = mb_convert_case($searchterm, MB_CASE_LOWER, "UTF-8");
if ($preference_meanings == 'on') {
	$meanings_query= mysqli_query($db, "SELECT * FROM `maps_meanings2_` WHERE meaning_1 LIKE '%".$searchterm."%' OR meaning_2 LIKE '%".$searchterm."%' OR meaning_3 LIKE '%".$searchterm."%' OR meaning_4 LIKE '%".$searchterm."%' OR meaning_5 LIKE '%".$searchterm."%' OR meaning_6 LIKE '%".$searchterm."%' OR meaning_7 LIKE '%".$searchterm."%' OR map_name LIKE '%".$searchterm."%'");
	$foundmeanings_contents=array();
//echo "<pre>";print_r($foundmeanings_contents);echo "</pre>";

	foreach ($meanings_query as $meanings_search) {
		$k++;
		$str_meaning_1 = stripos($meanings_search['meaning_1'], $searchterm);
		if ($str_meaning_1 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"1",$meanings_search['language'],$meanings_search['meaning_1'],$meanings_search['map_name']);
		}
		$str_meaning_2 = stripos($meanings_search['meaning_2'], $searchterm);
		if ($str_meaning_2 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"2",$meanings_search['language'],$meanings_search['meaning_2'],$meanings_search['map_name']);
		}
		$str_meaning_3 = stripos($meanings_search['meaning_3'], $searchterm);
		if ($str_meaning_3 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"3",$meanings_search['language'],$meanings_search['meaning_3'],$meanings_search['map_name']);
		}
		$str_meaning_4 = stripos($meanings_search['meaning_4'], $searchterm);
		if ($str_meaning_4 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"4",$meanings_search['language'],$meanings_search['meaning_4'],$meanings_search['map_name']);
		}
		$str_meaning_5 = stripos($meanings_search['meaning_5'], $searchterm);
		if ($str_meaning_5 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"5",$meanings_search['language'],$meanings_search['meaning_5'],$meanings_search['map_name']);
		}
		$str_meaning_6 = stripos($meanings_search['meaning_6'], $searchterm);
		if ($str_meaning_6 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"6",$meanings_search['language'],$meanings_search['meaning_6'],$meanings_search['map_name']);
		}
		$str_meaning_7 = stripos($meanings_search['meaning_7'], $searchterm);
		if ($str_meaning_7 !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"7",$meanings_search['language'],$meanings_search['meaning_7'],$meanings_search['map_name']);
		}
		$str_meaning_map = stripos($meanings_search['map_name'], $searchterm);
		if ($str_meaning_map !== false) {
			$foundmeanings_contents[]=array($meanings_search['map_id'],"",$meanings_search['language'],"",$meanings_search['map_name']);
		}
	}

	$d=0;
	$searchinsql_querystring="SELECT * FROM `maps2_` WHERE `form` LIKE '%".$searchterm."%' OR `comment_1` LIKE '%".$searchterm."%' OR `comment_2` LIKE '%".$searchterm."%' OR `comment_3` LIKE '%".$searchterm."%' OR `comment_4` LIKE '%".$searchterm."%' OR `comment_5` LIKE '%".$searchterm."%' OR `comment_6` LIKE '%".$searchterm."%' OR `comment_7` LIKE '%".$searchterm."%' OR `aspect` LIKE '%".$searchterm."%' OR `grammar` LIKE '%".$searchterm."%' OR `see_also` LIKE '%".$searchterm."%' OR `semantics` LIKE '%".$searchterm."%' OR `synonymity` LIKE '%".$searchterm."%'";
	foreach ($foundmeanings_contents as $searchinsql) {
		if ($foundmeanings_contents[$d][1]) {
			$searchinsql_querystring = $searchinsql_querystring.' OR (meaning_'.$foundmeanings_contents[$d][1].'='.$foundmeanings_contents[$d][1].' AND map_id='.$foundmeanings_contents[$d][0].')';
		}
		if ($foundmeanings_contents[$d][4]) {
			$searchinsql_querystring = $searchinsql_querystring.' OR map_id='.$foundmeanings_contents[$d][0];
		}
		$d++;
	}
	$query_maps = $searchinsql_querystring;
	//echo $query_maps;
	//echo "<pre>";print_r($foundmeanings_contents);echo "</pre>";
}
else {
	if ($preference_string == 'contains') {
		$query_maps = "select * from maps2_ where replace(form, '́', '') like '%" . $searchterm . "%' OR replace(synonymity, '́', '') like '%" . $searchterm . "%' ORDER BY `form`, `language` ASC";
	}
	elseif  ($preference_string == 'exact') {
		$query_maps = "select * from maps2_ where replace(form, '́', '') = '" . $searchterm . "' OR replace(synonymity, '́', '') = '" . $searchterm . "' ORDER BY `form`, `language` ASC";
	}
	elseif  ($preference_string == 'ends') {
		$query_maps = "select * from maps2_ where replace(form, '́', '') like '%" . $searchterm . "' OR replace(synonymity, '́', '') like '%" . $searchterm . "' ORDER BY `form`, `language` ASC";
	}
	else {
		$query_maps = "select * from maps2_ where replace(form, '́', '') like '" . $searchterm . "%' OR replace(synonymity, '́', '') like '" . $searchterm . "%' ORDER BY `form`, `language` ASC";
	}
}

$ergebnis_maps = mysqli_query($db, $query_maps);
echo '<div class="result">';
echo '<h2>Search result</h2>';
if (mysqli_num_rows($ergebnis_maps) == 0) {
	echo '<span style="margin-top:40px;" class="alert alert-warning" role="alert">No matches</span>';
}
else
{
	echo '<span style="margin-top:40px;" class="alert alert-success" role="alert">Number of matches: '.mysqli_num_rows($ergebnis_maps).'</span>';
	echo '<table class="table-compare table table-sm table-striped table-hover">
	<thead><tr>
	<th>Found terms</th>';
	if ($preference_meanings == 'on') {
		echo '<th>Matches in meanings, synonyms, grammar or comments</th>';
	}
	echo '</tr></thead><tbody>';

while ($zeile_maps = $ergebnis_maps->fetch_assoc()) {
	$zeile_maps_form = $zeile_maps['form'];
	$zeile_maps_semantics = $zeile_maps['semantics'];
	$zeile_maps_synonymity = $zeile_maps['synonymity'];
	if (($preference_string) AND ($preference_string != 'exact')){
		$pattern = '/('.$searchterm.')/i';
		$replacement = '<span style="background-color:yellow">$1</span>';
		$string = $zeile_maps_form;
		$zeile_maps_form = preg_replace($pattern, $replacement, $string);
		$string = $zeile_maps_semantics;
		$zeile_maps_semantics = preg_replace($pattern, $replacement, $string);
		$string = $zeile_maps_synonymity;
		$zeile_maps_synonymity = preg_replace($pattern, $replacement, $string);
	}

	echo '<tr><td><a href="'.$pageURL.'?mode=showterm&term_id=' . $zeile_maps['map_id'] . '&language=' . $zeile_maps['language'] . '&form=' . $zeile_maps['form'] . '">'.$zeile_maps['language'] . ' <strong>' . $zeile_maps_form . '</strong></a>';
	if ($zeile_maps['form'] =='∅') {
		echo ' - no corresponing term';
	}
	if ($zeile_maps['aspect']) {
		echo ' <span title="Aspect" class="aspect">'.$zeile_maps['aspect'].'</span>';
	}
	if ($zeile_maps['semantics']) {
				echo ' <span class="note">('.$zeile_maps_semantics.')</span>';
			}
	if ($zeile_maps['synonymity']) {
		echo ' <span class="note synonym">syn.:</span> <em>'.$zeile_maps_synonymity.'</em>';
	}
	echo '</td>';

	if ($preference_meanings == 'on') {
		echo '<td>';
		unset($langbefore);
		unset($stringbefore);
		$map_names = array_column($foundmeanings_contents, 4, 0);
		$map_names_result=array_flip($map_names);
		$map_name_display = array_search($zeile_maps['map_id'],$map_names_result);
		if ($map_name_display) {
			echo '<span title="Map name"><strong>{</strong>'.preg_replace($pattern, $replacement, $map_name_display).'<strong>}</strong></span> ';
		}

		foreach ($foundmeanings_contents as $meaning_result) {
			if ($langbefore != $meaning_result[2]) {
				unset($langbefore);
				unset($cnt);
			}
			if (($stringbefore != $meaning_result[3]) OR ($langbefore != $meaning_result[2])){
				unset($stringbefore);
			}
			if ($meaning_result[0] == $zeile_maps['map_id']) {
				$string = $meaning_result[3];
				$meaning_string = preg_replace($pattern, $replacement, $string);
				if (($meaning_result[2] =='English') AND ($meaning_string)) {
					echo '<strong><em>'.$meaning_string.'</em>; </strong>';
				}
				elseif ($meaning_result[2] == $zeile_maps['language']) {
					if (($string != $zeile_maps['form']) AND ($string)){
						echo '<span class="note synonym" style="text-decoration:underline;">'.$meaning_result[2].' syn.</span>: '.$meaning_string;  //Doppelte Synonyme raus?
						if ($cnt >= 1) {
							echo '; ';
						}
						$cnt++;
					}
				}
				else {
					if (($langbefore != $meaning_result[2]) AND ($meaning_string)) {
						echo '<span style="text-decoration:underline;">'.$meaning_result[2].'</span>: ';
						//$cnt++;
					}
					if (($stringbefore != $meaning_result[3]) AND ($meaning_string)) {

						echo '<em>'.$meaning_string.'</em>';
						if ($cnt >= 1) {
							echo '; ';
						}
						$cnt++;
					}
				$langbefore = $meaning_result[2];
				$stringbefore = $meaning_result[3];
				}
			}
		}
		if (stripos($zeile_maps['comment_1'], $searchterm) !== false) {
			$string = $zeile_maps['comment_1'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_1'];
		}
		if (stripos($zeile_maps['comment_2'], $searchterm) !== false) {
			$string = $zeile_maps['comment_2'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_2'];
		}
		if (stripos($zeile_maps['comment_3'], $searchterm) !== false) {
		/*	$pos_start = stripos($zeile_maps['comment_3'],$searchterm);
			$newstr = substr_replace($zeile_maps['comment_3'], "<span style='background-color:yellow;'>", $pos_start, 0);
			$length_searchterm = strlen($searchterm);
			$pos_start2 = stripos($newstr,$searchterm);
			$pos_end = $pos_start2 + $length_searchterm;
			$newstr2 = substr_replace($newstr, "</span>", $pos_end, 0);
			echo $newstr2;*/
			$string = $zeile_maps['comment_3'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_3'];
		}
		if (stripos($zeile_maps['comment_4'], $searchterm) !== false) {
			$string = $zeile_maps['comment_4'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_4'];
		}
		if (stripos($zeile_maps['comment_5'], $searchterm) !== false) {
			$string = $zeile_maps['comment_5'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_5'];
		}
		if (stripos($zeile_maps['comment_6'], $searchterm) !== false) {
			$string = $zeile_maps['comment_6'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_6'];
		}
		if (stripos($zeile_maps['comment_7'], $searchterm) !== false) {
			$string = $zeile_maps['comment_7'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['comment_7'];
		}
		if (stripos($zeile_maps['grammar'], $searchterm) !== false) {
			$string = $zeile_maps['grammar'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['grammar'];
		}
		if (stripos($zeile_maps['see_also'], $searchterm) !== false) {
			$string = $zeile_maps['see_also'];
			echo preg_replace($pattern, $replacement, $string);
		}
		else {
			echo $zeile_maps['see_also'];
		}
		echo '</td>';
	}
	echo '</tr>';
}
}
echo '</tbody></table></div>';
?>
