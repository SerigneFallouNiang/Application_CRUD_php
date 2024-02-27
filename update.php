<?php
/* Inclure le fichier de configuration */
require_once "config.php";
 
/* Définir les variables */
$titre = $description = $statut = "";
$titre_err = $description_err = $statut_err = "";
 
/* Vérifier si le paramètre id existe dans la méthode POST pour la mise à jour */
if(isset($_POST["id"]) && !empty($_POST["id"])){
    /* Récupération de la valeur de l'identifiant depuis le champ caché */
    $id = $_POST["id"];
    
    /* Valider le titre */
    $input_titre = trim($_POST["titre"]);
    if(empty($input_titre)){
        $titre_err = "Veuillez entrer un titre.";
    } else{
        $titre = $input_titre;
    }
    
    /* Valider la description */
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Veuillez entrer une description.";     
    } else{
        $description = $input_description;
    }
    
    /* Valider le statut */
    $input_statut = trim($_POST["statut"]);
    if(empty($input_statut)){
        $statut_err = "Veuillez entrer un statut.";     
    } else{
        $statut = $input_statut;
    }
    
    /* Vérifier les erreurs avant la modification */
    if(empty($titre_err) && empty($description_err) && empty($statut_err)){
        
        $sql = "UPDATE idee SET titre=?, description=?, statut=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "sssi", $param_titre, $param_description, $param_statut, $param_id);
            
            $param_titre = $titre;
            $param_description = $description;
            $param_statut = $statut;
            $param_id = $id;
            
            if(mysqli_stmt_execute($stmt)){
                /* Enregistrement modifié, rediriger */
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Une erreur est survenue.";
            }
        }
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    /* Si aucun paramètre id n'est fourni, afficher l'enregistrement à modifier */
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        
        $id =  trim($_GET["id"]);
        
        $sql = "SELECT * FROM idee WHERE id = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            $param_id = $id;
            
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
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Une erreur est survenue.";
            }
        }
        
        mysqli_stmt_close($stmt);
        
        mysqli_close($link);
    }  else{
        /* Si aucun id valide n'est fourni, rediriger vers une page d'erreur */
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier l'enregistrement</title>
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
                    <h2 class="mt-5">Mise à jour de l'enregistrement</h2>
                    <p>Modifier les champs et enregistrer</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Titre</label>
                            <input type="text" name="titre" class="form-control <?php echo (!empty($titre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $titre; ?>">
                            <span class="invalid-feedback"><?php echo $titre_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Statut</label>
                            <input type="text" name="statut" class="form-control <?php echo (!empty($statut_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $statut; ?>">
                            <span class="invalid-feedback"><?php echo $statut_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
