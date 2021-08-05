<?php
echo '<h2>Statistics</h2>';

$stats_maps1 = $db->query("SELECT * FROM `maps2_`");
foreach ($stats_maps1 as $rows2) {
	$stats_maps1_no++;
	${'stats_lang1_' . $rows2['lang']}++;
	if ($rows2['meaning_1']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
	if ($rows2['meaning_2']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
	if ($rows2['meaning_3']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
	if ($rows2['meaning_4']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
	if ($rows2['meaning_5']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
	if ($rows2['meaning_6']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
	if ($rows2['meaning_7']) {
		${'stats_lang_meanings1_' . $rows2['lang']}++;
		$stats_maps2_no++;
	}
}

echo '<h4>Number of terms</h4>';
foreach ($languagelist_alpha[1] as $rows3) {
	$get_longlang = array_search($rows3,$languagelist_alpha[1]);
	$query_longlang = $languagelist_alpha[0][$get_longlang];
	echo '<strong>'.$query_longlang.':</strong> '.${'stats_lang1_'.$rows3}.'<br>';
	}
echo '<strong>Total: '.$stats_maps1_no.'</strong>';

echo '<h4>Number of meanings</h4>
<p>Counts all individual meanings of every single term</p>';
foreach ($languagelist_alpha[1] as $rows4) {
	$get_longlang = array_search($rows4,$languagelist_alpha[1]);
	$query_longlang = $languagelist_alpha[0][$get_longlang];
	echo '<strong>'.$query_longlang.':</strong> '.${'stats_lang_meanings1_'.$rows4}.'<br>';
}
echo '<strong>Total: '.$stats_maps2_no.'</strong>';

echo '<h4>English meaning descriptions</h4>
<p>This is also the number of all dedicated meanings known to the database</p>';

$stats_maps_meanings1 = $db->query("SELECT * FROM `maps_meanings2_`");
foreach ($stats_maps_meanings1 as $rows5) {
	if ($rows5['language'] == 'English') {
		if ($rows5['meaning_1']) {
			$stats_lang_meanings_english++;
		}
		if ($rows5['meaning_2']) {
			$stats_lang_meanings_english++;
		}
		if ($rows5['meaning_3']) {
			$stats_lang_meanings_english++;
		}
		if ($rows5['meaning_4']) {
			$stats_lang_meanings_english++;
		}
		if ($rows5['meaning_5']) {
			$stats_lang_meanings_english++;
		}
		if ($rows5['meaning_6']) {
			$stats_lang_meanings_english++;
		}
		if (($rows5['meaning_7']) AND ($rows5['meaning_7'] !='Other')) {   // !!
			$stats_lang_meanings_english++;
		}
	}
	else {
		foreach ($languagelist_alpha[1] as $rows6) {
			$get_longlang = array_search($rows6,$languagelist_alpha[1]);
			$query_longlang = $languagelist_alpha[0][$get_longlang];
			if ($rows5['language'] == $query_longlang) {
				if ($rows5['meaning_1']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
				if ($rows5['meaning_2']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
				if ($rows5['meaning_3']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
				if ($rows5['meaning_4']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
				if ($rows5['meaning_5']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
				if ($rows5['meaning_6']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
				if ($rows5['meaning_7']) {
					${'stats_lang_meanings2_' . $rows6}++;
					$stats_lang_meanings_slavic++;
				}
			}
		}
	}
}

echo '<p><strong>Total meanings</strong> (i.e. English descriptions): '.$stats_lang_meanings_english.'</p>
<p>Number of translated meanings (synonyms):<p>';
foreach ($languagelist_alpha[1] as $rows7) {
	$get_longlang = array_search($rows7,$languagelist_alpha[1]);
	$query_longlang = $languagelist_alpha[0][$get_longlang];
	echo '<strong>'.$query_longlang.':</strong> '.${'stats_lang_meanings2_'.$rows7}.'<br>';
}
echo '<strong>Total: '.$stats_lang_meanings_slavic.'</strong><br>';

echo '<h4>Other basic statistical functions to be implemented in future:</h4>
<ul>
<li>Number of complete false friends (+per languages)</li>
<li>Number of true friends</li>
<li>Unique meanings</li>
</ul>';

?>
