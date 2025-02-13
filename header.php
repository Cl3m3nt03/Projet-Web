<?php
$pageActuelle = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link href="assets/css/header.css" rel="stylesheet">
        <title>The Power of Memory</title>
    </head>

    <body>
        <header>

            <label id="menuslide">
                <input id="boutmenu" type="checkbox">
                <div id="le_test"></div>
                <div id="boutmenu-container">
                    <label>
                        <div class="boutmenu-select">
                            <a href="index.php" class="<?php echo ($pageActuelle == 'index.php') ? 'active' : ''; ?>">Accueil</a>
                        </div>
                        <div class="boutmenu-select">
                            <a href="contact.php" class="<?php echo ($pageActuelle == 'contact.php') ? 'active' : ''; ?>">Contact</a>
                        </div>
                        <div class="boutmenu-select">
                            <a href="memory.php" class="<?php echo ($pageActuelle == 'memory.php') ? 'active' : ''; ?>">Jeu</a>
                        </div>
                    </label>
                </div>
            </label>
            
            <a href="index.php" class="<?php echo ($pageActuelle == 'index.php') ? 'active' : ''; ?>">The Power Of Memory</a>

            <ul>
                <li><a href="scores.php" class="<?php echo ($pageActuelle == 'scores.php') ? 'active' : ''; ?>">Scores</a></li>
                <li><a href="contact.php" class="<?php echo ($pageActuelle == 'contact.php') ? 'active' : ''; ?>">Contact</a></li>
                <li><a href="memory.php" class="<?php echo ($pageActuelle == 'memory.php') ? 'active' : ''; ?>">Jeu</a></li>
            </ul>

            <!-- Liens vers connexion et compte utilisateur -->
            <?php
                if (isset($_SESSION['id'])) {
                    echo '<a href="myAccount.php"><img src="assets/images/logoLOg.png" alt="Mon Compte" height="80"/></a>';
                    echo' <a href="logout.php">Déconnexion</a>' ;
                } else {
                    echo '<a href="connexion.php"><img src="assets/images/logoLOg.png" alt="Connexion" height="80"/></a>';
                }
            ?>





        </header>
    </body>

</html>