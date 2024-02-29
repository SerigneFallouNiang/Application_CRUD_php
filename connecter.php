


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
                $select = mysqli_query($con,"SELECT * FROM utilisateur where email ='$email' AND password = '$password'");
                $row = mysqli_fetch_array($select);
                if($row){//si la requête a été effectuée avec succès , on fait une redirection
                    header("location: index.php");
                }else {//si non
                    $message = "utilisateur  non trouvé";
                }
              
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
            <input type="submit" value="S'inscrire" name="button">
        </form>
    </div>
</body>
</html>






