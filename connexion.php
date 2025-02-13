<?php
session_start();
?> 

<!DOCTYPE html>
<html lang="fr">


    <head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>connexion</title>
        <link href="assets/css/connexion.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

    </head>

    <body>

        <?php

            require 'header.php';
            include 'validators.php';

            if(isset($_POST['envoi'])){
                connexion();
            }
        ?>
        
        <form method ="POST" action="connexion.php" class="form1">
            <div>
                <h1>Connexion</h1>
            </div>

                <p>
                    <label><b>Nom d'utilisateur</b></label>
                    <input type="text" name="pseudo" />
                </p>

                <p>
                    <label><b>Mot de passe</b></label>
                    <input type="password" name="mdp" />
                    <br><br />
                </p>

                <input type="submit" name="envoi" class="button-73" />
                <a href="inscription.php">Créer un compte</a>
        </form>

        <?php require 'footer.php'; ?>
    </body>

</html>