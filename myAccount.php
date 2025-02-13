<?php
    session_start();
    require_once 'database.php';
    require_once 'validators.php';


    $db = db_connect(); 


    if (!isset($_SESSION['id'])) {
        header("Location: database.php");
        exit(); 
    }

    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: connexion.php");
        exit(); }

   
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profile_image'])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        
        if (!in_array($imageFileType, ["jpg", "jpeg", "png"])) {
            $uploadOk = 0;
            echo "Seuls les fichiers JPG, JPEG, PNG et GIF sont autorisés.";
        }

       
        if ($_FILES["profile_image"]["size"] > 2 * 300 * 300) { 
            $uploadOk = 0;
            echo "Votre fichier est trop grand. La taille maximale est de 2 Mo.";
        }

       
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
              
                $userId = $_SESSION['id'];
                $stmt = $db->prepare("UPDATE user SET profile_image = :profile_image WHERE id = :id");
                $stmt->bindParam(':profile_image', $target_file);
                $stmt->bindParam(':id', $userId);
                $stmt->execute();
            } else {
                echo "Désolé, une erreur est survenue lors de l'upload de votre fichier.";
            }
        }
    }

        if (isset($_POST['envoi'])) {
        changeemail($db);
        }

        if (isset($_POST['envoi_pass'])) {
        changepassword($db);
        }

    $userId = $_SESSION['id'];
    $stmt = $db->prepare("SELECT pseudo, profile_image FROM user WHERE id = :id");
    $stmt->bindParam(':id', $userId);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Pixelify+Sans:wght@400..700&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyAccount</title>
        <link href="assets/css/myAccount.css" rel="stylesheet">
    </head>
    <body>
        <?php require 'header.php'; ?>

        <div id="main">
            <h1>Modification des données personnelles</h1>
            
         
          
                <p class="pseudo"><?php echo htmlspecialchars($user['pseudo']); ?></p>
            

          
            <div class="pdp">
                <figure>
                    <img src="<?php echo isset($user['profile_image']) ? htmlspecialchars($user['profile_image']) : 'assets/images/default_profile.png'; ?>" alt="Photo de profil" class="rounded-profile" height="300" style = "border-radius: 300px"/>
                </figure>
            
               
                <form action="myAccount.php" method="post" enctype="multipart/form-data">
                    <label class="button-73" for="profile_image">Choisir un fichier :</label> <br/>
                    <input class="button-display" type="file" name="profile_image" id="profile_image" require>
                    <button type="submit" class="button-Pdp">Modifier</button>
                </form>
            </div>

            <div class="container">
                
                <form method="post" action="">
                    <p>
                        <label><b>Ancien email</b></label>
                        <input type="text" placeholder="Entrer votre mail" name="mail" required><br>
                    </p>
                    <p>
                        <label><b>Nouvel email</b></label>
                        <input type="text" placeholder="Entrer le nouvel email" name="username" required><br>
                    </p>
                    <p>
                        <label><b>Mot de passe</b></label>
                        <input type="password" placeholder="Entrer votre mot de passe" name="verif_password" required>
                    </p>
                    <input type="submit" name = "envoi" class="button-73"/>
                </form>
        
                <form class="password-form" method="post">
                    <p>
                        <label><b>Ancien mot de passe</b></label>
                        <input type="password" placeholder="Entrer l'ancien mot de passe" name="old_password" required>
                    </p>
                    <p>
                        <label><b>Nouveau mot de passe</b></label>
                        <input id="passwordstrong" oninput="passwordstrong()" type="password" placeholder="Entrer le nouveau mot de passe" name="password" required><br>
                    </p>
                    <p>
                        <label><b>Confirmer le mot de passe</b></label>
                        <input type="password" placeholder="Confirmer le mot de passe" name="confirm_password" required>
                    </p>
                    <input type="submit" name = "envoi_pass" class="button-73"/>
                </form>

                <form action="myAccount.php" method="post">
                    <button type="submit" name="logout" class="button-73">Déconnexion</button>
                </form>

            </div>
        </div>

        <?php require 'footer.php'; ?>
    </body>
</html>
