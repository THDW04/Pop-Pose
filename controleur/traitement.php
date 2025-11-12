<?php
session_start();
include('../connexion.php');
require('../modele/utilisateur.php');

    //Inscription
    if (isset($_POST['inscription'])) {
        $pseudo = $_POST['pseudo'];
        $motDePasse = password_hash($_POST['mot-de-passe'], PASSWORD_DEFAULT);
    
        if (isset($_FILES['img'])) {
            $tmpName = $_FILES['img']['tmp_name'];
            $name = $_FILES['img']['name'];
            move_uploaded_file($tmpName, '../images/' . $name);
        }
        $img = '../images/' . $name;
    
        addUser($db, $pseudo, $motDePasse, $img);
        

        $_SESSION['valide'] = "Votre inscription est confirmée.";
        header('Location:../vue/login.php');
        exit;
    }
    
    //Connexion
    if (isset($_POST['connexion'])) {
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];
    
        $user = getUserByLogin($db, $login);
    
    
        if ($user && password_verify($mdp, $user['mot_de_passe'])) {
    
            //créer la session ici
            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['login'] = $user['login'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['photo'] = $user['photo'];
    
            header('Location:../vue/profil.php');
            exit;
    
        } else {
            //Mdp ou login incorrect
            $_SESSION['erreur'] = "Identifiant ou mot de passe incorrect.";
           header('Location:../vue/login.php');
           exit;
        }
    
    }
?>