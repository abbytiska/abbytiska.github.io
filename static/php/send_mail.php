<?php

    if(isset($_POST['contact-submit']))
    {
        $firstname = htmlspecialchars(stripslashes(trim($_POST['first_name'])));
        $lastname = htmlspecialchars(stripslashes(trim($_POST['last_name'])));
        $email = htmlspecialchars(stripslashes(trim($_POST['email'])));
        $message = htmlspecialchars(stripslashes(trim($_POST['message'])));

        $error = null;
        
        // Validate strings
        if(!preg_match("/^[A-Za-z .'-]+$/", $firstname))
        {
            $error =  "Invalid characters in \"First Name\"";
        }
        else if(!preg_match("/^[A-Za-z .'-]+$/", $lastname))
        {
            $error = "Invalid characters in \"Last Name\"";
        }
        else if(!preg_match("/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/", $email))
        {
            $error = "Invalid email";
        }
        else if(strlen($message) === 0)
        {
            $error = "\"Message\" cannot be empty!";
        }

        // Echo error message if validation fails
        if(!is_null($error))
        {
            echo $error;
        }
        else
        {
            // Send message if validation succeeds
            $to = "jordanmlacalle@gmail.com";
            $subject = "abbytiska.com | New Contact Request";
            $headers = "From: contact@abbytiska.com" . "\r\n" .
                    "CC: $email";
            $message = htmlspecialchars($message);
            $message = wordwrap($message, 70);
            $message = "Message from $firstname $lastname ($email):\n" . $message;
            

            if(mail($to, $subject, $message, $headers))
            {
                echo "1";
            }
            else
            {
                echo "Message did not send! Try again later.";
            }

            // Echo error message if message fails to send
        }
        
    }
    else
        echo "Something went wrong!";

?>