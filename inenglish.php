<?php

$id_tobeckecked =$_GET['term_id'];
$langtobechecked=$_GET['language'];
$formtobechecked=$_GET['form'];
$lang_tobechecked = $db->query("SELECT * FROM `maps2_` WHERE `language` ='" . $langtobechecked . "' AND `form` ='" . $formtobechecked . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_object()->lang;
$lang_tobechecked_remove = $lang_tobechecked;
$query_5 = "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' ORDER BY form ASC";
$ergebnis_5 = mysqli_query($db, $query_5);
$ergebnis_aktuell = $db->query("SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND lang='" . $lang_tobechecked . "' AND `form` ='" . $formtobechecked . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_assoc();
// array für zu prüfende sprache holen
$meanings_array_aktuell = array(0, $ergebnis_aktuell['meaning_1'], $ergebnis_aktuell['meaning_2'], $ergebnis_aktuell['meaning_3'], $ergebnis_aktuell['meaning_4'], $ergebnis_aktuell['meaning_5'], $ergebnis_aktuell['meaning_6'], $ergebnis_aktuell['meaning_7']);
//echo "<pre>";print_r($meanings_array_aktuell);echo "</pre>";

//arrays für andere sprachen holen: $meanings_array_lang
$list_langs=array();
foreach ($ergebnis_5 as $zeile_1 )  {
	if ($zeile_1['lang'] != $ergebnis_aktuell['lang']) {
		$list_langs[] = $zeile_1['lang'];
		${'meanings_array_' . $zeile_1['lang']} = array(0, $zeile_1['meaning_1'], $zeile_1['meaning_2'], $zeile_1['meaning_3'], 	$zeile_1['meaning_4'], $zeile_1['meaning_5'], $zeile_1['meaning_6'], $zeile_1['meaning_7']);
		${'form_' . $zeile_1['lang']} = $zeile_1['form'];
	}
}


/// Doppelte Lemmata einer Sprache holen, um sie weiter unten wg. Überschneidungen rauszunehmen
$query_see_also = "SELECT * FROM maps2_ WHERE `map_id` ='" . $id_tobeckecked . "' AND `see_also`='x' ORDER BY `form` ASC";
$ergebnis_see_also = mysqli_query($db, $query_see_also);
$see_also_langs=array();
while ($zeile_4 = $ergebnis_see_also->fetch_assoc()) {
	$see_also_langs[] = $zeile_4['lang'];
	if ($zeile_4['lang'] == $lang_tobechecked_remove) {
		$see_also_sameaslemma = 1;
	}
}

echo '<div class="terminfo"><ul>';

$falsefriendcheck=array();
foreach ($list_langs as $zeile_2 =>$lang_name)  {
	$false=array_intersect($meanings_array_aktuell,${'meanings_array_' . $lang_name});
	$tmp2 = array_filter($false);
	$nothing=${'meanings_array_' . $lang_name};
	$tmp = array_filter($nothing);
	if ((empty($tmp2)) AND (!empty($tmp))) {
		$falsefriendcheck[] = $lang_name;
		${'isfalse_' . $lang_name} = 1;
	}
}

foreach ($see_also_langs as $langtoberemoved =>$remove) {  //rausnehmen, wenn in einer Sprache zwei Lemma vorliegen, weil es sonst Überschneidungen in den Bedeutungen gibt
	foreach (array_keys($falsefriendcheck, $remove) as $key) {
		unset($falsefriendcheck[$key]);
	}
}

$falsefriendcheck = array_unique($falsefriendcheck);
$falsefriendcheckcount = count($falsefriendcheck);
if (($falsefriendcheck) AND ($see_also_sameaslemma !='1') AND ($_GET['form'] !='∅')){ // ganz rausnehmen, wenn die aktive Sprache mit zwei Lemmata vorliegt, sonst werden völlig falsche Informationen ausgegeben
	echo '<li>is a complete false friend in ';
	asort($falsefriendcheck);
	foreach ($falsefriendcheck as $zeile_2 =>$lang_name)  {
		$false=$db->query("SELECT * FROM `maps2_` WHERE `lang` ='" . $lang_name . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_object()->language;
		echo '<a title="Jump to the ' . $false . ' false friend" href="'.$_SERVER['REQUEST_URI'].'#'.$false.'">' . $false . '</a>';
		if ($falsefriendcheckcount ==1) {echo '.';}
		elseif ($falsefriendcheckcount ==2) {echo ' and ';}
		else {echo ', ';}
		$falsefriendcheckcount--;
	}
	echo '</li>';
}

$truefriendcheck=array();
foreach ($list_langs as $zeile_2 =>$lang_name)  {
	$tmp2 = ${'meanings_array_' . $lang_name};
	if ($tmp2 === $meanings_array_aktuell) {
		$truefriendcheck[] = $lang_name;
	}
}

foreach ($see_also_langs as $langtoberemoved =>$remove) {  //rausnehmen, wenn in einer Sprache zwei Lemma vorliegen, weil es sonst Überschneidungen in den Bedeutungen gibt
	foreach (array_keys($truefriendcheck, $remove) as $key) {
		unset($truefriendcheck[$key]);
	}
}
$truefriendcheck = array_unique($truefriendcheck);
$truefriendcheckcount = count($truefriendcheck);
if (($truefriendcheck) AND ($see_also_sameaslemma !='1') AND ($_GET['form'] !='∅')){ // ganz rausnehmen, wenn die aktive Sprache mit zwei Lemmata vorliegt, sonst werden völlig falsche Informationen ausgegeben
	echo '<li>is a true friend in ';
	asort($truefriendcheck);
	foreach ($truefriendcheck as $zeile_2 =>$lang_name)  {
		$true=$db->query("SELECT * FROM `maps2_` WHERE `lang` ='" . $lang_name . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_object()->language;
		echo '<a title="Jump to the ' . $true . ' true friend" href="'.$_SERVER['REQUEST_URI'].'#'.$true.'">' . $true . '</a>';
		if ($truefriendcheckcount ==1) {echo '.';}
		elseif ($truefriendcheckcount ==2) {echo ' and ';}
		else {echo ', ';}
		$truefriendcheckcount--;
	}
	echo '</li>';
}

$doesnothaveallitsmeanings=array();
foreach ($list_langs as $zeile_2 =>$lang_name)  { // Prüft, welche werte in tobechecked vorhanden sind und in anderer Sprache nicht
	$result_lang_name=array_diff($meanings_array_aktuell,${'meanings_array_' . $lang_name});
	$nothing=${'meanings_array_' . $lang_name};
	$tmp = array_filter($nothing);
	$false = ${'isfalse_' . $lang_name};
	if (($result_lang_name) AND ($false !=1) AND (!empty($tmp))) {
		$doesnothaveallitsmeanings[] = $lang_name;
	}
}
$doesnothaveallitsmeanings = array_unique($doesnothaveallitsmeanings);
$doesnothaveallitsmeaningscount = count($doesnothaveallitsmeanings);
if ($doesnothaveallitsmeanings) {
	echo '<li>does not have all its ' . $ergebnis_aktuell['language'] . ' meanings in ';
	asort($doesnothaveallitsmeanings);
	foreach ($doesnothaveallitsmeanings as $zeile_2 =>$lang_name)  {
		$doesnothave=$db->query("SELECT * FROM `maps2_` WHERE `lang` ='" . $lang_name . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_object()->language;
		echo '<a title="Jump to ‘' . $zeile_maps['form'] . '’ in ' . $doesnothave . '" href="'.$_SERVER['REQUEST_URI'].'#'.$doesnothave.'">' . $doesnothave . '</a>';
		if ($doesnothaveallitsmeaningscount ==1) {echo '.';}
		elseif ($doesnothaveallitsmeaningscount ==2) {echo ' and ';}
		else {echo ', ';}
		$doesnothaveallitsmeaningscount--;
	}
	echo '</li>';
}

$hasadditionalmeanings=array();
foreach ($list_langs as $zeile_2 =>$lang_name)  { //Prüft, welche werte in anderer Sprache vorhanden sind und in tobechecked nicht
	$result_lang_name=array_diff(${'meanings_array_' . $lang_name},$meanings_array_aktuell);
	$nothing=${'meanings_array_' . $lang_name};
	$tmp = array_filter($nothing);
	$false = ${'isfalse_' . $lang_name};
	if (($result_lang_name) AND ($false !=1) AND (!empty($tmp))) {
		$hasadditionalmeanings[] = $lang_name;
	}
}
$hasadditionalmeanings = array_unique($hasadditionalmeanings);
$hasadditionalmeaningscount = count($hasadditionalmeanings);
if ($hasadditionalmeanings) {
	echo '<li>has additional meanings in ';
	asort($hasadditionalmeanings);
	foreach ($hasadditionalmeanings as $zeile_2 =>$lang_name)  {
		$additional=$db->query("SELECT * FROM `maps2_` WHERE `lang` ='" . $lang_name . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_object()->language;
		echo '<a title="Jump to ‘' . $zeile_maps['form'] . '’ in ' . $additional . '" href="'.$_SERVER['REQUEST_URI'].'#'.$additional.'">' . $additional . '</a>';
		if ($hasadditionalmeaningscount ==1) {echo '.';}
		elseif ($hasadditionalmeaningscount ==2) {echo ' and ';}
		else {echo ', ';}
		$hasadditionalmeaningscount--;
	}
	echo '</li>';
}

$nosuchform=array();
foreach ($list_langs as $zeile_2 =>$lang_name)  {
if (${'form_' . $lang_name}=="∅"){
		$nosuchform[] = $lang_name;
	}
}
$nosuchformcount = count($nosuchform);
if ($nosuchform) {
	echo '<li>does not have any formally similar counterparts in ';
	asort($nosuchform);
	foreach ($nosuchform as $zeile_2 =>$lang_name)  {
		$nocounterpart=$db->query("SELECT * FROM `maps2_` WHERE `lang` ='" . $lang_name . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')")->fetch_object()->language;
		echo '<a title="Display the list of '.$nocounterpart.'-' . $ergebnis_aktuell['language'] . ' pairs" href="'.$pageURL.'?mode=compare&lang1='.$nocounterpart.'&lang2=' . $ergebnis_aktuell['language'] . '">' . $nocounterpart . '</a>';
		if ($nosuchformcount ==1) {echo '.';}
		elseif ($nosuchformcount ==2) {echo ' or ';}
		else {echo ', ';}
		$nosuchformcount--;
	}
	echo '</li>';
}
echo '</ul></div>';

echo '<div class="terminfo"><ul>';
foreach ($meanings_array_aktuell as $zeile_2 =>$meaningnumber)  {
$meaningnumber7 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_7;
/* schöne Funktion zum Checken der Anzahl involvierter Sprachen
$checkifonlylanguage_query = $db->query("SELECT COUNT(DISTINCT language) FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND language !='" . $ergebnis_aktuell['language'] . "'");
$checkifonlylanguage_result = $checkifonlylanguage_query->fetch_row();
echo '#: ', $checkifonlylanguage_result[0];
*/

	if (($meaningnumber ==7) AND ($meaningnumber7=='Other')){}
	else {
		if ($meaningnumber >=1) {
			echo '<li>The ' . $ergebnis_aktuell['language'] . ' meaning <strong>‘';
			if ($meaningnumber == 1) {
				$unique = 0;
				$meaning1exists = 1;
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_1 ='1' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_1;
			}
			elseif  ($meaningnumber == 2) {
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_2 ='2' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				$unique = 0;
				$meaning2exists = 1;
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_2;
			}
			elseif  ($meaningnumber == 3) {
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_3 ='3' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				$unique = 0;
				$meaning3exists = 1;
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_3;
			}
			elseif  ($meaningnumber == 4) {
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_4 ='4' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				$unique = 0;
				$meaning4exists = 1;
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_4;
			}
			elseif  ($meaningnumber == 5) {
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_5 ='5' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				$unique = 0;
				$meaning5exists = 1;
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_5;
			}
			elseif  ($meaningnumber == 6) {
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_6 ='6' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				$unique = 0;
				$meaning6exists = 1;
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_6;
			}
			elseif  ($meaningnumber == 7) {
				$uniqueness = mysqli_query($db, "SELECT * FROM maps2_ WHERE map_id ='" . $id_tobeckecked . "' AND meaning_7 ='7' AND hide != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
				$unique = 0;
				$meaning7exists = 1;
				foreach ($uniqueness as $zeile)  {
					$unique++;
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_7;
			}
			if ($unique == 1) {
				echo '’</strong> is unique.</li>';
			}
			else {

				$query_comma = "SELECT * FROM maps2_ WHERE map_id =" . $id_tobeckecked . " AND meaning_" . $meaningnumber . " = '" . $meaningnumber . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')";
				$commacount_result = mysqli_query($db, $query_comma);
				$commacount=0;
				while ($commacount_zeile = $commacount_result->fetch_assoc()) {
					if ($ergebnis_aktuell['lang'] != $commacount_zeile['lang']) {
						$commacount++;
					}
				}
				echo '’</strong> is shared by ';
				$query3 = "SELECT * FROM maps2_ WHERE map_id =" . $id_tobeckecked . " AND meaning_" . $meaningnumber . " = '" . $meaningnumber . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')";
				$listlangmeanings = mysqli_query($db, $query3);
				while ($zeile5 = $listlangmeanings->fetch_assoc()) {
					if ($ergebnis_aktuell['lang'] != $zeile5['lang']) {
						echo $zeile5['language'] . ' ';
						echo '<em><a title="Display the article for '.$zeile5['language'].' ‘' . $zeile5['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language='.$zeile5['language'].'&form='.$zeile5['form'].'">' . $zeile5['form'] . '</a></em>';
						if ($commacount ==1) {echo '.';}
						elseif ($commacount ==2) {echo ' and ';}
						else {echo ', ';}
					$commacount--;
					}
				}
			echo '</li>';
			}
		}
	}
}

if (!$meaning1exists) {
	$notpresentmeaning1 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_1;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_1='1' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount=$meaningnotpresent->num_rows;
	if (($notpresentmeaning1) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning1;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_1;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}

if (!$meaning2exists) {
	$notpresentmeaning2 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_2;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_2='2' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount =$meaningnotpresent->num_rows;
	if (($notpresentmeaning2) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning2;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_2;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}

if (!$meaning3exists) {
	$notpresentmeaning3 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_3;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_3='3' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount =$meaningnotpresent->num_rows;
	if (($notpresentmeaning3) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning3;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_3;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}

if (!$meaning4exists) {
	$notpresentmeaning4 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_4;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_4='4' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount =$meaningnotpresent->num_rows;
	if (($notpresentmeaning4) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning4;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_4;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}

if (!$meaning5exists) {
	$notpresentmeaning5 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_5;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_5='5' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount =$meaningnotpresent->num_rows;
	if (($notpresentmeaning5) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning5;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_5;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}

if (!$meaning6exists) {
	$notpresentmeaning6 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_6;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_6='6' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount =$meaningnotpresent->num_rows;
	if (($notpresentmeaning6) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning6;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_6;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}

if (!$meaning7exists) {
$meaningnumber8 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_7;
	if ($meaningnumber8 !='Other') {
	$notpresentmeaning7 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='English'")->fetch_object()->meaning_7;
	$meaningnotpresent = $db->query("SELECT * FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND meaning_7='7' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')");
	$meaningnotpresentcount =$meaningnotpresent->num_rows;
	if (($notpresentmeaning7) AND ($meaningnotpresentcount !='0')) {
		echo '<li>The meaning <strong>‘';
		echo $notpresentmeaning7;
		echo '’</strong> (not present in ' . $ergebnis_aktuell['language'] . ' <em>‘' . $zeile_maps['form'] . '’</em>';
		$translation = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND `language` ='".$ergebnis_aktuell['language']."'")->fetch_object()->meaning_7;
		if ($translation) {
			echo ', translated as <em>‘'.$translation.'’</em>';
		}
		echo ') is attested in ';
		foreach ($meaningnotpresent as $zeile_2) {
			echo $zeile_2['language'];
			echo ' <em><a title="Display the article for '.$zeile_2['language'].' ‘' . $zeile_2['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$id_tobeckecked.'&language=' . $zeile_2['language'] . '&form=' . $zeile_2['form'] . '">' . $zeile_2['form'] . '</a></em>';
			if ($meaningnotpresentcount ==1) {echo '.';}
			elseif ($meaningnotpresentcount ==2) {echo ' and ';}
			else {echo ', ';}
			$meaningnotpresentcount--;
		}
	}
	echo '</li>';
}
}
echo '</ul></div><div class="terminfo">';

$list_langs2=$list_langs;
array_push($list_langs2,$ergebnis_aktuell['lang']);
$noinformation=array_diff($navtable[1],$list_langs2);

$order = $languagelist_alpha[1];
usort($noinformation, function ($a, $b) use ($order) {
	$pos_a = array_search($a, $order);
	$pos_b = array_search($b, $order);
	return $pos_a - $pos_b;
});

if (!empty($noinformation)) {
	echo '<p style="font-size:smaller;text-align:right;">NB: No information yet for ';
	$noinformationcount = count($noinformation);
	foreach ($noinformation as $zeile_3 =>$lang_name)  {
		$noinfo=$db->query("SELECT * FROM `maps2_` WHERE `lang` ='" . $lang_name . "'")->fetch_object()->language;
		echo '<a href="'.$pageURL.'?mode=list&language='.$noinfo.'">' . $noinfo . '</a>';
		if ($noinformationcount ==1) {echo '.';}
		elseif ($noinformationcount ==2) {echo ' and ';}
		else {echo ', ';}
		$noinformationcount--;
	}
	echo '</p>';
}
echo '</div>';

?>



