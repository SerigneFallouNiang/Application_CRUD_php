


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion :</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// Vérifier que le bouton ajouter a bien été cliqué
if(isset($_POST['button'])){
    // Vérifier que tous les champs ont été remplis
    if(!empty($_POST['email']) && !empty($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
        // Connexion à la base de données
        include_once "connexion.php";

        // Utiliser les requêtes préparées pour éviter les injections SQL
        $stmt = $con->prepare("SELECT * FROM utilisateur WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            // Utilisateur trouvé, rediriger vers index.php
            header("location: acceuil.php");
        } else {
            // Utilisateur non trouvé
            $message = "Utilisateur non trouvé";
        }
        $stmt->close();
    } else {
        $message = "Veuillez remplir tous les champs !";
    }
}
?>

    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>connexion :</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Email</label>
            <input type="text" name="email">
            <label>Mot de passe</label>
            <input type="password" name="password">
            <input type="submit" value="Connexion" name="button">
            <label>veuillez vous s'inscrire si vous n'avez pas de compte</label>
            <a href="inscription.php">s'inscrire</a>
        </form>
    </div>
</body>
</html>






