<?php

class email {
    function generatetoken($charactersLenght) {
        $characters = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM0123456789";

        $charactersLenght= strlen($characters);

        $token ="";

        for ($i = 0; $i < $charactersLenght; $i ++) {
            // concatenate
            $token .= $characters[random_int(0,$charactersLenght-1)];
        }
        return $token;

    }

    function confirmationTemplate() {

        $file = fopen("templates/confirmationTemplate.html", "r") or die("unable to open file");

        $template = fread($file, filesize("templates/confirmationTemplate.html"));

        fclose($file);

        return $template;
    }

    function ResetPasswordTemplate() {

        $file = fopen("templates/ResetPasswordTemplate.html", "r") or die("unable to open file");

        $template = fread($file, filesize("templates/ResetPasswordTemplate.html"));

        fclose($file);

        return $template;
    }
    //send email with php   

    function sendEmail($details){
        $subject = $details["subject"];
        $to = $details["to"];
        $fromName = $details["fromName"];
        $fromEmail = $details["fromEmail"];
        $body = $details["body"];

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html:content=UTF-8" . "\r\n";
        $headers .= "From: " . $fromName . "<" . $fromEmail . ">" . "\r\n";

        mail($to,$subject,$body,$headers);



    }

}


?>