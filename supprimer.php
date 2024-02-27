<?php
//connexion à la base de donnéés
include_once "connexion.php";
//récupération de l'id dans le lien
$id= $_GET['id'];
//requete de suppression
$req = mysqli_query($conn , "DELETE FROM    employe WHERE id = $id");
//reduction vers la page index.php
header("Location:index.php");
?>