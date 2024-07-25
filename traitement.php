<?php
        $message = '';
        $message_class = '';


    // Vérifier si le formulaire a été soumis
    if (isset($_POST['submit'])) {

       // Récupérer les données du formulaire
        $subject = trim($_POST["Subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["Name"])));
        $telephone= trim($_POST['PhoneNumber']);
        $email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
        $messageContent = trim($_POST["Message"]);
        
        // Valider les données du formulaire
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty ($telephone) OR empty($messageContent)) {
                        
            $message="Tous les champs sont obligatoires. Réessayer.";
            $message_class='error';
            
        }else{
            
            // Préparer le corps du message
            $content = "Name: $name\n";
            $content .= "Telephone: $telephone\n";
            $content .= "E-mail: $email\n\n"; 
            $content .= "Objet: $subject\n";
            $content .= "Message:\n --- $messageContent\n";

            // Envoyer l'email
            $mail_to = "info@cotabsarl.com";
            $objet = "Message Web - $subject";
            $headers = "From: $name <$email>";

            
            if (mail($mail_to, $objet, $content, $headers)){
            
                //Set a 200 (okay) response code.
                
                $message="Merci! Votre message a été envoyé. Merci de nous avoir contacté!";
                $message_class='succes';
            } else {
                //Set a 500 (internal server error) response code.
               
                $message="Oops! Un problème s'est produit, nous n'avons pas pu envoyer votre message. Veuillez réessayer.";
                $message_class='error';
            }
        }

    } else {
        //Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        $message="Il y a eu un problème avec votre soumission, veuillez réessayer.";
        $message_class='error';
    }
    header("Location: contact.php");
    exit();
?>