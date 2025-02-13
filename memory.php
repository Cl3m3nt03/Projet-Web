<?php
session_start();
?> 


<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <link href="assets/css/memory.css" rel="stylesheet">
</head>
<body>

    <?php
    require 'header.php';
    require 'chatBot.php';
    ?>

    <div class="titlecarousel">
        <a>Memory Game</a>
    </div>
    
    <section>
        <div class="configurationjeu" id="configurationjeu">
                <div class="menu-config">
                    <label for="Choisir Niveau">Choisir niveau</label>
                    <select name="difficuly-game" id="difficulty-game">
                        <option value="1">Niveau 1</option>
                        <option value="2">Niveau 2</option>
                        <option value="3">Niveau 3</option>
                    </select>
                    <div class="theme-game">
                        <label for="Choisir theme">Choisir theme</label>
                        <select name="game-pers" id="game-pers">
                            <option value="1">Theme 1</option>
                            <option value="2">Theme 2</option>
                            <option value="3">Theme 3</option>
                            </select>
                    </div>
                    <div>
                        <input id="validebut" type="submit" value="Valider"/>
                    </div>
                    <div id="timer" style="font-size: 1.5em; text-align: center; margin-top: 10px;">00:00:00</div>  
                </div>  
        </div>
        <section class="section_grid">
            <div class="game-grid" id="game-grid">
                <img class="img_memory" src="">
            </div>
            <div id="celebration-animation" class="hidden"></div>
        </section>
    </section>    
    
            <img class = "bulle" src="assets/images/Text Bubbles.png" alt="bulle" />
            <img class = "mascotte" src="assets/images/Burgerpants_face_3.webp" alt="mascotte" />
            <p class = "dialogue">Pas mal petit</p>
            
            
    <script type="text/javascript" src="assets/js/memory.js"></script>
    <?php require 'footer.php'; ?>

    <audio autoplay loop>
        <source src="assets/musique/Puzzles.mp3" type="audio/mpeg">
        <audio autoplay loop volume="0.5">
    </audio>
</body>

</html>