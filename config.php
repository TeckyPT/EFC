<?php
// Informations d'identification
define('DB_SERVER', 'localhost:3307');
define('DB_USERNAME', 'tecky');
define('DB_PASSWORD', 'tecky');
define('DB_NAME', 'hotel');
 
// Connexion � la base de donn�es MySQL 
$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// V�rifier la connexion
if($conn === false){
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}
?>

