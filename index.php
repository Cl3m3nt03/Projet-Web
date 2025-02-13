<!DOCTYPE html>
<html lang="fr">

    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Memories Game</title>
        <link href="assets/css/index.css" rel="stylesheet">
    </head>

    <body>

        <?php
        session_start(); // Placez ceci uniquement ici, tout en haut du fichier PHP
        require 'header.php'; // Inclure le header si nécessaire
        ?>

        <input type="hidden" id="hiddenIdJoueur" value="<?php echo $_SESSION['id']; ?>">

        <div class="container_acceuil">
            <div class="sub-title">
                <?php if (isset($_SESSION['pseudo'])): ?>
                <h1 class="sub-title">Bonjour, <?php echo htmlspecialchars($_SESSION['pseudo']); ?>!</h1>
            <?php else: ?>
            <?php endif; ?>
            </div>
            

            <h1 class="main-title">BIENVENUE DANS NOTRE STUDIO !</h1>
            <h2 class="sub-title">Venez challenger les cerveaux les plus agiles !</h2>
            <div class="container-bouton">
                <?php
                if (isset($_SESSION['id'])) {
                    echo '<a href="memory.php" class="bouton-jouer"> JOUER !</a>';
                } else {
                    echo '<a href="connexion.php" class="bouton-jouer"> JOUER !</a></a>';
                }
            ?>
                
            </div>

            <img class = "bulle" src="assets/images/Text Bubbles.png" alt="bulle" />
            <img class = "mascotte" src="assets/images/Burgerpants_face_3.webp" alt="mascotte" />
            <p class = "dialogue"> Hey!</p>
            
            

           
            
                
            

        </div>
        <div class="comment_jouer">
            <p>Comment jouer ?</p>
        </div>
        <section>
            <div class="transparent-box">
                <div class="item">
                    <div class="title">
                        <p>Comment Jouer ?</p>
                    </div>
                    <img src="assets/images/comment-jouer.webp" alt="random image 1" />
                    <p>Le principe est simple : retourne les cartes et associe les paires identiques.
                        Chaque niveau devient plus difficile, alors concentre-toi et essaye de battre
                        ton meilleur score ! Prêt à relever le défi ?</p>
                </div>
                <div class="item">
                    <div class="title">
                        <p>Un défi pour la mémoire</p>
                    </div>
                    <img src="assets/images/memoire.jpg" alt="random image 2" />
                    <p>Le jeu de memory est idéal pour entraîner ton cerveau tout en t'amusant.
                        Améliore ta concentration, teste tes capacités de mémorisation et avance à
                        travers des niveaux de plus en plus complexes.</p>
                </div>
                <div class="item">
                    <div class="title">
                        <p>Des niveaux progressifs</p>
                    </div>
                    <img src="assets/images/niveaux-progressifs.webp" alt="random image 3" />
                    <p>Chaque niveau que tu franchis te rapproche du titre de maître du memory.
                        Plus tu progresses, plus le défi augmente. Seras-tu capable de battre
                        tous les niveaux dans cette ambiance ?</p>
                </div>
            </div>
        </section>

        <div class="score">

            <?php
                include 'database.php';
                $db = db_connect();

                $queryParties = "SELECT COUNT(*) AS total_parties FROM score";
                $stmtParties = $db->prepare($queryParties);
                $stmtParties->execute();
                $totalParties = $stmtParties->fetch(PDO::FETCH_ASSOC)['total_parties'];

                $queryConnectes = "SELECT COUNT(*) AS joueurs_connectes FROM user";
                $stmtConnectes = $db->prepare($queryConnectes);
                $stmtConnectes->execute();
                $joueursConnectes = $stmtConnectes->fetch(PDO::FETCH_ASSOC)['joueurs_connectes'];

                $queryMeilleurScore = "SELECT MAX(temps) AS meilleur_score FROM score";
                $stmtMeilleurScore = $db->prepare($queryMeilleurScore);
                $stmtMeilleurScore->execute();
                $meilleurScore = $stmtMeilleurScore->fetch(PDO::FETCH_ASSOC)['meilleur_score'];

                $queryJoueursInscrits = "SELECT COUNT(*) AS joueurs_inscrits FROM user";
                $stmtJoueursInscrits = $db->prepare($queryJoueursInscrits);
                $stmtJoueursInscrits->execute();
                $joueursInscrits = $stmtJoueursInscrits->fetch(PDO::FETCH_ASSOC)['joueurs_inscrits'];
            ?>

            <a class="lien" href="scores.php" >Tableau des Scores</a>

            <div class = flex>
                <p class="para">
                    Découvrez le classement des meilleurs joueurs ! Consultez votre position et comparez vos performances avec celles des autres.
                    Chaque partie vous rapproche du sommet, alors revenez régulièrement pour tenter de battre votre meilleur score.
                    Qui sera couronné maître de la mémoire ?
                </p>

                <table>

                    <tr>
                        <td><?php echo $totalParties; ?></br>Parties Jouées</td>
                        <td><?php echo $joueursConnectes; ?></br>Joueurs Connectés</td>
                    </tr>

                    <tr>
                        <td><?php echo $meilleurScore; ?></br>Meilleur Temps</td>
                        <td><?php echo $joueursInscrits; ?></br>Joueurs Inscrits</td>
                    </tr>

                </table>
            </div>
        </div>
        <section>
            <div class="text">
                <p>NOTRE ÉQUIPE</p>
            </div>

            <div class="equipe">
                <div class="cons">
                    <a href="https://www.youtube.com/watch?v=O_HUXxSHkO8">
                        <img src="assets/images/killian.jpg" alt="image Killian" />
                    </a>
                    <p>Killian</p>
                </div>
                <div class="cons">
                    <a href="https://cherry.img.pmdstatic.net/fit/https.3A.2F.2Fimg.2Egamesider.2Ecom.2Fs3.2Ffrgsg.2F1280.2Fjeux-video.2Fdefault_2022-08-23_2cc5169d-fb34-4d33-962a-5502f3626d48.2Ejpeg/1200x675/quality/80/le-champignon-de-toad-est-il-un-chapeau-ou-fait-il-partie-de-sa-tete.jpg">
                        <img src="assets/images/clement.PNG" alt="image Clément" />
                    </a>
                    <p>Clément</p>
                </div>
                <div class="cons">
                    <a href="https://youtu.be/HVQSbgG69Sc?si=WcquFOD_Zp26XYiq&t=17">
                        <img src="assets/images/matheo.jpg" alt="image Mathéo" />
                    </a>
                    <p>Mathéo</p>
                </div>
                <div class="cons">
                    <div class="test">
                        <a href="siwar.html">
                            <img class="siwar" src="assets/images/siwar.jpg" alt="image Siwar"/>
                        </a>
                        <p>Siwar</p>
                    </div>
                    <button id="resetMascotte">Réinitialiser</button>
                </div>

            </div>

        </section>
        <div>
        
        <script type="text/javascript" src="assets/js/index.js"></script>

            <?php require 'footer.php';?>
        </div>
        <audio autoplay loop>
            <source src="assets/musique/Undertale OST 054 - Hotel.mp3" type="audio/mpeg">
            <audio autoplay loop volume="0.5">
        </audio>
            <label for="toggle-chat" class="chat-button"></label>
            <input type="checkbox" id="toggle-chat">
       
    </body>

</html>
