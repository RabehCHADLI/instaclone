<?php
//COMPTER LE NB DE LIKES



//AFFICHER LE NB DE LIKES
$prepareRequest = $connexion->prepare(
    'SELECT * FROM `post` ORDER BY `post`.`like`'
);

$prepareRequest->execute();

$like = $prepareRequest->fetchAll(PDO::FETCH_ASSOC);


