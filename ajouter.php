<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
       // Vérifier que le bouton ajouter a bien été cliqué
       if(isset($_POST['button'])){
           // Vérifier que tous les champs ont été remplis
           if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['statut'])){
                // Connexion à la base de données
                include_once "connexion.php";
                // Requête d'ajout avec requête préparée
                $stmt = $con->prepare("INSERT INTO idee (titre, description, statut) VALUES (?, ?, ?)");
                // Liaison des paramètres
                $stmt->bind_param("sss", $_POST['titre'], $_POST['description'], $_POST['statut']);
                // Exécution de la requête
                if($stmt->execute()){
                    // Redirection si l'ajout a réussi
                    header("location: acceuil.php");
                    exit(); // Terminer le script après la redirection
                } else {
                    $message = "Idee non ajoutee";
                }
           } else {
               $message = "Veuillez remplir tous les champs !";
           }
       }
    
    ?>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Ajouter une idee</h2>
        <p class="erreur_message">
            <?php 
            // si la variable message existe , affichons son contenu
            if(isset($message)){
                echo $message;
            }
            ?>
        </p>
        <form action="" method="POST">
            <label>Titre</label>
            <input type="text" name="titre">
            <label>Description</label>
            <textarea name="description" id="" cols="30" rows="10"></textarea>
            <label>Statut</label>
            <input type="text" name="statut">
            <input type="submit" value="Ajouter" name="button">
        </form>
    </div>
</body>
</html>
