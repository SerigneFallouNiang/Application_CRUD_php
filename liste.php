<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>liste utilisateur</title>
</head>
<style>
    ul{
        background-color: aqua;
    }
    body{
        background-color: aqua;   

    }
</style>
<body>
    
</body>
</html><?php
// Inclusion du fichier de connexion à la base de données
include_once "connexion.php";

// Requête pour récupérer la liste des utilisateurs
$query = "SELECT * FROM utilisateur";
$result = mysqli_query($con, $query);

// Vérification si la requête a réussi
if ($result) {
    // Affichage de la liste des utilisateurs
    echo "<h2>Liste des Utilisateurs :</h2>";
    echo "<ul>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<li>".$row['prenom']." ".$row['nom']." - ".$row['email']."</li>";
    }
    echo "</ul>";
} else {
    echo "Erreur lors de la récupération des utilisateurs.";
}

// Fermeture de la connexion à la base de données
mysqli_close($con);
?>
