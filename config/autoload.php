<?php

function chargerClasse($classe)
{
    require_once "../class/" . $classe . ".php";
}

//on enregistre la fonction en autoload pour qu'elle soit 
//appelée dès qu'on instanciera une classe non déclarée.
spl_autoload_register('chargerClasse');

?>