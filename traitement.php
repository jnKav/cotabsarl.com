<?php
    
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
         
        // Récupérer les données du formulaire
        $subject = trim($_POST["Subject"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["Name"])));
        $telephone= trim($_POST['PhoneNumber']);
        $email = filter_var(trim($_POST["Email"]), FILTER_SANITIZE_EMAIL);
        $messageContent = trim($_POST["Message"]);
              
        // Valider les données du formulaire
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($telephone) OR empty($messageContent)) {
             
            echo json_encode(['success' => false, 'message' => 'Tous les champs sont obligatoires. Réessayer.']);
              
        } else {
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
                echo json_encode(['success' => true, 'message' => 'Merci! Votre message a été envoyé. Merci de nous avoir contacté!']);
            }else{
                echo json_encode(['success' => false, 'message' => 'Oops! Un problème s\'est produit, nous n\'avons pas pu envoyer votre message. Veuillez réessayer.']);
            }
        }
    } else {
         // Méthode de requête non autorisée
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Il y a eu un problème avec votre soumission, veuillez réessayer.']);
    }
?>
     