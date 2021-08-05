<?php

echo '<div class="twolangs">';
echo '<h2>' . $_GET['lang1'] . '-' . $_GET['lang2'] . ' wordlist</h2>';
$query_lang1 = "SELECT * FROM maps2_ WHERE language ='" . $_GET['lang1'] . "' ORDER BY form ASC";
$query_lang2 = "SELECT * FROM maps2_ WHERE language ='" . $_GET['lang2'] . "' ORDER BY form ASC";
$ergebnis_lang1 = mysqli_query($db, $query_lang1);
$ergebnis_lang2 = mysqli_query($db, $query_lang2);
$paircount = 0;
echo '<div class="compare container"><div class="row">';
echo '<table class="table-compare table table-striped table-hover table-sm col-xs col-sm-6 col-md-6 col-lg-4 col-xl-4 table-left"><thead>';
echo '<tr><th scope="col">'.$_GET['lang1'].'</th><th scope="col">'.$_GET['lang2'].'</th></tr></thead><tbody>';


foreach ($ergebnis_lang1 as $zeile_lang1 )  {
	foreach ($ergebnis_lang2 as $zeile_lang2 )  {
		if ($zeile_lang1['map_id'] == $zeile_lang2['map_id']) {
			if (($zeile_lang1['language'] != $zeile_lang2['language']) AND ($zeile_lang2['form'] != "∅") AND ($zeile_lang1['form'] != "∅") AND ($zeile_lang2['form'] != "") AND ($zeile_lang1['form'] != "")) {
				$paircount++;
			}
		}
	}
}
$paircount =intdiv($paircount, 2);

foreach ($ergebnis_lang1 as $zeile_lang1 )  {
	foreach ($ergebnis_lang2 as $zeile_lang2 )  {
		if ($zeile_lang1['map_id'] == $zeile_lang2['map_id']) {
			if (($zeile_lang1['language'] != $zeile_lang2['language']) AND ($zeile_lang2['form'] != "∅") AND ($zeile_lang1['form'] != "∅") AND ($zeile_lang2['form'] != "") AND ($zeile_lang1['form'] != "")) {
				echo '<tr><td><a title="'.$zeile_lang1['language'].'" style="font-weight:bold;line-height:1.8;" href="'.$pageURL.'?mode=showterm&term_id=' . $zeile_lang1['map_id'] . '&form=' . $zeile_lang1['form'] . '&language=' . $zeile_lang1['language'] . '#' . $zeile_lang2['language'] . '">' . $zeile_lang1['form'] . '</a></td><td><a title="'.$zeile_lang2['language'].'" style="font-weight:bold;line-height:1.8;" href="'.$pageURL.'?mode=showterm&term_id=' . $zeile_lang1['map_id'] . '&form=' . $zeile_lang2['form'] . '&language=' . $zeile_lang2['language'] . '#' . $zeile_lang1['language'] . '">' . $zeile_lang2['form'] . '</a></td></tr>';
				$paircount2++;

				if ($paircount2 == $paircount) {
					echo '</tbody></table><table class="table-compare table table-striped table-hover table-sm col-xs col-sm-6 col-md-6 col-lg-4 col-xl-4"><thead>';
					echo '<tr><th scope="col" class="d-none d-sm-table-cell">'.$_GET['lang1'].'</th><th scope="col" class="d-none d-sm-table-cell">'.$_GET['lang2'].'</th></tr></thead><tbody>';
				}
			}
		}
	}
}
echo '</tbody></table><div class="col-md col-lg-4 col-xl-4">';
echo '<p style="text-align:right;"><strong><a href="'.$pageURL.'?mode=list&language=' . $_GET['lang1'] . '">Display all ' . $_GET['lang1'] . ' terms in the database</a></strong></p>';
echo '<p style="text-align:right;"><strong><a href="'.$pageURL.'?mode=list&language=' . $_GET['lang2'] . '">Display all ' . $_GET['lang2'] . ' terms in the database</a></strong></p>';
$lang1_url=$_GET['lang1'];
$lang2_url=$_GET['lang2'];
include ('wikibook.php');

echo '<div id="wikibook" class="sidebar-right card card-grey"><h3 class="card-header">Wikibook</h3><div class="card-body"><p>If you want to contribute to the database for ' . $_GET['lang1'] . ' and ' . $_GET['lang2'] . ', please edit the <strong><a title="False Friends of the Slavist - Wikibook" target=_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist">Wikibook</a></strong>. The database will eventually be updated.</p>';

echo '<p><strong><a title="View the page for '.$_GET['lang1'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['lang1']).'">Wikibooks - False Friends of the Slavist/'.$_GET['lang1'].'</a></strong> ';
echo '<a style="font-weight: normal;" title="Contribute to the page for '.$_GET['lang1'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/Talk:False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['lang1']).'">[Discussion]</a> ';
echo '<a style="font-weight: normal;" title="Edit the page for '.$_GET['lang1'].' at the source project" target="_blank" href="https://en.wikibooks.org/w/index.php?title=False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['lang1']).'&action=edit">[Edit]</a></p>';

echo '<p><strong><a title="View the page for '.$_GET['lang2'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['lang2']).'">Wikibooks - False Friends of the Slavist/'.$_GET['lang2'].'</a></strong> ';
echo '<a style="font-weight: normal;" title="Contribute to the page for '.$_GET['lang2'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/Talk:False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['lang2']).'">[Discussion]</a> ';
echo '<a style="font-weight: normal;" title="Edit the page for '.$_GET['lang2'].' at the source project" target="_blank" href="https://en.wikibooks.org/w/index.php?title=False_Friends_of_the_Slavist/'.str_replace(" ","_",$_GET['lang2']).'&action=edit">[Edit]</a></p>';

if (($langpairspecific =='Russian-Lower_Sorbian') OR ($langpairspecific =='Belarusian-Lower_Sorbian') OR ($langpairspecific=='Ukrainian-Lower_Sorbian') OR ($langpairspecific =='Kashubian-Lower_Sorbian') OR ($langpairspecific=='Kashubian-Upper Sorbian') OR ($langpairspecific =='Lower_Sorbian-Kashubian') OR ($langpairspecific=='Lower_Sorbian-Croatian') OR ($langpairspecific =='Lower_Sorbian-Bosnian') OR ($langpairspecific=='Lower_Sorbian-Bulgarian')) {
	echo '<a style=color:darkred;" title="The Wikibook project page for '.$_GET['lang1'].' and '.$_GET['lang2'].' does not exist yet. Please help creating it" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.$langpairspecific.'">Wikibooks - False Friends of the Slavist/'.$_GET['lang1'].'-'.$_GET['lang2'].'</a>';
}
else {
	echo '<p><strong><a title="View the page for '.$_GET['lang1'].'-'.$_GET['lang2'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/'.$langpairspecific.'">Wikibooks - False Friends of the Slavist/'.$_GET['lang1'].'-'.$_GET['lang2'].'</a></strong> ';
	echo '<a style="font-weight: normal;" title="Contribute to the page for '.$_GET['lang1'].'-'.$_GET['lang2'].' at the source project" target="_blank" href="https://en.wikibooks.org/wiki/Talk:False_Friends_of_the_Slavist/'.$langpairspecific.'">[Discussion]</a> ';
	echo '<a style="font-weight: normal;" title="Edit the page for '.$_GET['lang1'].'-'.$_GET['lang2'].' at the source project" target="_blank" href="https://en.wikibooks.org/w/index.php?title=False_Friends_of_the_Slavist/'.$langpairspecific.'&action=edit">[Edit]</a></p>';
}
echo '</div></div>';
require ('bibliography.php');
echo '</div></div></div></div>';
?>



