<?php

if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $mailfrom = $_POST['mail'];
    $message = $_POST['message'];

    if(empty($name) || empty($subject) || empty($mailfrom) || empty($message))
    {
        header("Location: index.php?contactme=empty");
        exit();
    }
    else
    {
        if(!preg_match("/^[a-zA-Z]*$/",$name) || !preg_match("/^[a-zA-Z]*$/", $subject))
        {
            header("Location: index.php?contactme=char");
            exit();
        }
        else
        {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                header("Location: index.php?contactme=invalidemail");
                exit();
            }
            else
            {
                $mailTo = "admin@jaredmcnamee.com";
                $headers = "From: " . $mailFrom;
                $txt = "You have received an email from " . $name . ".\n\n" . $message;

                mail($mailTo,$subject,$txt,$headers);
                header("Location: index.php?contactme=mailsend");
                exit();
            }
        }
    }
}
else
{
    header("Location: index.php?contactme=error");
    exit();
}


