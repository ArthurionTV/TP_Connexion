<?php

$userDao = new UserDao($db);
$tab = $userDao->getAll();

?>