<?php

if ($lang1_url == 'Russian') {
	$langpairspecific = 'Russian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Russian') {
	$langpairspecific = 'Russian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Belarusian') {
	$langpairspecific = 'Belarusian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Belarusian') {
	$langpairspecific = 'Belarusian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Ukrainian') {
	$langpairspecific = 'Ukrainian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Ukrainian') {
	$langpairspecific = 'Ukrainian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Polish') {
	$langpairspecific = 'Polish-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Polish') {
	$langpairspecific = 'Polish-'.str_replace(" ","_",$lang1_url);
}
elseif ((($lang1_url == 'Kashubian') AND ($lang2_url == 'Lower Sorbian')) OR (($lang2_url == 'Kashubian') AND ($lang1_url == 'Lower Sorbian'))) {
	$langpairspecific = 'Kashubian-Lower_Sorbian';
}
elseif ($lang1_url == 'Lower Sorbian') {
	$langpairspecific = 'Lower_Sorbian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Lower Sorbian') {
	$langpairspecific = 'Lower_Sorbian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Kashubian') {
	$langpairspecific = 'Kashubian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Kashubian') {
	$langpairspecific = 'Kashubian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Upper Sorbian') {
	$langpairspecific = 'Upper_Sorbian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Upper Sorbian') {
	$langpairspecific = 'Upper_Sorbian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Czech') {
	$langpairspecific = 'Czech-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Czech') {
	$langpairspecific = 'Czech-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Slovak') {
	$langpairspecific = 'Slovak-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Slovak') {
	$langpairspecific = 'Slovak-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Slovenian') {
	$langpairspecific = 'Slovenian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Slovenian') {
	$langpairspecific = 'Slovenian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Croatian') {
	$langpairspecific = 'Croatian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Croatian') {
	$langpairspecific = 'Croatian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Bosnian') {
	$langpairspecific = 'Bosnian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Bosnian') {
	$langpairspecific = 'Bosnian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Serbian') {
	$langpairspecific = 'Serbian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Serbian') {
	$langpairspecific = 'Serbian-'.str_replace(" ","_",$lang1_url);
}
elseif ($lang1_url == 'Macedonian') {
	$langpairspecific = 'Macedonian-'.str_replace(" ","_",$lang2_url);
}
elseif ($lang2_url == 'Macedonian') {
	$langpairspecific = 'Macedonian-'.str_replace(" ","_",$lang1_url);
}
else {
	$langpairspecific = str_replace(" ","_",$lang1_url).'-'.str_replace(" ","_",$lang2_url);
} ?>
