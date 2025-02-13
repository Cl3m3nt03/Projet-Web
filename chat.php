<?php


require_once 'database.php';
  
$db = db_connect();



if (!isset($_SESSION['id'])) {
    header('Location: connexion.php');
    exit();
}


$id_expediteur = $_SESSION['id'];


if (isset($_POST['message']) && !empty($_POST['message'])) {
    $message = trim($_POST['message']);   
    $query = $db->prepare("INSERT INTO message (id_jeu, id_expediteur, message, date_heure_message) VALUES (1, ?, ?, NOW())");
    $query->execute([$id_expediteur, $message]); 
    
    header('Location: memory.php');
} 


//24H 
try {
    
    $query = $db->prepare("SELECT m.message, m.date_heure_message, u.pseudo , m.id_expediteur
                           FROM message m
                           INNER JOIN user u ON m.id_expediteur = u.id
                           WHERE m.date_heure_message >= NOW() - INTERVAL 1 DAY
                           ORDER BY m.date_heure_message ASC");
    $query->execute();
    $messages = $query->fetchAll(PDO::FETCH_ASSOC);  // Récupére msg sous forme de tableau associatif
} catch (PDOException $e) {
    echo "Erreur de récupération des messages : " . $e->getMessage();
    exit();
}
?>



<?php

$api_url = 'https://api.thecatapi.com/v1/images/search?mime_types=gif';
$response = file_get_contents($api_url); 
$data = json_decode($response, true); 


if (isset($data[0]['url'])) {
    $gif_url = $data[0]['url']; 
} else {
   
    $gif_url = 'https://media.giphy.com/media/JIX9t2j0ZTN9S/giphy.gif'; 
}
?>