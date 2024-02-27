<?php require_once "config.php" ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./style.css">
    <title>formulaire</title>
</head>

<body>
    <h1>Inscrivez vous:</h1>

    <div class="container">

    <h1>Application CRUD</h1>



<input type="text" name = "nom" placeholder="indiquez votre nom"> <br>

<input type="text" name = "prenom" placeholder="indiquez votre prenom"> <br>


<input type="email" name ="email" placeholder="indiquez votre e-mail"><br>

<input type="password" name ="password" placeholder="indiquez votre mot de passe"><br>



<input type="submit" value="envoyer" name ="envoyer">

</form>
    </div>
</body>
</html>