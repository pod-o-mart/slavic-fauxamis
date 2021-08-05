<?php
if ($_GET['lookfor'] =='pronounciation') {
	$query_maps = "SELECT * FROM maps2_ WHERE language ='" . $_GET['language'] . "' AND pronounciation='" . $_GET['form'] . "' AND map_id='" . $_GET['term_id'] . "'";
}
else {
	$query_maps = "SELECT * FROM maps2_ WHERE language ='" . $_GET['language'] . "' AND form='" . $_GET['form'] . "' AND map_id='" . $_GET['term_id'] . "'";
}

$ergebnis_maps = mysqli_query($db, $query_maps);
//echo "<pre>";print_r($listother2);echo "</pre>";
while ($zeile_maps = $ergebnis_maps->fetch_assoc()) {
	$othermeaning7showterm = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_7;
	$actual_lang = $zeile_maps['language'];
	$semmap = $db->query("SELECT `map_name` FROM `maps_meanings2_` WHERE `map_id` = '" . $_GET['term_id'] . "'")->fetch_object()->map_name;
	if ($zeile_maps['form'] =='∅') {
		echo '<h3>'.$zeile_maps['language'].' - <em>no corresponing term</em>';
		if ($semmap) {
			echo ' for ‘'.$semmap.'’';
		}
		echo '</h3>';
	}
	else {
		echo '<h3>' . $zeile_maps['language'] . ' <strong>‘' . str_replace("́","",$zeile_maps['form']) . '’';
		if ($zeile_maps['aspect']) {
			echo ' <span title="Aspect" class="aspect">'.$zeile_maps['aspect'].'</span>';
		}
		echo '</strong></h3>';
	}
	echo '<div style="float:right;font-weight:bold;"><a class="ff-left-title" title="Display all '.$zeile_maps['language'].' terms in the database" href="'.$pageURL.'?mode=list&language='.$zeile_maps['language'].'">All '.$zeile_maps['language'].' terms</a><br><a class="ff-left-title" title="Display the '.$zeile_maps['language'].' bibliography" href="'.$pageURL.'?mode=list&language='.$zeile_maps['language'].'#bibliography">'.$zeile_maps['language'].' bibliography</a></div>';
	if ($zeile_maps['pronounciation']) {
		echo '<p style="color:darkred;font-weight:bold;">['.$zeile_maps['pronounciation'].']</p>';
	}
	if ($zeile_maps['grammar']) {
		echo '<p><span class="note synonym"><em>Grammar:</em></span> <strong>'.$zeile_maps['grammar'].'</strong></p>';
	}
	if ($zeile_maps['semantics']) {
		echo '<p><span class="note synonym"><em>Semantics:</em></span> <strong>'.$zeile_maps['semantics'].'</strong></p>';
	}
	if ($zeile_maps['synonymity']) {
		echo '<p><span class="note synonym"><em>Synonym:</em></span> <strong>'.$zeile_maps['synonymity'].'</strong></p>';
	}
	if ($zeile_maps['form'] !='∅') {
	echo '<p> The database knows following <strong>meanings</strong> of the ' . $zeile_maps['language'] . ' word <em><strong>‘' . $zeile_maps['form'] . '’</strong></em>:</p>';
	echo '<ul class="list-meanings">';
	if ($zeile_maps['meaning_1'] !="") {
		echo '<li style="font-weight:bold;">' . $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_1;
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_1;
		$synonym = str_replace("́","",$synonym);
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_1'])) {
			echo ' (';
		}
		if ($zeile_maps['comment_1']) {
			echo $zeile_maps['comment_1'];
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_1'])) {
			echo ', ';
		}
		if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
			echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_1'])) {
			echo ')';
		}
		echo '</li>';
	}
	if ($zeile_maps['meaning_2'] !="") {
		echo '<li style="font-weight:bold;">' . $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_2;
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_2;
		$synonym = str_replace("́","",$synonym);
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_2'])) {
			echo ' (';
		}
		if ($zeile_maps['comment_2']) {
			echo $zeile_maps['comment_2'];
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_2'])) {
			echo ', ';
		}
		if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
			echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_2'])) {
			echo ')';
		}
		echo '</li>';
	}
	if ($zeile_maps['meaning_3'] !="") {
		echo '<li style="font-weight:bold;">' . $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_3;
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_3;
		$synonym = str_replace("́","",$synonym);
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_3'])) {
			echo ' (';
		}
		if ($zeile_maps['comment_3']) {
			echo $zeile_maps['comment_3'];
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_3'])) {
			echo ', ';
		}
		if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
			echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_3'])) {
			echo ')';
		}
		echo '</li>';
	}
	if ($zeile_maps['meaning_4'] !="") {
		echo '<li style="font-weight:bold;">' . $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_4;
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_4;
		$synonym = str_replace("́","",$synonym);
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_4'])) {
			echo ' (';
		}
		if ($zeile_maps['comment_4']) {
			echo $zeile_maps['comment_4'];
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_4'])) {
			echo ', ';
		}
		if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
			echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_4'])) {
			echo ')';
		}
		echo '</li>';
	}
	if ($zeile_maps['meaning_5'] !="") {
		echo '<li style="font-weight:bold;">' . $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_5;
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_5;
		$synonym = str_replace("́","",$synonym);
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_5'])) {
			echo ' (';
		}
		if ($zeile_maps['comment_5']) {
			echo $zeile_maps['comment_1'];
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_5'])) {
			echo ', ';
		}
		if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
			echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_5'])) {
			echo ')';
		}
		echo '</li>';
	}
	if ($zeile_maps['meaning_6'] !="") {
		echo '<li style="font-weight:bold;">' . $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='English'")->fetch_object()->meaning_6;
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_6;
		$synonym = str_replace("́","",$synonym);
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_6'])) {
			echo ' (';
		}
		if ($zeile_maps['comment_6']) {
			echo $zeile_maps['comment_6'];
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_6'])) {
			echo ', ';
		}
		if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
			echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
		}
		if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_6'])) {
			echo ')';
		}
		echo '</li>';
	}
	if ($zeile_maps['meaning_7'] !="") {
		$synonym = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND language='".$zeile_maps['language']."'")->fetch_object()->meaning_7;
		if ($othermeaning7showterm == 'Other') {
			echo '<li style="font-weight:bold;">' . $zeile_maps['comment_7'];
		}
		else {
			echo '<li style="font-weight:bold;">' . $othermeaning7showterm;
			if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
				echo ' (syn. <em>‘'.$synonym.'’</em>)';
			}
			if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_7'])) {
				echo ' (';
			}
			if ($zeile_maps['comment_7']) {
				echo $zeile_maps['comment_7'];
			}
			if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) AND ($zeile_maps['comment_7'])) {
				echo ', ';
			}
			if (($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))){
				echo '<span class="note synonym">syn.:</span> <em>‘'.$synonym.'’</em>';
			}
			if ((($synonym) AND ($synonym != str_replace("́","",$zeile_maps['form']))) OR ($zeile_maps['comment_7'])) {
				echo ')';
			}
		}
		echo '</li>';
	}
	echo '</ul>';
	}
	$countothers_query = mysqli_query($db, "SELECT * FROM maps2_ where map_id=" . $zeile_maps['map_id'] . " and language='".$_GET['language']."'");
	$see_also_currentlang=array();
	foreach ($countothers_query as $others) {
		if ($others['form'] != $_GET['form']) {
			$see_also_currentlang[]=array($zeile_maps['map_id'],$others['form'],$others['aspect']);
		}
	}
	if ($zeile_maps['see_also']) {
		$see_also_map_id = $db->query("SELECT * FROM `maps2_` WHERE `form` = '" . $zeile_maps['see_also'] . "' AND `language`='".$zeile_maps['language']."'")->fetch_object()->map_id;
		$see_also_map_aspect = $db->query("SELECT * FROM `maps2_` WHERE `form` = '" . $zeile_maps['see_also'] . "' AND `language`='".$zeile_maps['language']."'")->fetch_object()->aspect;
		$see_also_currentlang[]=array($see_also_map_id,$zeile_maps['see_also'],$see_also_map_aspect);
	}
	$seealso_punctuation = count($see_also_currentlang);
	if ($see_also_currentlang) {echo '<em><span class="note synonym">See also:</em></span> ';}
	$g=0;
	foreach ($see_also_currentlang as $as) {
		echo '<strong><a title="Display the article for '.$zeile_maps['language'].' ‘'.$see_also_currentlang[$g][1].'’" href="'.$pageURL.'?mode=showterm&term_id='.$see_also_currentlang[$g][0].'&language='.$zeile_maps['language'].'&form='.$see_also_currentlang[$g][1].'">'.$see_also_currentlang[$g][1].'</a></strong>';

		if ($see_also_currentlang[$g][2]) {
			echo ' <span class="aspect">'.$see_also_currentlang[$g][2].'</span>';
		}
		$g++;$seealso_punctuation--;
		if ($seealso_punctuation) {echo ', ';}
	}
	unset($seealso_punctuation);unset($g);
	echo '<p><strong><a class="ff-right-title" title="Jump to the semasiological map" href="'.$_SERVER['REQUEST_URI'].'#map">Semasiological map for <em>‘';

	if ($semmap != '') {echo str_replace("́","",$semmap);} else {echo str_replace("́","",$zeile_maps['form']);}
	echo '’</em></strong></a></p>';
	//if ($zeile_maps['aspect']) {
		//$listother_query= "SELECT * FROM `maps2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND aspect='" . $zeile_maps['aspect'] . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')";
	//}
	//else {
		$listother_query= "SELECT * FROM `maps2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "'  AND `hide` != 'x' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')";
	//}
	$listother = mysqli_query($db, $listother_query);

	$listother_oben_query= "SELECT DISTINCT `language`,`lang` FROM maps2_ WHERE `map_id` ='" . $zeile_maps['map_id'] . "' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')";
	$listother_oben = mysqli_query($db, $listother_oben_query);
	$listother_oben_punctuation = $listother_oben;
	echo '<p>The database has information related to this term for ';

	foreach ($listother_oben_punctuation as $oben_punctuation_count)  {
		$countifmorethanone_query = mysqli_query($db, "SELECT * FROM maps2_ where map_id=" . $zeile_maps['map_id'] . " and language='".$oben_punctuation_count['language']."'");
		$countifmorethanone = $countifmorethanone_query->num_rows;
		if (($oben_punctuation_count['language'] == $zeile_maps['language']) AND ($countifmorethanone > 1) ){
			$f++;
		}
		elseif (($oben_punctuation_count['language'] != $zeile_maps['language'])  )
		{
			$f++;
		}
	}
	foreach ($listother_oben as $table_languages)  {
		$countifmorethanone_query = mysqli_query($db, "SELECT * FROM maps2_ where map_id=" . $zeile_maps['map_id'] . " and language='".$table_languages['language']."'");
		$countifmorethanone = $countifmorethanone_query->num_rows;
		echo $countifmorethanone->num_rows;
		if (($table_languages['language'] == $zeile_maps['language']) AND ($countifmorethanone > 1) ){
			echo ' <a title="Display all '.$table_languages['language'].' words that are related to ‘' . $zeile_maps['form'] . '’" href="'.$pageURL.'?mode=ambiguous&term_id='.$_GET['term_id'].'&language=' . $table_languages['language'] . '&form=' . $zeile_maps['form'] . '">' . $table_languages['language'] . '</a>';
			$punctuation=1;
			//echo '-if-';
			$f--;
		}
		elseif (($table_languages['language'] != $zeile_maps['language'])  )
		{
			echo ' <a title="Jump to ‘' . $zeile_maps['form'] . '’ in '.$table_languages['language'].'" href="'.$_SERVER['REQUEST_URI'].'#' . $table_languages['language'] . '">' . $table_languages['language'] . '</a>';
			$punctuation=1;
			//echo '-elseif-';
			$f--;
		}
		else {
			$punctuation=0;
			//echo '-else-';
		}
		//$i--;
		if ($punctuation==1){
			if ($f==1) {
				echo ' and';
			}
			elseif ($f ==0) {
				echo '';
			}else{
				echo ',';
			}
		}
	}
	echo '.</p>';
	if ($_GET['form'] !='∅') {
		echo '<h4>' . $zeile_maps['language'] . ' <strong>‘' . $zeile_maps['form'] . '’:</strong></h4>';
	}
	include('inenglish.php');
	echo '<div class="list">';
	foreach ($listother as $table_languages)  {
		if (($table_languages['language'] != $zeile_maps['language'])  AND ($table_languages['form'] != '')) {
			$meaningsnumber = 0;
			$translation_1 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_1;
			$translation_2 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_2;
			$translation_3 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_3;
			$translation_4 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_4;
			$translation_5 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_5;
			$translation_6 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_6;
			$translation_7 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $table_languages['language'] . "'")->fetch_object()->meaning_7;
			if ($zeile_maps['meaning_1']){$meaningsnumber++;}
			if ($zeile_maps['meaning_2']){$meaningsnumber++;}
			if ($zeile_maps['meaning_3']){$meaningsnumber++;}
			if ($zeile_maps['meaning_4']){$meaningsnumber++;}
			if ($zeile_maps['meaning_5']){$meaningsnumber++;}
			if ($zeile_maps['meaning_6']){$meaningsnumber++;}
			if ($zeile_maps['meaning_7']){$meaningsnumber++;}
			if ($countvariants < 2) {
				echo '<div id="' . $table_languages['language'] . '" class="anchor"></div><table class="termlist">
				<tr class="row1">
				<td class="column1"><span style="text-decoration:underline;">' . $zeile_maps['language'] . '</span><br><strong>' . str_replace("́","",$zeile_maps['form']) . '</strong>';
				if ($zeile_maps['aspect']) {echo ' <span title="Aspect" class="aspect">'.$zeile_maps['aspect'].'</span>';}
				if ($zeile_maps['pronounciation']) {echo ' <span title="Pronounciation" style="color:darkred;">['.$zeile_maps['pronounciation'].']</span>';}
				if ($zeile_maps['grammar']) {echo '<br><span class="note synonym">Grammar:</span> <span class="note">'.$zeile_maps['grammar'].'</span>';}

				if (($zeile_maps['semantics']) OR ($zeile_maps['synonymity'])) {
					echo ' (';
				}
				if ($zeile_maps['semantics']) {echo '<span title="Semantics" class="note">'.$zeile_maps['semantics'].'</span>';}
				if (($zeile_maps['semantics']) AND ($zeile_maps['synonymity'])) {
					echo ', ';
				}
				if ($zeile_maps['synonymity']) {echo '<span class="note synonym">Syn.:</span> <span class="note">'.$zeile_maps['synonymity'].'</span>';}
				if (($zeile_maps['semantics']) OR ($zeile_maps['synonymity'])) {
					echo ')';
				}
				$seealso_punctuation = count($see_also_currentlang);
				if ($see_also_currentlang) {echo '<br><span class="note synonym">See also:</span> ';}
				$g=0;

				foreach ($see_also_currentlang as $as2) {
					echo '<a title="Display the article for '.$zeile_maps['language'].' ‘'.$see_also_currentlang[$g][1].'’"  href="'.$pageURL.'?mode=showterm&term_id='.$see_also_currentlang[$g][0].'&language='.$zeile_maps['language'].'&form='.$see_also_currentlang[$g][1].'">'.$see_also_currentlang[$g][1].'</a>';
					if ($see_also_currentlang[$g][2]) {
						echo ' <span class="aspect">'.$see_also_currentlang[$g][2].'</span>';
					}
					$g++;$seealso_punctuation--;
					if ($seealso_punctuation) {echo ', ';}
				}
				unset($seealso_punctuation);unset($g);
				echo '</td>
				<td class="column2">';
				if ($_GET['form'] !='∅') {
					echo '<span style="text-decoration:underline;">Meaning';
					if ((($translation_1 !="") AND ($zeile_maps['meaning_1'] !="")) OR (($translation_2 !="") AND ($zeile_maps['meaning_2'] !="")) OR (($translation_3 !="") AND ($zeile_maps['meaning_3'] !="")) OR (($translation_4 !="") AND ($zeile_maps['meaning_4'] !="")) OR (($translation_5 !="") AND ($zeile_maps['meaning_5'] !="")) OR (($translation_6 !="") AND ($zeile_maps['meaning_6'] !="")) OR (($translation_7 !="") AND ($zeile_maps['meaning_7'] !=""))) {
						echo ' in ' . $table_languages['language'];
					}
					echo '</span>:';
				}
				if ($meaningsnumber > 1) {
					echo '<ol>';
				}
				else {
					echo '<ul>';
				}
				if ($zeile_maps['meaning_1'] !="") {
					echo '<Li>';
					if ($translation_1 !="") {
						echo '<strong>' . $translation_1 . ' /</strong> ';
					}
					echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_1;
					if ($zeile_maps['comment_1']) {
						echo ' ('.$zeile_maps['comment_1'].')';
					}
					 echo '</li>';
				}
				if ($zeile_maps['meaning_2'] !="") {
					echo '<Li>';
					if ($translation_2 !="") {
						echo '<strong>' . $translation_2 . ' /</strong> ';
					}
					echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_2;
					if ($zeile_maps['comment_2']) {
						echo ' ('.$zeile_maps['comment_2'].')';
					}
					 echo '</li>';
				}
				if ($zeile_maps['meaning_3'] !="") {
					echo '<Li>';
					if ($translation_3 !="") {
						echo '<strong>' . $translation_3 . ' /</strong> ';
					}
					echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_3;
					if ($zeile_maps['comment_3']) {
						echo ' ('.$zeile_maps['comment_3'].')';
					}
					 echo '</li>';
				}
				if ($zeile_maps['meaning_4'] !="") {
					echo '<Li>';
					if ($translation_4 !="") {
						echo '<strong>' . $translation_4 . ' /</strong> ';
					}
					echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_4;
					if ($zeile_maps['comment_4']) {
						echo ' ('.$zeile_maps['comment_4'].')';
					}
					 echo '</li>';
				}
				if ($zeile_maps['meaning_5'] !="") {
					echo '<Li>';
					if ($translation_5 !="") {
						echo '<strong>' . $translation_5 . ' /</strong> ';
					}
					echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_5;
					if ($zeile_maps['comment_5']) {
						echo ' ('.$zeile_maps['comment_5'].')';
					}
					 echo '</li>';
				}
				if ($zeile_maps['meaning_6'] !="") {
					echo '<Li>';
					if ($translation_6 !="") {
						echo '<strong>' . $translation_6 . ' /</strong> ';
					}
					echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $zeile_maps['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_6;
					if ($zeile_maps['comment_6']) {
						echo ' ('.$zeile_maps['comment_6'].')';
					}
					 echo '</li>';
				}
				if ($zeile_maps['meaning_7'] !="") {
					echo '<Li>';
					if ($translation_7 !="") {
						echo '<strong>' . $translation_7 . '</strong> ';
					}
					if ($othermeaning7showterm == 'Other') {
						echo $zeile_maps['comment_7'];
					}
					else {
						echo $othermeaning7showterm;
						if ($zeile_maps['comment_7']) {
							echo ' ('.$zeile_maps['comment_7'].')';
						}
						echo '</li>';
					}
				}
				if ($meaningsnumber > 1) {
					echo '</ol>';
				}
				else {
					echo '</ul>';
				}
				unset ($meaningsnumber);
				echo '</td>';
				echo '<td class="column3" rowspan="0">';

				echo '<a title="Display semasiological map for ';
				if ($semmap != '') {echo str_replace("́","",$semmap);} else {echo '‘'.str_replace("́","",$zeile_maps['form']).'’';}

				echo '" href="'.$_SERVER['REQUEST_URI'].'#map">Map</a><br>';
				echo '<a title="Display the '.$zeile_maps['language'].'-'.$table_languages['language'].' bibliography" href="'.$pageURL.'?mode=compare&lang1='.$zeile_maps['language'].'&lang2='.$table_languages['language'].'#bibliography">Bibliography</a><br>';
				echo '<a title="Display a list of all '.$zeile_maps['language'].'-'.$table_languages['language'].' terms" href="'.$pageURL.'?mode=compare&lang1='.$zeile_maps['language'].'&lang2='.$table_languages['language'].'">List</a><br>';
				$lang1_url=$zeile_maps['language'];
				$lang2_url=$table_languages['language'];
				include ('wikibook.php');
				if (($langpairspecific =='Russian-Lower_Sorbian') OR ($langpairspecific =='Belarusian-Lower_Sorbian') OR ($langpairspecific=='Ukrainian-Lower_Sorbian') OR ($langpairspecific =='Kashubian-Lower_Sorbian') OR ($langpairspecific=='Kashubian-Upper Sorbian') OR ($langpairspecific =='Lower_Sorbian-Kashubian') OR ($langpairspecific=='Lower_Sorbian-Croatian') OR ($langpairspecific =='Lower_Sorbian-Bosnian') OR ($langpairspecific=='Lower_Sorbian-Bulgarian')) {
					echo '<a style=color:darkred;" title="The Wikibook project page for '.$zeile_maps['language'].' and '.$table_languages['language'].' does not exist yet. Please help creating it" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.$langpairspecific.'">Wikibook</a>';
				}
				else {
					echo '<a title="View this word pair in the source project (if listed)" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.$langpairspecific.'#ff'.$table_languages['map_id'].'">Wikibook</a>';
				}
				echo '</td>';
				echo '</tr>';
			}
			echo '<tr class="row2">';
			$checknumberoftermsinlang_query = $db->query("SELECT COUNT(language) FROM `maps2_` WHERE `map_id` ='" . $id_tobeckecked . "' AND language ='" . $table_languages['language'] . "' AND `hide` != 'x'");
			$checkifonlylanguage_result = $checknumberoftermsinlang_query->fetch_row();
			$checknumberoftermsinlang = $checkifonlylanguage_result[0];
			if (!$countvariants) {
				$countvariants =1;
			}
			echo '<td class="column1">';
			if ($countvariants ==1) {
				echo '<span style="text-decoration:underline;">'.$table_languages['language'].'</span><br>';
			}
			if (($checknumberoftermsinlang >= 2) AND ($checknumberoftermsinlang >= $countvariants)) {
				//echo $checknumberoftermsinlang;
				if ($countvariants==1) {$latinnumber='I.&nbsp;&nbsp;';}
				elseif ($countvariants==2) {$latinnumber='II.&nbsp;';}
				elseif ($countvariants==3) {$latinnumber='III.';}
				elseif ($countvariants==4) {$latinnumber='IV.&nbsp;';}
				elseif ($countvariants==5) {$latinnumber='V.&nbsp;&nbsp;';}
				elseif ($countvariants==6) {$latinnumber='VI.&nbsp;';}
				elseif ($countvariants==7) {$latinnumber='VII.';}
				echo ' <span style="color:darkred;font-weight:bold;font-family:monospace;">'.$latinnumber.'&nbsp;</span>';
				$countvariants++;
			}
			echo '<strong>';
			if ($table_languages['form'] =="∅") {
				echo '∅';
			}
			else {
				echo '<a title="Display the article for ' . $table_languages['language'] . ' ‘' . $table_languages['form'] . '’" href="'.$pageURL.'?mode=showterm&term_id='.$table_languages['map_id'].'&language='.$table_languages['language'].'&form='.$table_languages['form'].'">' . $table_languages['form'] . '</a>';
			}
			echo '</strong>';
			if ($table_languages['aspect']) {echo ' <span class="aspect">'.$table_languages['aspect'].'</span>';}
			if ($table_languages['pronounciation']) {echo '<br><span style="color:darkred;">['.$table_languages['pronounciation'].']</span>';}

			if ($table_languages['grammar']) {echo '<br><span class="note synonym">Grammar:</span> <span class="note">'.$table_languages['grammar'].'</span>';}

			if (($table_languages['semantics']) OR ($table_languages['synonymity'])) {
				echo ' (';
			}
			if ($table_languages['semantics']) {echo '<span class="note">'.$table_languages['semantics'].'</span>';}
			if (($table_languages['semantics']) AND ($table_languages['synonymity'])) {
				echo ', ';
			}
			if ($table_languages['synonymity']) {echo '<span class="note synonym">Syn.:</span> <span class="note">'.$table_languages['synonymity'].'</span>';}
			if (($table_languages['semantics']) OR ($table_languages['synonymity'])) {
				echo ')';
			}
			$get_meaning_7 =$db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_7;
			if ($get_meaning_7 !='Other') {
				echo $table_languages['comment_7'];
			}
			if ($checknumberoftermsinlang < $countvariants) {
				unset($countvariants);
			}
			if ($table_languages['form'] == '∅') {echo ' - no corresponding term.';}
			if ((!$countvariants) OR ($countvariants <= 1)) {
				if ($table_languages['see_also']) {
					$see_also_map_id = $db->query("SELECT * FROM `maps2_` WHERE `form` = '" . $table_languages['see_also'] . "' AND `language`='".$table_languages['language']."'")->fetch_object()->map_id;
					$see_also_map_aspect = $db->query("SELECT * FROM `maps2_` WHERE `form` = '" . $table_languages['see_also'] . "' AND `language`='".$table_languages['language']."'")->fetch_object()->aspect;
					echo '<br><br><span class="note synonym">See also:</span> ';
					echo '<a title="Display the article for '.$table_languages['language'].' ‘'.$table_languages['see_also'].'’" href="'.$pageURL.'?mode=showterm&term_id='.$see_also_map_id.'&language='.$table_languages['language'].'&form='.$table_languages['see_also'].'">'.$table_languages['see_also'].'</a>';
					if ($see_also_map_aspect) {
						echo ' <span title="Aspect" class="aspect">'.$see_also_map_aspect.'</span>';
					}
				}
			}
			echo '</td>';
			echo '<td class="column2">';
			if ($table_languages['form'] != '∅') {
			$translation_1 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_1;
			$translation_2 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_2;
			$translation_3 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_3;
			$translation_4 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_4;
			$translation_5 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_5;
			$translation_6 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_6;
			$translation_7 = $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language` ='" . $zeile_maps['language'] . "'")->fetch_object()->meaning_7;
			echo '<span style="text-decoration:underline;">Meaning';
			if ((($translation_1 !="") AND ($table_languages['meaning_1'] !="")) OR (($translation_2 !="") AND ($table_languages['meaning_2'] !="")) OR (($translation_3 !="") AND ($table_languages['meaning_3'] !="")) OR (($translation_4 !="") AND ($table_languages['meaning_4'] !="")) OR (($translation_5 !="") AND ($table_languages['meaning_5'] !="")) OR (($translation_6 !="") AND ($table_languages['meaning_6'] !="")) OR (($translation_7 !="") AND ($table_languages['meaning_7'] !=""))) {
				echo ' in ' . $zeile_maps['language'];
			}
			echo '</span>';
			$meaningsnumber2=0;
			if ($table_languages['meaning_1']) {$meaningsnumber2++;}
			if ($table_languages['meaning_2']) {$meaningsnumber2++;}
			if ($table_languages['meaning_3']) {$meaningsnumber2++;}
			if ($table_languages['meaning_4']) {$meaningsnumber2++;}
			if ($table_languages['meaning_5']) {$meaningsnumber2++;}
			if ($table_languages['meaning_6']) {$meaningsnumber2++;}
			if ($table_languages['meaning_7']) {$meaningsnumber2++;}
			if ($meaningsnumber2 > 1) {
				echo ':<ol>';
			}
			else {
				echo ':<ul>';
			}
			if ($table_languages['meaning_1'] !="") {echo '<Li>';
				if ($translation_1 !="") {
					echo '<strong>' . $translation_1 . ' /</strong> ';
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_1;
				if ($table_languages['comment_1']) {
					echo ' ('.$table_languages['comment_1'].')';
				}
				echo '</li>';
			}
			if ($table_languages['meaning_2'] !="") {echo '<Li>';
				if ($translation_2 !="") {
					echo '<strong>' . $translation_2 . ' /</strong> ';
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_2;
				if ($table_languages['comment_2']) {
					echo ' ('.$table_languages['comment_2'].')';
				}
				echo '</li>';
			}
			if ($table_languages['meaning_3'] !="") {echo '<Li>';
				if ($translation_3 !="") {
					echo '<strong>' . $translation_3 . ' /</strong> ';
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_3;
				if ($table_languages['comment_3']) {
					echo ' ('.$table_languages['comment_3'].')';
				}
				echo '</li>';
			}
			if ($table_languages['meaning_4'] !="") {echo '<Li>';
				if ($translation_4 !="") {
					echo '<strong>' . $translation_4 . ' /</strong> ';
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_4;
				if ($table_languages['comment_4']) {
					echo ' ('.$table_languages['comment_4'].')';
				}
				echo '</li>';
			}
			if ($table_languages['meaning_5'] !="") {echo '<Li>';
				if ($translation_5 !="") {
					echo '<strong>' . $translation_5 . ' /</strong> ';
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_5;
				if ($table_languages['comment_5']) {
					echo ' ('.$table_languages['comment_5'].')';
				}
				echo '</li>';
			}
			if ($table_languages['meaning_6'] !="") {echo '<Li>';
				if ($translation_6 !="") {
					echo '<strong>' . $translation_6 . ' /</strong> ';
				}
				echo $db->query("SELECT * FROM `maps_meanings2_` WHERE `map_id` ='" . $table_languages['map_id'] . "' AND `language`='English'")->fetch_object()->meaning_6;
				if ($table_languages['comment_6']) {
					echo ' ('.$table_languages['comment_6'].')';
				}
				echo '</li>';
			}
			if ($table_languages['meaning_7'] !="") {
				if ($othermeaning7showterm == 'Other') {
					echo '<Li>' . $table_languages['comment_7'].'</li>';
				}
				else {
					echo '<Li>' . $get_meaning_7 . '</li>';
				}
			}
			if ($meaningsnumber2 > 1) {
				echo '</ol>';
			}
			else {
				echo '</ul>';
			}
			unset ($meaningsnumber2);
			}
			echo '</td>';
			echo '</tr>';
			if ($countvariants < 2) {
				echo '</table>';
			}
		}
	}
}
echo '</div>';
require ('map.php');
?>
