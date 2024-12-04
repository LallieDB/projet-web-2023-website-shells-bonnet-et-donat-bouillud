<?php
//connect
try {
    $bdd = new PDO("mysql:host=localhost;dbname=coquill'coin;charset=utf8", "Coquillage2", "Coquillage", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch (Exception $e) {
    die('Erreur fatale : ' . $e->getMessage());
} ?>