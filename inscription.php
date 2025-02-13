<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inscription</title>
        <link href="assets/css/inscription.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">

    </head>
    <body>
        <?php
            require 'header.php';
            include 'validators.php';

            if(isset($_POST['envoi_sign'])){
                inscription();
            }
            
        ?>

        <form method="POST">
            <h1>Inscription</h1>
            <p>
                <label><b>Mail</b></label>
                <input type="text" placeholder="Entrer votre mail" name="mail" required><br>
            </p>
            <p>
                <label><b>Pseudo</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required><br>
            </p>
            <p>
                <label><b>Mot de passe</b></label>
                <input id="passtrong" oninput="passwordstrong()" type="password" placeholder="Entrer votre mot de passe" name="password" required><br>
                <div class="passwordbar">
                    <div class="progessbar" id="progressbar" oninput="passwordstrong()"></div>
                </div>
            </p>
            <p>
                <label><b>Confirmer le mot de passe</b></label>
                <input type="password" placeholder="Confirmer le mot de passe" name="verif_password" required>
            </p>
            <input class="button-73" type="submit" id="submit" value="Inscription" name="envoi_sign">
        </form>
        <?php require 'footer.php'; ?>
    </body>
    <script type="text/javascript" src="assets/js/password.js"></script>
</html>