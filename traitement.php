<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "info@cotabsarl.com";
        
        # Sender Data
        $subject = trim($_POST["Subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["Name"])));
        $telephone= trim($_POST['PhoneNumber']);
        $email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["Message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty ($telephone) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Veuillez remplir le formulaire et réessayer.";
            exit;
        }
        
        # Mail Content
        $content = "Name: $name\n";
        $content = "Objet: $subject\n";
        $content .= "Telephone: $telephone\n";
        $content .= "E-mail: $email\n\n";
        $content .= "Message:\n$message\n";

        
        $headers = "From: $name <$email>";

        # Send the email.
        $success = mail($mail_to,$content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Merci! Votre message a été envoyé. Merci de nous avoir contacté!";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Un problème s'est produit, nous n'avons pas pu envoyer votre message.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
    }

?>