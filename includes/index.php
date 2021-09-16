<!DOCTYPE html>
<html lang="fr">

<?php
session_start();  
?>

<head>
    <!-- lier bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lier le CSS -->
    <link rel="stylesheet" href="./index.css">  
    <title>Bienvenue</title>
</head>

<?php
// inclure la barre nav (boutons) en haut de la page 
include "nav.php";   

// Si aucune variable de session auth, on l'a crée à la valeur false
if (!isset($_SESSION["auth"])) {
    $_SESSION["auth"] = false;
}

// Si l'on n'est pas connecté à un compte, on redirige vers la connexion
if ($_SESSION["auth"] == false) {
   header("Location: ./signin.php");   
}

// Si il existe un tableau "user" dans le tableau session, le stocker dans $tab
if (isset($_SESSION["ListUser"])) {
    $tab = $_SESSION["ListUser"];
} else {  // S'il n'existe pas, on le crée
    $tab = [];
    $_SESSION["ListUser"] = $tab;  // Stockage de $tab en session
}
?>

<body>            <!-- on affiche la case la valeur 2 de la clé "user" -->         
    <h1>Bienvenue <?php echo htmlspecialchars($_SESSION["user"][2]); ?> !</h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>