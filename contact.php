<?php
session_start();
?> 


<!DOCTYPE html>
<html lang="fr">
    <head>
        <link href="assets/css/contacts.css" rel="stylesheet">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contact</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php require 'header.php'; ?>

        <div class="titre">
            <h1>Nous contacter</h1>
        </div>
            <div class ="reslogo">
            <figure class="logo">
                <div class="carre">
                    <img src="assets/images/logoTe2l.png" alt="Téléphone" height="80"/>
                    <p>06 05 04 03 02</p>
                </div>
                <div class="carre">
                    <img src="assets/images/logomess.png" alt="Email" height="80"/>
                    <p>support@powerofmemory.com</p>
                </div>
                <div class="carre">
                    <img src="assets/images/logoping.png" alt="Localisation" height="80"/>
                    <p>Paris</p>
                </div>
                
            </figure>
        </div>

        <div class="formulaire">
            <form>
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="sujet" placeholder="Sujet" required>
                <textarea name="message" placeholder="Votre message" rows="5" required></textarea>
                <button type="submit">Envoyer</button>
        
                <div>
                    <figure class="perso"> 
                        <a href="burger.html"><img src="assets/images/Burgerpants_face_1.png" alt="perso" height="300"/></a>
                    </figure>
                </div>
            </form>
        </div>
        <?php require 'footer.php'; ?>
    </body>
</html>
