<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application CRUD</title>
    <style>


.acceuil{
    color: #E35F0F;
}
        .headers {
            
    height: 100vh; /* Utilisation de la hauteur de l'écran */
    background-image: url(images/Rectangle\ 1.png);
    background-size: 100%;
    background-position: center; /* Centrage de l'image */
    background-repeat: no-repeat; /* Empêcher la répétition de l'image */
        }
       .container1 img {
    height: 25px;
   width: 20px;
}
        /* Styles CSS */
        .color-orange{color:  #E35F0F;}
        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
            margin: 0;
            padding: 0;
        }
       
        #realisations{
            background-image: url(images/Rectangle\ 23940.png);
            color: #E35F0F;
            text-align: center;
            padding: 20px;
            font-size: 30px;
        }
        .container1{
            background-color: #0AE2C5;
            gap: 100px;
            display: block;
            align-items: center;
            justify-content: space-around;
            padding: 20px
        }
        .container1 p{
        color: #fff;
            padding: 10px;
        }
        .container1 img{
            width: 20px;
            height: 20px;
            border-radius: 22px;
            margin-right: 20px;
        }
    
.logo{float: left;
padding-left: 20%;
margin-top: -15px;
}
        .headers {
            
            display:flex;
            justify-content:space-between;
            align-items:center;
    position: relative; /* Assure que les éléments absolus dans .headers se réfèrent à .headers */
    height: 70vh; /* Utilisation d'une hauteur en pourcentage pour la réactivité */
    padding: 20px; /* Ajout de marge intérieure pour le titre */
    color: #fff; /* Couleur du texte */
    overflow: hidden; /* Empêche le débordement de l'élément flou */}

.headers::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url(images/Rectangle\ 1.png);
    background-size: cover;
    z-index: -1; /* Placez le pseudo-élément derrière le contenu principal */
}

h1 {
            width: 80%;
            text-align: left;
            font: size 30px;;
            background-position: center;
            color:  #E35F0F; /* Couleur du texte */
            padding: 20px; /* Ajout de marge intérieure pour le titre */
        }
     .headers   h1 {
            width: 80%;
            text-align: left;
            font: size 30px;;
            background-position: center;
            color:  #fff; /* Couleur du texte */
            padding: 20px; /* Ajout de marge intérieure pour le titre */
        }
        p { font-size:18px;
            margin-bottom: 10px;
        }
      



nav {
    top: 0;
    left: 0;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.9);
    color: #fff;
    padding: 20px 0; /* Augmenter la hauteur */
    text-align: center;
    z-index: 999; /* Assure que le navbar est au-dessus du reste du contenu */
}

        nav a {
            color: #0AE2C5;
            text-decoration: none;
            margin: 0 10px;

        }
        .menu-icon {
            display: none; /* Cacher par défaut sur les écrans larges */
        }
        .logo img{
            display: inline-block;
            margin-right: 20px;
            width: 100px;
        }
        
       
        
        
        
    </style>
</head>
<body>
    <nav> 
        <div class="logo"><img src="images/logo-simplonSenegal-1-e1647016201426.png" alt="Logo"></div>
        <span class="menu-icon">&#9776;</span>

        <a href="index.php">Acceuil</a>
        <a href="liste.php">liste des utilisateurs</a>
        <a href="ajouter.php">ajout d'idee</a>
        <a href="modifier.php">Modification d'idee</a>
        <a href="index.php">Deconnexion</a>
    </nav>
    <div class="container" id="presentation">
    <div class="headers">
        <h1><span class = "acceuil">Bienvenue dans notre plateforme ! </span><br>Notre application CRUD a été spécialement conçue pour simplifier la gestion de vos données en vous offrant une interface conviviale pour créer, lire, mettre à jour et supprimer des éléments en toute simplicité. Que vous soyez novice dans la manipulation de données ou un utilisateur expérimenté, nous sommes là pour vous guider à travers chaque étape du processus. Explorez nos fonctionnalités intuitives et découvrez comment notre application peut vous aider à gérer efficacement vos informations.</h1>
    </div>
        <div class="container1">
            <p><span class="color-orange">
            <h1>Titre</h1>    
            <p>Bienvenue dans notre plateforme  !

Notre application CRUD a été spécialement conçue pour simplifier la gestion de vos données en vous offrant une interface conviviale pour créer, lire, mettre à jour et supprimer des éléments en toute simplicité.

Que vous soyez novice dans la manipulation de données ou un utilisateur expérimenté, nous sommes là pour vous guider à travers chaque étape du processus. Explorez nos fonctionnalités intuitives et découvrez comment notre application peut vous aider à gérer efficacement vos informations.</p>
            <h2>Status</h2> 
            <a href="supprimer.php"><img src="images/trash.png"></a>    
</div>
            
    <div class="container" id="realisations">
        <h2>Voici la liste des idees:</h2>
        </div>

        <?php 
                //inclure la page de connexion
                include_once "connexion.php";
                //requête pour afficher la liste des idee
                $req = mysqli_query($con , "SELECT * FROM idee");
                if(mysqli_num_rows($req) == 0){
                    //s'il n'existe pas d'idee dans la base de donné , alors on affiche ce message :
                    echo "Il n'y a pas encore d'idee ajouter !" ;
                    
                }else {
                    //si non , affichons la liste de tous les idee
                    while($row=mysqli_fetch_assoc($req)){
                        ?>
                        

            <div class="container1">
            <h1>Titre :<?=$row['titre']?></h1>    
            <p>Description :<?=$row['description']?></p>
            <h2>Statut :<?=$row['statut']?></h2>   
            <a href="supprimer.php?id=<?=$row['id']?>"><img src="images/trash.png"></a>
            <a href="modifier.php?id=<?=$row['id']?>"><img src="images/pen.png"></a>         
            </div>
            <h2>.</h2>
            
                        <?php
                    }
                    
                }
            ?>
</body>
</html>