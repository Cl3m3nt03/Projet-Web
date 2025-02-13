<?php session_start(); ?> 
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tableau des Scores</title>
        <link href="assets/css/scores.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <main>
        <?php require 'header.php'; ?>

        <div class="title">
            <h2>Tableau des Scores</h2>
        </div>    

        <form method="GET" action="">
            <label for="search">Rechercher :</label>
            <input type="text" id="search" name="search" placeholder="Entrez un pseudo">
            <button type="submit">Rechercher</button>
        </form>

            <?php
                
                include 'database.php';

                $db = db_connect(); 

                $search = isset($_GET['search']) ? $_GET['search'] :'';

                $id_joueur_connecte = $_SESSION['pseudo'] ?? null;
                if (!$id_joueur_connecte){
                    echo "ERROR!!! --> le pseudo du joueur connecté n'est pas défini";
                }
                
                $query = "SELECT score.id_jeu, user.pseudo AS nom_joueur, score.difficulte_partie,
                    score.temps, score.date_heure_partie
                FROM score
                JOIN user ON score.id_joueur = user.id";
                
                if ($search) {
                    $query .= " WHERE user.pseudo LIKE :search";
                }

                $stmt = $db->prepare($query);

                if ($search){
                    $stmt->bindValue(':search', '%' . $search .'%', PDO::PARAM_STR);
                }

                $stmt->execute();

                echo'<table>
                        <thead>
                            <tr>
                                <th>Nom du jeu</th>
                                <th>Nom du joueur</th>
                                <th>Difficulté de la partie</th>
                                <th>Score de la partie</th>
                                <th>Date et heure</th>
                            </tr>
                        </thead>
                    <table>';
                $niveau = 'Niveau ';
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $highlight_class = (isset($row['nom_joueur']) && $row['nom_joueur'] == $id_joueur_connecte) ? 'highlight' : '';
                    echo '<tr class = "' . $highlight_class . '">
                            <td>' . htmlspecialchars($row['id_jeu']) . '</td>
                            <td>' . htmlspecialchars($row['nom_joueur']) . '</td>
                            <td>' . $niveau . htmlspecialchars($row['difficulte_partie']) . '</td>
                            <td>' . htmlspecialchars($row['temps']) . '</td>
                            <td>' . htmlspecialchars($row['date_heure_partie']) . '</td>
                        </tr>';
                }    
                    
                
            ?>
            
            </table>
        </main>

        <?php require 'footer.php'; ?>
    </body>
</html>
