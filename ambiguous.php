<?php
$query_maps = "SELECT * FROM maps2_ WHERE map_id='" . $_GET['term_id'] . "' AND language='" . $_GET['language'] . "' ORDER BY `form` ASC";
$ergebnis_maps = mysqli_query($db, $query_maps);

echo '<h2>Ambiguous terms in ' . $_GET['language'] . ' related to <strong>‘' . $_GET['form'] . '’</strong></h2>';
echo '<ul>';
while ($zeile_maps = $ergebnis_maps->fetch_assoc()) {
	if ($zeile_maps['pronounciation']) {
		$showform=$zeile_maps['pronounciation'];
		$lookfor='&lookfor=pronounciation';
	}
	else {
		$showform=$zeile_maps['form'];
		$lookfor='';
	}

	echo '<li><a href="'.$pageURL.'?mode=showterm&term_id=' . $zeile_maps['map_id'] . '&language=' . $zeile_maps['language'] . '&form=' . $showform . $lookfor . '">' . $zeile_maps['language'] . ' <strong>' . $showform . '</strong></a></li>';
	}
echo '</ul>';

?>
