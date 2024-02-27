<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 d-flex justify-content-between">
                        <h2 class="pull-left">Liste des idées</h2>
                        <a href="create.php" class="btn btn-success"><i class="bi bi-plus"></i> Ajouter</a>
                    </div>
                    <?php 
                        // Inclure le fichier de configuration
                        require_once "config.php";
                        
                        // Requête SQL pour récupérer les données de la table "idee" avec les données liées de la table "utilisateur"
                        $sql = "SELECT idee.id, idee.titre, idee.description, idee.statut, utilisateur.nom AS nom_utilisateur FROM idee JOIN utilisateur ON idee.id_utilisateur = utilisateur.id";
                        
                        if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                echo '<table class="table table-bordered table-striped">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>titre</th>";
                                            echo "<th>description</th>";
                                            echo "<th>statut</th>";
                                            echo "<th>proposé par</th>";
                                            echo "<th>Action</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['titre'] . "</td>";
                                            echo "<td>" . $row['description'] . "</td>";
                                            echo "<td>" . $row['statut'] . "</td>";
                                            echo "<td>" . $row['nom_utilisateur'] . "</td>";
                                            echo "<td>";
                                                echo '<a href="read.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-eye"></span></a>';
                                                echo '<a href="update.php?id='. $row['id'] .'" class="me-3" ><span class="bi bi-pencil"></span></a>';
                                                echo '<a href="delete.php?id='. $row['id'] .'" ><span class="bi bi-trash"></span></a>';
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";
                                // Libérer le jeu de résultats
                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>Aucun enregistrement trouvé</em></div>';
                            }
                        } else{
                            echo "Oops! Une erreur est survenue";
                        }
                     
                        // Fermer la connexion
                        mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
