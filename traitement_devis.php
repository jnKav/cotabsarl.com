<?php
    if (isset($_POST['submit'])) {
        // Récupérer les données du formulaire
        $name = htmlspecialchars($_POST['Name']);
        $email = htmlspecialchars($_POST['Email'], FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars($_POST['PhoneNumber']);
        $subject = htmlspecialchars($_POST['Subject']);
        $message = htmlspecialchars($_POST['Message']);

        // Vérification des champs obligatoires
        if (empty($name) || filter_var($email, FILTER_VALIDATE_EMAIL) || empty($phone) || empty($message)) {
            echo "Les champs Nom, Email et Message sont obligatoires.";
            exit;
        }

        // Vous pouvez ajouter ici une validation supplémentaire si nécessaire

        // Traitement des données, comme les envoyer par email ou les enregistrer dans une base de données
        $to = "info@cotabsarl.com"; 
        $subject = "Nouvelle demande de devis de " . $name;
        $body = "Nom: $name\nEmail: $email\nTéléphone: $phone\nMessage:\n$message";

        // Utiliser mail() pour envoyer l'email
        if (mail($to, $subject, $body)) {
            echo "Merci, votre demande de devis a été envoyée avec succès.";
        } else {
            echo "Une erreur s'est produite lors de l'envoi de votre demande. Veuillez réessayer plus tard.";
        }
    } else {
        echo "Méthode de requête non valide.";
    }
?>