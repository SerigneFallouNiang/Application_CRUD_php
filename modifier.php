<?php
    // Vérifier que le bouton est soumis
    if(isset($_POST['button'])){
        // Vérifier que tous les champs sont remplis
        if(!empty($_POST['titre']) && !empty($_POST['description']) && !empty($_POST['statut'])){
            // Inclure le fichier de connexion à la base de données
            include_once "connexion.php";
            // Si l'id de l'idée à modifier est défini dans l'URL
            if(isset($_GET['id'])){
                // Requête de mise à jour avec une requête préparée
                $stmt = $con->prepare("UPDATE idee SET titre = ?, description = ?, statut = ? WHERE id = ?");
                // Liaison des paramètres
                $stmt->bind_param("sssi", $_POST['titre'], $_POST['description'], $_POST['statut'], $_GET['id']);
                // Exécution de la requête
                if($stmt->execute()){
                    // Redirection après la modification
                    header("location: acceuil.php");
                    exit(); // Terminer le script après la redirection
                } else {
                    $message = "Erreur lors de la modification de l'idée";
                }
            } else {
                $message = "Identifiant de l'idée non spécifié";
            }
        } else {
            $message = "Veuillez remplir tous les champs !";
        }
    }

    // Pré-remplir les champs du formulaire si l'idée à modifier est spécifiée
    if(isset($_GET['id'])){
        // Inclure le fichier de connexion à la base de données
        include_once "connexion.php";
        // Requête pour récupérer les données de l'idée à modifier
        $stmt = $con->prepare("SELECT titre, description, statut FROM idee WHERE id = ?");
        // Liaison des paramètres
        $stmt->bind_param("i", $_GET['id']);
        // Exécution de la requête
        $stmt->execute();
        // Récupération des résultats
        $stmt->bind_result($titre, $description, $statut);
        // Fetching du résultat
        $stmt->fetch();
        // Fermeture de la requête
        $stmt->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form">
        <a href="index.php" class="back_btn"><img src="images/back.png"> Retour</a>
        <h2>Modifier une idée</h2>
        <p class="erreur_message">
            <?php 
                // Si la variable message existe, affichons son contenu
                if(isset($message)){
                    echo $message;
                }
            ?>
        </p>
        <form action="" method="POST">
            <label>Titre</label>
            <input type="text" name="titre" value="<?php echo isset($titre) ? $titre : ''; ?>">
            <label>Description</label>
            <textarea name="description" id="" cols="30" rows="10"><?php echo isset($description) ? $description : ''; ?></textarea>
            <label>Statut</label>
            <input type="text" name="statut" value="<?php echo isset($statut) ? $statut : ''; ?>">
            <input type="submit" value="Modifier" name="button">
        </form>
    </div>
</body>
</html>
