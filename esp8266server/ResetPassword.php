<?php

//grt confirmation to this file 
$email=htmlentities($_REQUEST["email"]);

if (empty($email)) {
    $returnArray["message"] = "Misiing required information";
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

// STEP 3 check if email is in Database
$user = $access->selectUserbyemail($email);
if(empty($user)){
    $returnArray["message"] = "email not found";
    echo json_encode($returnArray);
    return;

}

//STEP 4 send email
require ("secure/email.php");
$mailer = new email();
$token = $mailer->generatetoken(20);
//save in email tokens table
$access->saveToken("PasswordTokens",$user['id'],$token);

// prepare email message

$details = array();
$details["subject"] = "password reset request Watering APP";
$details["to"] = $email;
$details["fromName"] = "watering APP";
$details ["fromEmail"] = "brandon_amm@hotmail.com";

// access template file
$template = $mailer->ResetPasswordTemplate();
$template = str_replace("{token}", $token, $template);
$details["body"] = $template;

// send email tu user

$mailer->sendEmail($details);


//Step 5 Return message to app
$returnArray["email"] = $user["email"];
$returnArray["message"] = "we just sent an email to reset password";
echo json_encode($returnArray);

$access->disconnect();

?>