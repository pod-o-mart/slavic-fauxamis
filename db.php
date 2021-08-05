<?php
error_reporting(E_ALL);
$db = new mysqli('localhost', 'root', 'AP36eXgfnNSAYHf6', 'falsefriends_'); // ('HOST', 'USERNAME', 'USERPASSWORD', 'DATABASENAME');
print_r ($db->connect_error);
if ($db->connect_error) {die('Database error');}
?>
