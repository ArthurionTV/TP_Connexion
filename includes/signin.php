<!DOCTYPE html>
<html lang="fr">

<?php
session_start();
include '../config/autoload.php';
include './connexion_bdd.php';
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Connexion</title>
</head>

<body>
    <h1 id="h1">Connexion</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse Mail</label>
            <input type="text" class="form-control" name="email1" id="exampleInputEmail1" aria-describedby="emailHelp">
            <br>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" name="password1" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">rester connecté</label>
        </div>
        <button type="submit" class="btn btn-primary">connexion</button>
    </form>
    <p>Pas de compte ? <a href="./signup.php">inscrivez-vous</a></p>
    <p>Envie de <a href="./index.php">Revenir à l'accueil</a> ?</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>

<?php
$UserDao = ($User);
//initialiser le tableau $tab et récupérer tous les utilisateurs de la BDD
$tab = $UserDao->getAll();
// envois de la requête serveur
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // check si les champs sont remplis
    if (!empty($_POST["email1"]) && !empty($_POST["password1"])) {
        // on déclare vide la variable d'erreur                        
        $error = "";
        // comparer mail                                         
        if ($_POST["email1"] === $tab[$i]->getMail()) {
            // verifier mdp                      
            if (password_verify($_POST["password1"], $tab[$i]->getPassword())) {
                // si la session est valide on se connecte dessus
                $_SESSION["auth"] = true;
                $user = new User($tab[$i]);
                $_SESSION["user"] = serialize($user);
                // renvoie sur la page d'accueil 
                header("Location: ./index.php");
            } else {
                $error = "Mauvais mot de passe";  // message d'erreur
                
            }
        } else {
            $error = "Le Mail est invalide";  // message d'erreur
        }
    } else {
        $error = "Veuillez remplir tous les champs";  // message d'erreur
    }
}
if (!empty($error)) {
    echo "<script type='text/javascript'>alert('$error');</script>";
}
?>