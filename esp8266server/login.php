<?php



// STEP 1  check variables via POST
$username = htmlentities($_REQUEST["username"]);
$password = htmlentities($_REQUEST["password"]);

if (empty($username) || empty($password)) {
    $returnArray["status"] = "400";
    $returnArray["message"] = "missing required information";
    echo json_encode($returnArray);
    return;
}

// STEP 2 Build Connection
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

// STEP 3 get user info
$user = $access->getUser($username);

if (empty($user)) {
    $returnArray["status"] = "403";
    $returnArray["message"] = "User is not found";
    echo json_encode($returnArray);
    return;
}

// STEP 4 Validate Password
//get password and salt from database
$secured_password = $user["password"];
$salt = $user["salt"];

if ($secured_password == sha1($password . $salt)) {

    $returnArray["status"] = "200";
    $returnArray["message"] = "logged in succesfully";
    $returnArray["id"] = $user["id"];
    $returnArray["userame"] = $user["username"];
    $returnArray["email"] = $user["email"];
    $returnArray["fullname"] = $user["fullname"];
    $returnArray["ava"] = $user["ava"];
}else {
    $returnArray["status"] = "403";
    $returnArray["message"] = "Incorret password";
}

// STEP 5. Close connection
$access->disconnect();

// STEP 6. throback info
echo json_encode($returnArray);

?>