<?php

$to_email = "sharmanitish31396@gmail.com";
$subject = "Simple Mail Transfer Test Using PHP";
$body = "Hii, This is test email send by PHP Script in 2023 by SMTP youtube channel";
$sender = "From: shivlalkumarsharma30062003@rjcollege.edu.in";

if(mail($to_email,$subject,$body,$sender)){
    echo "Email Successfully sent to $to_email...";
}
else{
    echo "Email Sending Failed...";
}
?>