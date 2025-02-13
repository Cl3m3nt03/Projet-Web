<?php
session_start();
session_unset(); // Supprime toutes les variables 
session_destroy(); 
header('Location: connexion.php'); 
exit();
?>