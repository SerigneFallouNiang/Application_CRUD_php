<?php
/* Vérifier si le paramètre id existe */
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "config.php";
    
    /* Préparer la requête */
    $sql = "SELECT * FROM idee WHERE id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Récupérer l'enregistrement */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                /* Récupérer les champs */
                $titre = $row["titre"];
                $description = $row["description"];
                $statut = $row["statut"];
            } else{
                /* Si aucun id correspondant, redirige vers la page d'erreur */
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Une erreur est survenue.";
        }
    }
    
    mysqli_stmt_close($stmt);
    
    mysqli_close($link);
} else{
    /* Si aucun id correct n'est fourni, redirige vers la page d'erreur */
    header("location: error.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Voir l'enregistrement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .wrapper{
            width: 700px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">Voir l'enregistrement</h1>
                    <div class="form-group">
                        <label>Titre</label>
                        <p><b><?php echo $titre; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $description; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Statut</label>
                        <p><b><?php echo $statut; ?></b></p>
                    </div>
                    <p><a href="index.php" class="btn btn-primary">Retour</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
