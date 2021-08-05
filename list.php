<?php

echo '<div class="singlelang">';
echo '<h2>' . $_GET['language'] . ' language</h2>';

$query_list = "SELECT * FROM maps2_ WHERE language ='" . $_GET['language'] . "' ORDER BY form ASC";
$ergebnis_list = mysqli_query($db, $query_list);
echo '<div class="container"><div class="row"><div class="wordlist col-xs col-sm-8 col-md-7 col-lg-8 col-xl-8"><h3 style="font-weight:bold;">List of the <em>' . $_GET['language'] . '</em> words in this database</h3><p style="line-height:1.8;">';

while ($zeile_list = $ergebnis_list->fetch_assoc()) {
	if (($zeile_list['form'] !="∅") AND ($zeile_list['form'] !="")) {
			$id_tobeckecked = $zeile_list['map_id'];
			echo ' <a style="font-weight:bold;" href="'.$pageURL.'?mode=showterm&term_id=' . $zeile_list['map_id'] . '&language=' . $_GET['language'] . '&form=' . $zeile_list['form'] . '">' . $zeile_list['form'] . '</a>  ';

	}
}

echo '</p></div><div class="col-xs col-sm-4 col-md-5 col-lg-4 col-xl-4">';
echo '<div class="otherlangs sidebar-right card card-grey"><p class="card-header" style="font-weight:bold;">Display a list of word pairs for ' . $_GET['language'] . ' and:</p>';
echo '<div class="card-body"><ul>';
foreach ($languagelist_alpha[0] as $wordpairs) {
	if ($_GET['language'] != $wordpairs) {
		echo '<li><strong><a href="'.$pageURL.'?mode=compare&lang1=' . $_GET['language'] . '&lang2='.$wordpairs.'">'.$wordpairs.'</a></strong></li>';
	}
}
echo '</ul></div></div>';
echo '<div id="wikibook" class="sidebar-right card card-grey"><h3 class="card-header">Wikibook</h3><div class="card-body"><p>If you want to contribute to the database for '.$_GET['language'].', please edit the <strong><a title="False Friends of the Slavist - Wikibook" target=_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist">Wikibook</a></strong>. The database will eventually be updated.</p>';
echo '<p><strong><a title="View the page for '.$_GET['language'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['language']).'">Wikibooks - False Friends of the Slavist/'.$_GET['language'].'</a></strong> ';
echo '<a style="font-weight: normal;" title="Contribute to the page for '.$_GET['language'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/Talk:False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['language']).'">[Discussion]</a> ';
echo '<a style="font-weight: normal;" title="Edit the page for '.$_GET['language'].' at the source project" target="_blank" href="https://en.wikibooks.org/w/index.php?title=False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['language']).'&action=edit">[Edit]</a></p></div></div>';

require ('bibliography.php');
echo '</div></div></div>';
?>
