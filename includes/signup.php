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
    <title>Inscription</title>
</head>

<body>
    <h1>Création de compte</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nom d'utilisateur</label>
            <input type="username" class="form-control" name="username1" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Adresse Mail</label>
            <input type="text" class="form-control" name="email1" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Mot de Passe</label>
            <input type="password" class="form-control" name="password1" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirmez Mdp</label>
            <input type="password" class="form-control" name="password2" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button> <a href="./index.php">Revenir à l'accueil</a>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

</html>

<?php
// requête serveur 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //  on vérifie si les champs sont remplis
    if (!empty($_POST["email1"]) && !empty($_POST["password1"]) && !empty($_POST["password2"])) {
        $mailValid = true;
        // on vérifie avec la méthode si l'email est correctement écris ("@" et ".fr" par exemple)
        if (filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL)) {
            //  on parcour le tableau pour ensuite vérifier si l'émail existe déjà
            foreach ($_SESSION["ListUser"] as $i) {
                if (in_array($_POST["email1"], $i)) {
                    $mailValid = false;
                    $error = "Mail déjà utilisé";
                    break;
                }
            }
            // si l'email est valide et disponible, on vérifie ensuite les mots de passes 
            if ($mailValid == true) {
                if ($_POST["password1"] === $_POST["password2"]) {
                    // si l'email est valide et les 2 mdp identiques alors les données sont stockés dans le tableau "ListUser"
                    array_push($_SESSION["ListUser"], [$_POST["email1"], password_hash($_POST["password1"], PASSWORD_DEFAULT), htmlspecialchars($_POST["username1"])]);
                    // redirection à la page d'accueil
                    header("Location: ./index.php");
                } else {
                    $error = "Les mots passe de correspondent pas";  // message d'erreur
                }
            }
        } else {
            $mailValid = false;
            $error = "Mail invalide";  // message d'erreur
        }
    } else {
        $error = "Tous les champs ne sont pas remplis";  // message d'erreur
    }
}
if (!empty($error)) {
    echo "<script type='text/javascript'>alert('$error');</script>";
}

//var_dump($_SESSION['ListUser']);
//var_dump($_SESSION["user"]);

//unset($_SESSION["ListUser"]);
//unset($_SESSION["user"]);
?>