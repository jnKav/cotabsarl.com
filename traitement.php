<?php
    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {

       // Récupérer les données du formulaire
        $subject = trim($_POST["Subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["Name"])));
        $telephone= trim($_POST['PhoneNumber']);
        $email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["Message"]);
        
        // Valider les données du formulaire
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty ($telephone) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Tous les champs sont obligatoires. Réessayer.";
            
        }else{
            $erreur = "";

            // Préparer le corps du message
            $content = "Name: $name\n";
            $content .= "Telephone: $telephone\n";
            $content .= "E-mail: $email\n\n"; 
            $content .= "Objet: $subject\n";
            $content .= "Message:\n$message\n";

            // Envoyer l'email
            $mail_to = "info@cotabsarl.com";
            $objet = "COTAB SARL Web - $subject";
            $headers = "From: $name <$email>";

            
            $success = mail($mail_to, $objet, $content, $headers);
            if ($success) {
                //Set a 200 (okay) response code.
                http_response_code(200);
                echo "Merci! Votre message a été envoyé. Merci de nous avoir contacté!";
            } else {
                //Set a 500 (internal server error) response code.
                http_response_code(500);
                echo "Oops! Un problème s'est produit, nous n'avons pas pu envoyer votre message.";
            }
        }

    } else {
        //Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
    }

?>