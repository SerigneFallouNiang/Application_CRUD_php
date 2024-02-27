<?php
/* Inclure le fichier config */
require_once "config.php";
 
/* Définir les variables */
$titre = $description = $statut = "";
$titre_err = $description_err = $statut_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
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
    
    /* Vérifier les erreurs avant l'enregistrement */
    if(empty($titre_err) && empty($description_err) && empty($statut_err)){
        /* Préparer une déclaration d'insertion */
        $sql = "INSERT INTO idee (titre, description, statut) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            /* Lier les variables à la déclaration préparée en tant que paramètres */
            mysqli_stmt_bind_param($stmt, "sss", $param_titre, $param_description, $param_statut);
            
            /* Définir les paramètres */
            $param_titre = $titre;
            $param_description = $description;
            $param_statut = $statut;
            
            /* Exécuter la déclaration */
            if(mysqli_stmt_execute($stmt)){
                /* Opération réussie, redirection vers la page d'accueil */
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Une erreur est survenue.";
            }
        }
         
        /* Fermer la déclaration */
        mysqli_stmt_close($stmt);
    }
    
    /* Fermer la connexion */
    mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Créer un enregistrement</title>
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
                    <h2 class="mt-5">Créer un enregistrement</h2>
                    <p>Remplissez le formulaire pour enregistrer une idée dans la base de données</p>


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
                        <input type="submit" class="btn btn-primary" value="Enregistrer">
                        <a href="index.php" class="btn btn-secondary ml-2">Annuler</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
