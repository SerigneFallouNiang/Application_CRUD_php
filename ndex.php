<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSCRIPTION</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // Vérifier que le bouton ajouter a bien été cliqué
        if(isset($_POST['boutton'])) {
            // Extraction des informations envoyées dans des variables par la méthode POST
            extract($_POST);
            // Vérifier que tous les champs ont été remplis
            if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($password)) {
                // Connexion à la base de données
                include_once "connexion.php";
                // Vérifier la connexion à la base de données
                if($con) {
                    // Requête d'ajout avec une requête préparée
                    $stmt = $con->prepare("INSERT INTO utilisateur (nom, prenom, email, password) VALUES (?, ?, ?, ?)");
                    // Sécurisation du mot de passe en le hachant (ici en utilisant la fonction password_hash)
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    // Liaison des paramètres
                    $stmt->bind_param("ssss", $nom, $prenom, $email, $hashed_password);
                    // Exécution de la requête
                    if($stmt->execute()) {
                        // Redirection si l'inscription a réussi
                        header("location: index.php");
                        exit(); // Terminer le script après la redirection
                    } else {
                        $message = "Erreur lors de l'ajout de l'utilisateur.";
                    }
                } else {
                    $message = "Erreur de connexion à la base de données.";
                }
            } else {
                $message = "Veuillez remplir tous les champs !";
            }
        }
    ?>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>S'INSCRIRE</h2>
        <p class="erreur_message">
            <?php
            // Si la variable message existe, affichons son contenu
            if(isset($message)) {
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Nom</label>
            <input type="text" name="nom">
            <label>Prénom</label>
            <input type="text" name="prenom">
            <label>Email</label>
            <input type="email" name="email">
            <label>Mot de Passe</label>
            <input type="password" name="password">
            
            <input type="submit" value="INSCRIRE" name="boutton">
        </form>
    </div>
</body>
</html>
