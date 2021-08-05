<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="description" content="Do similar words from different Slavic languages have the same meaning? Easy-to-use access to information on interlingual interferences in the Slavic languages." />
	<meta name="keywords" content="" />
	<meta name="author" content="Martin Podolak" />
	<title>False Friends in Slavic Languages</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://slavonic.github.io/css/fonts.css" type="text/css">
	<!-- JQUERY?	-->
	<link href="style.css" rel="stylesheet" type="text/css" />
	<link href="https://pod-o-mart.github.io/keyboardBookmarklets/kb-slav.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.jsdelivr.net/gh/jquery/jquery@3.4.1/dist/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://pod-o-mart.github.io/keyboardBookmarklets/kb-slav.js" type="text/javascript"></script>

</head>

<body>
<?php
require 'db.php';
mysqli_query($db, "SET NAMES 'utf8'");
$languagelist_alpha = array
(
	array("Belarusian","Bosnian","Bulgarian","Croatian","Czech","Kashubian","Macedonian","Russian","Polish","Serbian","Slovak","Slovenian","Lower Sorbian","Upper Sorbian","Ukrainian"),
	array("blr","bos","bul","cro","cz","kas","mk","rus","pol","srb","sk","sln","lso","uso","ukr")
);
$navtable = array
(
	array("Russian","Ukrainian","Belarusian","Kashubian","Polish","Lower Sorbian","Upper Sorbian","Czech","Slovak","Slovenian","Croatian","Bosnian","Serbian","Macedonian","Bulgarian"),
	array("rus","ukr","blr","kas","pol","lso","uso","cz","sk","sln","cro","bos","srb","mk","bul"),
	array("Rus.","Ukr.","Blr.","Kas.","Pol.","LSo.","USo.","Cz.","Sk.","Slo.","Cro.","Bos.","Srb.","Mk.","Bul."),
	array("east","east","east","west","west","west","west","west","west","south","south","south","south","south","south")
); ?>

<div class="falsefriend">

<?php
if ((!$_GET['meanings']) AND ($_GET['string'])){
	unset($preference_meanings);
	setcookie("fauxamis_preference_meanings", "", time() - 3600);
}
elseif ((!$_GET['meanings']) AND ($_GET['string']=='starts')){
	unset($preference_meanings);
	unset($preference_string);
	setcookie("fauxamis_preference_meanings", "", time() - 3600);
	setcookie("fauxamis_preference_string", "", time() - 3600);
}
elseif (($_GET['meanings']) AND ($_GET['string'])){
	$preference_meanings = $_GET['meanings'];
	setcookie("fauxamis_preference_meanings", $preference_meanings);
	$preference_string = 'contains';
}
else {
	$preference_meanings = $_COOKIE['fauxamis_preference_meanings'];
}
if (($_GET['string']) AND (($_GET['string']) != 'starts')) {
	$preference_string = $_GET['string'];
}
else {
	//$preference_string = $_COOKIE['fauxamis_preference_string'];
}

if (($_GET['string'] != 'starts') OR ($preference_string != 'starts')) {
	setcookie("fauxamis_preference_string", $preference_string);
}
?>
<center>
<script>
var paneadd = document.getElementById("fauxamispane");
var paneremove = document.getElementById("portalpane");
  paneadd.classList.add("welcome_search_active");
  paneremove.classList.remove("welcome_search_active");
</script>
<h1 style="padding-top:15px;"><a href="index.php" title="go to the main page" style="color:black;text-decoration:none;">False Friends in Slavic Languages</a></h1>
<form action="<?php echo $pageURL ?>" method="get" style="justify-content: center;display:table;" class="form-inline">
	<center><div class="form-group" style="display: block;">
		<select id="string" name="string" class="form-control">
			<option value="starts">Starts with</option>
			<option<?php if (($preference_string == 'contains') OR ($preference_meanings)) {echo ' selected="selected"';}?> value="contains">Contains</option>
			<option<?php if (($preference_string == 'ends') AND (!$preference_meanings)) {echo ' selected="selected"';}?> value="ends">Ends with</option>
			<option<?php if (($preference_string == 'exact') AND (!$preference_meanings)) {echo ' selected="selected"';}?> value="exact">Exact match</option>
		</select>
		<input type="text" class="keyboardInput form-control" value="<?php echo $_GET['search']; ?>" name="search"></input>
		<button name="Search" type="submit" class="btn btn-primary">
			<span class="icon-search icon-white fas fa-search"></span>
			Search
		</button>
	</div></center>

	<div class="form-group">
		<input title="This option always searches ‘contains’, overriding other preferences. Minimum 4 characters, please be patient with the database" id="meanings" name="meanings" class="form-check-input" type="checkbox"<?php if ($preference_meanings) {echo ' checked';}?>><strong style="margin-right: 4px;">Include Slavic and English annotation in result:</strong>  meanings, synonyms, grammar, comments</input>
	</div>
</form>
</center>

<?php

if (($_GET['search']) AND ($_GET['meanings']=='on'))
	if (strlen(utf8_decode($_GET['search'])) <= 3){
		echo '<br><span style="margin-top:40px;" class="alert alert-warning" role="alert">Search including Slavic and English annotation requires a minimum of 4 characters</span>';
	}
	else
	{
		require ('search.php');
	}
elseif ($_GET['search']) {
	if (strlen(utf8_decode($_GET['search'])) <= 1){
		echo '<br><span style="margin-top:40px;" class="alert alert-warning" role="alert">Minimum 2 characters required</span>';
	}
	else
	{
		require ('search.php');
	}
}

elseif ($_GET['mode'] =="showterm") {
	require ('showterm.php');
}

elseif ($_GET['mode'] =="list") {
	require ('list.php');
}

elseif ($_GET['mode'] =="compare") {
	require ('compare.php');
}

elseif ($_GET['mode'] =="ambiguous") {
	require ('ambiguous.php');
}

elseif ($_GET['mode'] =="statistics") {
	require ('statistics.php');
}

elseif ($_GET['mode'] =="bibliography") {
	require ('bibliography.php');
}

if ((!$_GET['mode'] =="showterm") AND (!$_GET['search']) AND (!$_GET['bibliography']) AND (!$_GET['statistics']) AND (!$_GET['ambiguous']) AND (!$_GET['mode'] =="list") AND (!$_GET['mode'] =="compare")) {
	include('tableindex.php');
	include('welcome.php');
}


if (($_GET['mode'] =="showterm") OR ($_GET['search']) OR ($_GET['bibliography']) OR ($_GET['statistics']) OR ($_GET['ambiguous']) OR ($_GET['mode'] =="list") OR ($_GET['mode'] =="compare")) {
	echo '<div style="clear:both;margin-top:50px;"></div><center><p><a style="font-size:0.9em;" href="index.php#copyrights">Copyrights for the ‘False Friends in Slavic Languages’</a><p></center>';
}
?>
</div>
<script>
	$('[title]').attr('data-toggle', 'tooltip');
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip();   
	});
</script>
</body>
</html>