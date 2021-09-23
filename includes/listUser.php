<!DOCTYPE html>
<html lang="fr">

<?php
session_start();
include '../config/autoload.php';
include './connexion_bdd.php';
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="./index.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste</title>
</head>

<?php
include "nav.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    //parcourir le tableau ListUser en tant que variable "key" en prennant la valeur de i
    foreach ($_SESSION["ListUser"] as $key => $i) {
        // algo de suppression
        if (isset($_POST["supp"])) {
            //suppression de l'utilisateur
            $userDao->delete($_POST["supp"]);
            // récup du tab utilisateur à jour
            $tab = $userDao->getAll();
        }
    }
}
?>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Mail</th>
                <th scope="col">Pseudo</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            //parcourir le tableau ListUser en tant que variable "cle" en prennant la valeur de i
            foreach ($_SESSION["ListUser"] as $value->getId() => $i) {
                if ($_SESSION["ListUser"][$value->getId()] === $_SESSION["user"]) {
            ?>
                    <tr> <!-- Permet de mettre en couleur la session sur laquelle nous sommmes connecté -->
                        <td class="table-success"><?php echo $value->getMail(); ?></td>
                        <td class="table-success"><?php echo $value->getPseudo(); ?></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td><?php echo $value->getMail(); ?></td>
                        <td><?php echo $value->getPseudo(); ?></td>
                        <td>
                            <form method="GET">
                                <input type="hidden" name="<?php echo $value->getId() ?>">
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</body>

</html>