<?php

if ($_GET['mode'] == 'list') {
	echo '<div id="bibliography" class="anchor"></div>';
	echo '<div class="bibliography sidebar-right card card-grey">';
	echo '<h3 class="card-header" id="bibliography">Bibliography for '.$_GET['language'].'</h3>';
	echo '<div class="card-body"><ul>';
	$get_shortlang = array_search($_GET['language'],$navtable[0]);
	$query_shortlang = $navtable[1][$get_shortlang];
	$query_bib = "SELECT * FROM `bib2_` WHERE `$query_shortlang`='x' ORDER BY `bib2_`.`abc` ASC";
	$ergebnis_bib = mysqli_query($db, $query_bib);
	foreach ($ergebnis_bib as $bib_item) {
		echo '<li>'.$bib_item['bib_record'].'</li>';
	}
	echo '</ul>';
	echo '<strong><a href="'.$pageURL.'?mode=bibliography">Display full bibliography</a></strong>';
	echo '</div></div>';
}

if ($_GET['mode'] == 'compare') {
	echo '<div id="bibliography" class="anchor"></div>';
	echo '<div class="bibliography sidebar-right card card-grey">';
	echo '<h3 class="card-header">Bibliography for '.$_GET['lang1'].' and '.$_GET['lang2'].'</h3>';
	echo '<div class="card-body"><ul>';
	$get_shortlang1 = array_search($_GET['lang1'],$navtable[0]);
	$query_shortlang1 = $navtable[1][$get_shortlang1];
	$get_shortlang2 = array_search($_GET['lang2'],$navtable[0]);
	$query_shortlang2 = $navtable[1][$get_shortlang2];
	$query_bib = "SELECT * FROM `bib2_` WHERE `$query_shortlang1`='x' AND `$query_shortlang2`='x' ORDER BY `bib2_`.`abc` ASC";
	$ergebnis_bib = mysqli_query($db, $query_bib);
	foreach ($ergebnis_bib as $bib_item) {
		echo '<li>'.$bib_item['bib_record'].'</li>';
	}
	echo '</ul>';
	echo '<strong><a href="'.$pageURL.'?mode=bibliography">Display full bibliography</a></strong>';
	echo '</div></div>';
}

if ($_GET['mode'] == 'bibliography') {
	echo '<div class="bibliography">';
	echo '<h2 id="bibliography">Bibliography</h2>';
	echo '<ul>';
	$ergebnis_bib = mysqli_query($db, "SELECT * FROM `bib2_` ORDER BY `bib2_`.`abc` ASC");
	foreach ($ergebnis_bib as $bib_item) {
		echo '<li>'.$bib_item['bib_record'].'</li>';
	}
	echo '</ul>';
	echo '</div>';
}



?>
