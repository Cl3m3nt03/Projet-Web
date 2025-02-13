<?php
    function inscription(){
        include 'database.php';
        $db = db_connect();
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['mail']) && !empty($_POST['verif_password'])) {

            $pseudo = htmlspecialchars($_POST['username']);
            $mdp = $_POST['password'];
            $email = htmlspecialchars($_POST['mail']);
            $verif_password = $_POST['verif_password'];

            if (strlen($pseudo) < 4) {
                echo "<script>alert('Le pseudo doit contenir au moins 4 caractères.');</script>";
            }
            elseif (!preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $mdp)) {
                echo "<script>alert('Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, un chiffre, et un caractère spécial.');</script>";
            }
            elseif ($mdp !== $verif_password) {
                echo "<script>alert('Les mots de passe ne correspondent pas. Veuillez réessayer.');</script>";
            } else {
                $statement = $db->prepare('SELECT pseudo FROM user WHERE pseudo = ?');
                $statement->execute([$pseudo]);

                if ($statement->rowCount() == 0) {
                    $hashpass = password_hash($mdp, PASSWORD_DEFAULT);
                    $insertUser = $db->prepare('INSERT INTO user(pseudo, password, email) VALUES(?, ?, ?)');
                    $insertUser->execute(array($pseudo, $hashpass, $email));
                    echo "<script>alert('Inscription réussie !'); window.location.href='connexion.php';</script>";
                    exit();
                } else {
                    echo "<script>alert('Le pseudo est déjà utilisé.');</script>";
                }
            }
        } else {
            echo "<script>alert('Veuillez remplir tous les champs.');</script>";
        }
    }


    function connexion(){
        require_once 'database.php';
        $db = db_connect();
            if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $mdp = $_POST['mdp'];
                
                    
                $recupUser = $db->prepare('SELECT * FROM user WHERE pseudo = ?');// recup le pseudo/mdp de la bdd
                $recupUser->execute(array($pseudo));
        
                if($recupUser->rowCount()> 0){
                    $user = $recupUser->fetch();
                    if(password_verify($mdp, $user['password'])){
                        
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['pseudo'] = $user['pseudo'];
                        header('location: index.php');
                    }else{
                        echo'NON';
                    }
        
                }
            }
    }

    
        function changepassword($db) {
            require_once 'database.php';
            $db = db_connect();
            
            if (!empty($_POST['old_password']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])) {
                $old_password = htmlspecialchars($_POST['old_password']);
                $new_password = htmlspecialchars($_POST['password']);
                $confirm_password = htmlspecialchars($_POST['confirm_password']);
        
                // Utilisation de $_SESSION['id'] sans démarrer une nouvelle session
                $user_id = $_SESSION['id'];
        
                $recupUser = $db->prepare('SELECT * FROM user WHERE id = ?');
                $recupUser->execute(array($user_id));
                $user = $recupUser->fetch();
        
                if ($user && password_verify($old_password, $user['password'])) {
                    if ($new_password === $confirm_password) {
                        if (preg_match("/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/", $new_password)) {
                            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                            $updatePass = $db->prepare('UPDATE user SET password = ? WHERE id = ?');
                            $updatePass->execute(array($hashed_password, $user['id']));
                            echo 'Mot de passe mis à jour avec succès.';
                        } else {
                            echo 'Le nouveau mot de passe doit contenir au moins 8 caractères, dont une majuscule, un chiffre, et un caractère spécial.';
                        }
                    } else {
                        echo 'Le nouveau mot de passe et la confirmation ne correspondent pas.';
                    }
                } else {
                    echo 'L\'ancien mot de passe est incorrect.';
                }
            } 
            else {
                echo 'Veuillez remplir tous les champs.';
            }
        }    
        function changeemail($db){
            require_once 'database.php';
        
            if (!empty($_POST['mail']) && !empty($_POST['username']) && !empty($_POST['verif_password'])) {
                $mail = htmlspecialchars($_POST['mail']);
                $newEmail = htmlspecialchars($_POST['username']);
                $verif_password = htmlspecialchars($_POST['verif_password']);
                
                // Rechercher l'utilisateur par l'email existant
                $recupUser = $db->prepare('SELECT * FROM user WHERE email = ?');
                $recupUser->execute(array($mail));

                if ($recupUser->rowCount() > 0) {
                    $user = $recupUser->fetch();

                    // Vérification du mot de passe (supposant que le mot de passe est stocké de manière sécurisée)
                    if (password_verify($verif_password, $user['password'])) {
                        // Mettre à jour l'email
                        $updateEmail = $db->prepare('UPDATE user SET email = ? WHERE id = ?');
                        $updateEmail->execute(array($newEmail, $user['id']));
                        echo "<div style=' background-color: #ffffff;text-align: center;'>Mail changé avec succes.</div>";
                    } else {
                        echo 'Mot de passe incorrect.';
                    }
                } else {
                    echo "<div style=' background-color: #ffffff;text-align: center;'>Utilisateur non rentré.</div>";
                }
            } 
            else {
                echo 'Veuillez remplir tous les champs.';
            }
        }
?>

