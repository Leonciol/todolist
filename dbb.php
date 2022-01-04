<?php
// Informations d'identification
const DB_SERVER= 'localhost';
const DB_USERNAME= 'root';
const DB_PASSWORD= 'oui';
const DB_NAME= 'plub';

$db = null;
// Connexion à la base de données MySQL
try {
    $db = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME.';charset=utf8', DB_USERNAME, DB_PASSWORD);
}catch(Exception $e){
    echo 'Erreur'.$e->getMessage().'\n';
}