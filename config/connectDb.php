<?php

//Constantes pour la base de données
const DBS_HOST = 'localhost';
const DBS_BASE = 'tp_connexion';
const DBS_USER = 'root';
const DBS_PASS = 'sangohan';

function connectDBS()
{
  //Connexion à la base de données
  try {
    $bdd = new PDO(
      'mysql:host=' . DBS_HOST . ';
            dbname=' . DBS_BASE .
        ';charset=utf8',
      DBS_USER,
      DBS_PASS,
      array(PDO::ATTR_ERRMODE =>
      PDO::ERRMODE_EXCEPTION)
    );
    return $bdd;
  } catch (PDOException $err) {
    $msg = 'ERREUR PDO dans ' . $err->getFile() .
      ' L.' . $err->getLine() . ' : ' .
      $err->getMessage();
    die($msg);
  }
}

?>