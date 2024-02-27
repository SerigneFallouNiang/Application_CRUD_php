<?php

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "crud";

try {
    // Création d'une connexion
    $connexion = new PDO("mysql:host=$serveur;dbname=$base_de_donnees", $utilisateur, $mot_de_passe);

    // Configuration pour générer des exceptions en cas d'erreur SQL
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérification de la soumission du formulaire
if (isset($_POST["submit"])) {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $messages = $_POST['messages'];

    // Préparation de la requête SQL avec des paramètres nommés
    $sql = "INSERT INTO utilisateur(nom, prenom, email, messages) VALUES(:nom, :prenom, :email, :messages)";
    $stmt = $connexion->prepare($sql);

    // Liaison des paramètres
    $stmt->bindParam(":prenom", $prenom);
    $stmt->bindParam(":nom", $nom);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":messages", $messages);

    // Exécution de la requête
    $stmt->execute();

    echo "OK"; // Affichage si l'insertion s'est bien déroulée
} else {
    echo "Erreur"; // Affichage en cas d'absence de soumission du formulaire
}

?>


