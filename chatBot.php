<!DOCTYPE php?>
<html lang="fr">

    <head>
        <link href="assets/css/chatBot.css" rel="stylesheet">
    </head>


    <?php  
        include 'chat.php';
        require_once 'database.php';
    ?>







    <label for="toggle-chat" class="chat-button"></label>
    
    <input type="checkbox" id="toggle-chat">

    <div class="chat-container" id="chat-container">

        <div class="chat-header">
            <h2>ChatBot</h2>
        </div>
        <div class="cat-gif">
                <img src="<?php echo $gif_url; ?>" alt="Chat GIF" style="max-width: 100%; height: auto;">
        </div>
        <div class="chat-body">
            
            <?php
                if (count($messages) > 0) {
                    foreach ($messages as $message) {
                       
                        if (isset($message['id_expediteur'])) {
                            
                            if ($message['id_expediteur'] == $_SESSION['id']) {
                                
                                echo "<div class='user-message'>";
                                echo "<strong>" . htmlspecialchars($message['pseudo']) . ":</strong>";
                                echo "<p>" . htmlspecialchars($message['message']) . "</p>";
                                echo "</div>";
                            } else {
                                
                                echo "<div class='bot-message'>";
                                echo "<strong>" . htmlspecialchars($message['pseudo']) . ":</strong>";
                                echo "<p>" . htmlspecialchars($message['message']) . "</p>";
                                echo "</div>";
                            }
                        } else {
                            
                            echo "<p>Erreur: 'id_expediteur' non défini pour ce message.</p>";
                        }
                    }
                } else {
                    echo "<p>Aucun message des 24 dernières heures.</p>";
                }   
            ?>
            
        </div>
        <form action="chat.php" method="post">
            <input type="text" name="message" placeholder="Tapez votre message ici..." required>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</html>