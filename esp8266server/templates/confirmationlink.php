<?php
// check required and passed inf
$token = htmlentities($_GET["token"]);

if (empty($token)) {
    echo "Missing required info";
}
// build connection 
//Secure way to build connection
$file = parse_ini_file('../../../ESP8266watering.ini');

//store info from .ini file
$host = trim($file['dbhost']);
$user = trim($file['dbuser']);
$pass = trim($file['dbpass']);
$name = trim($file['dbname']);


// include access php file tu function
require('secure/Access.php');
$access = new access($host, $user, $pass, $name);
$access->connect();

// GET USER ID
$id = $access->getUserID("EmailTokens", $token);
if (empty($id["id"])) {
    echo "user with this token is not found";
    return;
}

// change status of email confirmation and delete token
$result = $access->emailConfrimationStatus(1, $id["id"]);

if ($result) {
    $access->deleteToken("EmailTokens", $token);
    echo "Thank you! your email is confirmed";
}

$access->disconnect();

?>