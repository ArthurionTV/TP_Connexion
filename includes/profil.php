<!DOCTYPE html>
<html lang="fr">

<?php
session_start();
include '../config/autoload.php';
include './connexion_bdd.php';
include '../config/config.php';
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>Profil</title>
</head>

<?php
include "nav.php";

//Récupération de l'objet user en session
$user = unserialize($_SESSION["user"]);
$error = "";
$User = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!empty($_POST["username1"]) && !empty($_POST["email1"])) {
        if (filter_var($_POST["email1"], FILTER_VALIDATE_EMAIL)) {
            //s'il n'y a pas d'erreur de mot de passe, on update

            if (empty($error)) {
                $User["pseudo"] = $_POST['username1'];
                $User["mail"] = $_POST['email1'];
            }
            // Si les mots de passe ne sont pas vides
            if ($_POST["password"] != "" && $_POST["passwordConfirm"] != "") {
                //Si les mots de passe correspondent
                if ($_POST["password"] == $_POST["passwordConfirm"]) {
                    // on stock le mot de passe dans $user[1]
                    $User["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    // Sinon
                } else {
                    // on stock un message d'erreur
                    $errorMdp = "Les mots de passe ne correspondent pas";
                    //fin si
                }
                // Sinon
            } else {
                // on stock le mot de passe de session dans $user[1]
                $User["password"] = $user->getPassword();
                //fin si
            }
            if ($error == "") {
                // on ajoute l'id au tableau utilisateur temporaire
                $User["id"] = $user->getId();
                // on instancie un nouvel utilisateur
                $userUpdate = new User($user);
                // on update l'utilisateur
                $userDao->update($userUpdate);
                // on met à jour $User pour l'affichage
                $user = $userUpdate;
                // on met à jour l'utilisateur dans la session
                $_SESSION["user"] = serialize($userUpdate);
            }
        } else {
            $error = "Mail invalide";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}
if (!empty($error)) {
    echo "<script type='text/javascript'>alert('$error');</script>";
}
?>

<body>
    <h1>Votre Profil</h1>
    <form method="POST">
        <div class="mb-3">
            <label for="exampleInputEmail1" id="disline" class="form-label">Nom d'utilisateur</label>
            <input type="text" class="form-control" name="username1" value="<?php echo htmlspecialchars($user->getpseudo()); ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" id="disline" class="form-label">Adresse Mail</label>
            <input type="text" class="form-control" name="email1" value="<?php echo $user->getMail(); ?>" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password">Nouveau mdp</label>
            <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
            <label for="passwordConfirm">Confirmez mdp</label>
            <input type="password" name="passwordConfirm" class="form-control" id="passwordConfirm">
        </div>
        <button type="submit" id="btnmodif" class="btn btn-primary">modifier et enregistrer</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>

<?php
//var_dump($_SESSION["user"]);
//var_dump($_SESSION["ListUser"]);
?>

</html>