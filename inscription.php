<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
       // Vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           // Vérifier que tous les champs ont été remplis
           if(!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['password'])){
                // Connexion à la base de données
                include_once "connexion.php";
                // Requête d'ajout avec requête préparée
                $stmt = $con->prepare("INSERT INTO utilisateur (prenom, nom, email, password) VALUES (?, ?, ?, ?)");
                // Liaison des paramètres
                $stmt->bind_param("ssss", $_POST['prenom'], $_POST['nom'], $_POST['email'], $_POST['password']);
                // Exécution de la requête
                if($stmt->execute()){
                    // Redirection si l'ajout a réussi
                    header("location: index.php");
                    exit(); // Terminer le script après la redirection
                } else {
                    $message = "Erreur lors de l'inscription. Veuillez réessayer.";
                }
           } else {
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
    ?>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>S'inscrire :</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Prénom</label>
            <input type="text" name="prenom">
            <label>Nom</label>
            <input type="text" name="nom">
            <label>Email</label>
            <input type="text" name="email">
            <label>Mot de passe</label>
            <input type="password" name="password">
            <input type="submit" value="S'inscrire" name="button">
        </form>
    </div>
</body>
</html>
