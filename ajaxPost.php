<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL); // Afficher toutes les erreurs PHP

require 'database.php';

$json = file_get_contents("php://input");

$data = json_decode($json, true);

if (isset( $data['temps'], $data['dateHeure'], $data['difficulte'], $data['id_jeu'])) {
    $id_joueur = $_SESSION['id'];
    $score = $data['temps'];
    $dateHeure = $data['dateHeure'];
    $difficulte = $data['difficulte'];
    $id_jeu = $data['id_jeu'];

    $pdo = db_connect();

    $stmt = $pdo->prepare("INSERT INTO score (id_joueur, temps, date_heure_partie, difficulte_partie, id_jeu) VALUES (:id_joueur, :temps, :dateHeure, :difficulte, :id_jeu)");
    $stmt->bindParam(':id_joueur', $id_joueur);
    $stmt->bindParam(':temps', $score);
    $stmt->bindParam(':dateHeure', $dateHeure);
    $stmt->bindParam(':difficulte', $difficulte);
    $stmt->bindParam(':id_jeu', $id_jeu);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Temps enregistré avec succès']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'enregistrement du score']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Données manquantes']);
}
?>
