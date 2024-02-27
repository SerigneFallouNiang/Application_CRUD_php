<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Idee</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <a href="ajouter.php" class="Btn_add"><img src="images/plus.png" alt="">Ajouter</a>

        <table>
            <tr id="items">
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            <?php 
//inclure la page de connexion
include_once "connexion.php";
//requete pour afficher la liste des employés
$req =mysqli_query($con ,"SELECT * FROM Employe");
if(mysqli_num_rows($req) == 0){
    //s'il n'existe pas d'employé dans la base de donné , alors on affiche ce message
    echo "il n'y a pas encore d'employénajouter";
}else{
    //si non , affichons la liste de tous les employés
    while($row = mysqli_fetch_array($req)){
        ?>
        <tr>
            <td><?=$row['nom']?></td>
            <td><?=$row['prenom']?></td>
            <td><?=$row['age']?></td>
<!-- nous alons mettre l'id de chaque employé dans ce lien -->
<td><a href="modifier.php?id=<?=$row['id']?>"><img src="images/pen.png" alt=""></a></td>  
<td><a href="supprimer.php?id=<?=$row['id']?>"><img src="images/trash.png" alt=""></a></td>     
</tr>
<?php
    }
}
?>

            
        </table>
    </div>
</body>
</html>