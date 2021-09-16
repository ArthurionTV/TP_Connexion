<?php

include './connexion_bdd.php';
include '../config/autoload.php';

?>

<head>
    <link rel="stylesheet" href="./index.css">
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#toggler" aria-controls="toggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="toggler">
            <div class="d-flex">
                <a href="./index.php"><button class="btn btn-secondary" id="btna" type="button">Accueil</button></a>
                <a href="./profil.php"><button class="btn btn-outline-primary" id="btn" type="button">Profil</button></a>
                <a href="./listUser.php"><button class="btn btn-outline-primary" id="btn" type="button">Liste</button></a>
                <form method="GET">
                    <input type="hidden" name="deco">
                    <button type="submit" id="btn" class="btn btn-outline-danger">déconnexion</button>
                </form>
            </div>
        </div>
    </div>
</nav>

<?php
// algorithme de déco
if (isset($_GET["deco"])) {  
    $_SESSION["auth"] = false;
    header("Location: ./signin.php");
}
?>