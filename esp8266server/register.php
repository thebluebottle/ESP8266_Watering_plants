<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//store variables
$username = htmlentities($_REQUEST['username']);
$password = htmlentities($_REQUEST['password']);
$email = htmlentities($_REQUEST['email']);
$fullname = htmlentities($_REQUEST['fullname']);

// if get POST are empty
IF (empty($username) || empty($password) || empty($email) || empty($fullname)){
    $returnArray['status'] = '400';
    $returnArray['message'] = 'missing required information';
    echo json_encode($returnArray);
    return;
    }

// secure password
$salt = openssl_random_pseudo_bytes(20);
$secured_password = sha1($password . $salt);


// Build Connection**************************************************
//Secure way to build connection
$file = parse_ini_file('../../../ESP8266watering.ini');

//store info from .ini file
$host = trim($file['dbhost']);
$user = trim($file['dbuser']);
$pass = trim($file['dbpass']);
$name = trim($file['dbname']);


// include access php file tu function
require ('secure/Access.php');
$access = new access($host, $user, $pass, $name);
$access->connect();

//***************************************************************** */

//*****************STEP 3 insert user information ******************/

$result = $access->registerUser($username, $secured_password, $salt, $email, $fullname);
echo 'aqui';

if ($result){
    $user = $access->selectUser($username);
    $returnArray['status'] = '200';
    $returnArray['message'] = 'succesfully registered';
    $returnArray['id'] = $user['id'];
    $returnArray['username'] = $user['username'];
    $returnArray['email'] = $user['email'];
    $returnArray['fullname'] = $user['fullname'];
    $returnArray['ava'] = $user['ava'];


} else {
    $returnArray['status'] = '400';
    $returnArray['message'] = 'Could not register with provided information';

}
// close connection***************************************************
$access->disconnect();

echo json_encode($returnArray);

?>
