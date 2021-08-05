<?php
$map_query= "SELECT * FROM maps2_ WHERE `map_id` ='".$_GET['term_id']."' ORDER BY FIELD(lang,'blr','bos','bul','cro','cz','kas','mk','pol','rus','srb','sk','sln','lso','uso','ukr')";
$map_result = mysqli_query($db, $map_query);
$i=0;
$map_lang_meta=array();
$map_list = array();
foreach ($map_result as $lang_row) {
	if ($lang_row['form'] =='∅') {
		$none_array_value ='x';
	}
	else {
		$none_array_value ='';
	}
	$map_lang  = array($lang_row['lang'],$lang_row['meaning_1'],$lang_row['meaning_2'],$lang_row['meaning_3'],$lang_row['meaning_4'],$lang_row['meaning_5'],$lang_row['meaning_6'],$lang_row['meaning_7'],$none_array_value);
	if ($lang_row['lang'] == $lang_before) {
		if (!$map_lang_meta[$i_before][0]) {
			$map_lang_meta[$i_before][0] = $map_lang[0];
		}
		if (!$map_lang_meta[$i_before][1]) {
			$map_lang_meta[$i_before][1] = $map_lang[1];
		}
		if (!$map_lang_meta[$i_before][2]) {
			$map_lang_meta[$i_before][2] = $map_lang[2];
		}
		if (!$map_lang_meta[$i_before][3]) {
			$map_lang_meta[$i_before][3] = $map_lang[3];
		}
		if (!$map_lang_meta[$i_before][4]) {
			$map_lang_meta[$i_before][4] = $map_lang[4];
		}
		if (!$map_lang_meta[$i_before][5]) {
			$map_lang_meta[$i_before][5] = $map_lang[5];
		}
		if (!$map_lang_meta[$i_before][6]) {
			$map_lang_meta[$i_before][6] = $map_lang[6];
		}
		if (!$map_lang_meta[$i_before][7]) {
			$map_lang_meta[$i_before][7] = $map_lang[7];
		}
		if (!$map_lang_meta[$i_before][8]) {
			$map_lang_meta[$i_before][8] = $map_lang[8];
		}
	}
	else {
		$map_lang_meta[]=$map_lang;
	$i_before=$i;
	$i++;
	}
	$lang_before=$lang_row['lang'];

	/*$arrlength = count($map_lang);
	for($x = 0; $x < $arrlength; $x++) {
		echo $map_lang[$x];
	}*/

}


$map_id = mysqli_query($db, "SELECT `map_name`,`map_url` FROM `maps_meanings2_` WHERE `map_id` = '" . $_GET['term_id'] . "' LIMIT 1");
while ($zeile3 = $map_id->fetch_assoc()) {
	$map_id_inside = $zeile3['map_name'];
	$map_url = $zeile3['map_url'];
} ?>

<div id="map" class="falsefriends_maps">

<?php if ($map_id_inside) {
		echo '<h3> Semasiological Map for ' . $map_id_inside . '</h3>';
} ?>

<table class="falsefriends_map">
<tbody><tr>
<td class="map_itself">
<div style="position:relative;width:460px;height:410px:"><img src="<?php echo $baseURL; ?>img/FFmap-grey.gif" />

<?php
foreach ($map_lang_meta as $languagex)  {
	if ($languagex[8]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-x.gif" /></div>
	<?php }
	if ($languagex[1]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-1.gif" /></div>
	<?php }
	 if (!($languagex[1]) AND (($languagex[2]) OR ($languagex[3]) OR ($languagex[4]) OR ($languagex[5]) OR  ($languagex[6] == 6) OR ($languagex7[7]))) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-x.gif" /></div>
 <?php }
	if ($languagex[2]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-2.gif" /></div>
	<?php }
	if ($languagex[3]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-3.gif" /></div>
	<?php }
	if ($languagex[4]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-4.gif" /></div>
	<?php }
	if ($languagex[5]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-5.gif" /></div>
	<?php }
	if ($languagex[6]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-6.gif" /></div>
	<?php }
	if ($languagex[7]) { ?>
		<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-<?php echo $languagex[0]; ?>-7.gif" /></div>
	<?php }
} ?>

<div class="smallmap"><img src="<?php echo $baseURL; ?>img/FFmap-CountryNamesSmaller.gif" /></div>
<div style="position:absolute; left:15px; top:15px"><big><strong><?php echo $map_id_inside; ?></strong></big></div>
</div>
</td>
<td class="map_legend">
<p><strong>Meanings:</strong></p>

<?php
$meanings = mysqli_query($db, "SELECT * FROM `maps_meanings2_` WHERE `map_id` = '".$_GET['term_id']."' AND `language`='English'");
	while ($meaningsx = $meanings->fetch_assoc()) {
		$meaning1x_inside = $meaningsx['meaning_1'];
		$meaning2x_inside = $meaningsx['meaning_2'];
		$meaning3x_inside = $meaningsx['meaning_3'];
		$meaning4x_inside = $meaningsx['meaning_4'];
		$meaning5x_inside = $meaningsx['meaning_5'];
		$meaning6x_inside = $meaningsx['meaning_6'];
		$meaning7x_inside = $meaningsx['meaning_7'];
		$meanings_number_inside = $meaningsx['meanings_number'];
	}
?><div>

<?php
if ($meaning1x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-1.gif" /> ‘<?php echo $meaning1x_inside; ?>’</div>
<?php }
if ($meaning2x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-2.gif" /> ‘<?php echo $meaning2x_inside; ?>’</div>
<?php }
if ($meaning3x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-3.gif" /> ‘<?php echo $meaning3x_inside; ?>’</div>
<?php }
if ($meaning4x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-4.gif" /> ‘<?php echo $meaning4x_inside; ?>’</div>
<?php }
if ($meaning5x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-5.gif" /> ‘<?php echo $meaning5x_inside; ?>’</div>
<?php }
if ($meaning6x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-6.gif" /> ‘<?php echo $meaning6x_inside; ?>’</div>
<?php }
if ($meaning7x_inside != "") { ?>
<div><img class="legend" src="<?php echo $baseURL; ?>img/FFMapLegend-7.gif" /> ‘<?php echo $meaning7x_inside; ?>’</div>
<?php } ?>
<div><img class="legend" style="display:inline-block;" src="<?php echo $baseURL; ?>img/FFMapLegend-none.gif"  /> no such word</div>
<div><div class="legend" style="border: 2px solid white;display:inline-block;"></div> no information yet</div>

</td>
</tr>
</tbody></table>

<table class="semmap">
<tbody>
	<tr>
		<td rowspan="2" style="vertical-align:middle;"><em><strong><?php echo $map_id_inside; ?></strong></em></td>
		<td colspan="<?php echo $meanings_number_inside; ?>"><center><strong>Meanings</strong></center></td>
	</tr>
	<tr>
	<?php
	if ($meaning1x_inside != "") { ?>
		<td><?php echo $meaning1x_inside; ?></td>
	<?php }
	if ($meaning2x_inside != "") { ?>
		<td><?php echo $meaning2x_inside; ?></td>
	<?php }
	if ($meaning3x_inside != "") { ?>
		<td><?php echo $meaning3x_inside; ?></td>
	<?php }
	if ($meaning4x_inside != "") { ?>
		<td><?php echo $meaning4x_inside; ?></td>
	<?php }
	if ($meaning5x_inside != "") { ?>
		<td><?php echo $meaning5x_inside; ?></td>
	<?php }
	if ($meaning6x_inside != "") { ?>
		<td><?php echo $meaning6x_inside; ?></td>
	<?php }
	if ($meaning7x_inside != "") { ?>
		<td><?php echo $meaning7x_inside; ?></td>
	<?php } ?>
	</tr>

<?php

$map_query2= "SELECT * FROM maps2_ WHERE `map_id` ='".$_GET['term_id']."' AND `hide` !='x' ORDER BY FIELD(lang,'rus','ukr','blr','pol','kas','lso','uso','cz','sk','sln','cro','bos','srb','mk','bul')";
$map_result2= mysqli_query($db, $map_query2);
//echo "<pre>";print_r($languagelist2);echo "</pre>";
foreach ($map_result2 as $languagex)  {

if (($languagex['lang'] == 'rus') OR ($languagex['lang'] == 'blr') OR ($languagex['lang'] == 'ukr') OR ($languagex['lang'] == 'sln') OR ($languagex['lang'] == 'cro') OR ($languagex['lang'] == 'bos') OR ($languagex['lang'] == 'srb') OR ($languagex['lang'] == 'mk') OR ($languagex['lang'] == 'bul')) {
	echo '<tr class="southeast">';
}
else {
	echo '<tr>';
}

echo '<td class="heading">';
if ($actual_lang == $languagex['language']) {
	echo '<a style="cursor:pointer;"onclick="$(\'html, body\').animate({ scrollTop: 0 }, \'fast\')" title="Jump to the top of this record">';

	echo $languagex['language'].' <em>'.$languagex['form'].'</em></a>';
}
else {
	echo '<a title="Jump to the record for '.$languagex['language'].' ‘'.$languagex['form'].'’" href="'.$_SERVER['REQUEST_URI'].'#'.$languagex['language'].'">';
	echo $languagex['language'].' <em>'.$languagex['form'].'</em></a>';
}


if ($languagex['semantics']) {echo ' <em>('.$languagex['semantics'].')</em>';}
if ($languagex['aspect']) {echo ' <span class="aspect">'.$languagex['aspect'].'</span>';}
if (($languagex['grammar']) AND ($languagex['aspect'])) {echo ', ';}
if ($languagex['grammar']) {echo ' '.$languagex['grammar'];}


echo '</td>';
echo '<td>';if ($languagex['meaning_1']) {echo '<strong>+</strong>';if ($languagex['comment_1']) {echo '<br><em>'.$languagex['comment_1'].'</em>';}}echo '</td>';
echo '<td>';if ($languagex['meaning_2']) {echo '<strong>+</strong>';if ($languagex['comment_2']) {echo '<br><em>'.$languagex['comment_2'].'</em>';}}echo '</td>';
if ($meanings_number_inside > 2){
echo '<td>';if ($languagex['meaning_3']) {echo '<strong>+</strong>';if ($languagex['comment_3']) {echo '<br><em>'.$languagex['comment_3'].'</em>';}}echo '</td>';}
if ($meanings_number_inside > 3){
echo '<td>';if ($languagex['meaning_4']) {echo '<strong>+</strong>';if ($languagex['comment_4']) {echo '<br><em>'.$languagex['comment_4'].'</em>';}}echo '</td>';}
if ($meanings_number_inside > 4){
echo '<td>';if ($languagex['meaning_5']) {echo '<strong>+</strong>';if ($languagex['comment_5']) {echo '<br><em>'.$languagex['comment_5'].'</em>';}}echo '</td>';}
if ($meanings_number_inside > 5){
echo '<td>';if ($languagex['meaning_6']) {echo '<strong>+</strong>';if ($languagex['comment_6']) {echo '<br><em>'.$languagex['comment_6'].'</em>';}}echo '</td>';}
if ($meanings_number_inside > 6){
echo '<td>';if ($languagex['meaning_7']) {echo '<strong>+</strong>';if ($languagex['comment_7']) {echo '<br><em>'.$languagex['comment_7'].'</em>';}}echo '</td>';}
unset($southeast);
echo '</tr>';
} ?>
	<tr>
		<td style="text-align:left;"><strong>Meanings</strong></td>
	<?php
	if ($meaning1x_inside != "") { ?>
		<td><?php echo $meaning1x_inside; ?></td>
	<?php }
	if ($meaning2x_inside != "") { ?>
		<td><?php echo $meaning2x_inside; ?></td>
	<?php }
	if ($meaning3x_inside != "") { ?>
		<td><?php echo $meaning3x_inside; ?></td>
	<?php }
	if ($meaning4x_inside != "") { ?>
		<td><?php echo $meaning4x_inside; ?></td>
	<?php }
	if ($meaning5x_inside != "") { ?>
		<td><?php echo $meaning5x_inside; ?></td>
	<?php }
	if ($meaning6x_inside != "") { ?>
		<td><?php echo $meaning6x_inside; ?></td>
	<?php }
	if ($meaning7x_inside != "") { ?>
		<td><?php echo $meaning7x_inside; ?></td>
	<?php }

if ($map_url) {
	echo '<div><strong><a target="_blank" href="https://en.wikibooks.org/wiki/False_Friends_of_the_Slavist/Map_'.$map_url.'">View this map on Wikibooks</a></strong> <a target="_blank" href="https://en.wikibooks.org/wiki/Talk:False_Friends_of_the_Slavist/Map_'.$map_url.'">[Discussion]</a> <a target="_blank" href="https://en.wikibooks.org/w/index.php?title=Talk:False_Friends_of_the_Slavist/Map_'.$map_url.'&action=edit">Edit</a></div>';
} ?>

	</tr>
</tbody>
</table>
</div>

