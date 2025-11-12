<?php
include('../connexion.php');
require('../modele/commentaire.php');

//Tous les commentaires d'un billet
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $coms = getComBillet($db, $id);
}


//Tous les coms
$commentaires = getCom($db);

// Un com
if (isset($_GET['id_com'])) {
    $idCom = $_GET['id_com'];
    $com = getComById($db, $idCom);

    //Afficher la modale
    $showModal = true;
} else {
    $showModal = false;
}


//Ajouter un com à la bdd
if (isset($_POST['comBtn'])) {
    ajoutCom($db, $_POST['id_user'], $_POST['com'], $_POST['id_billet']);

    header("Location: ../vue/article.php?id=" . $_POST['id_billet']);
    exit;
}

//Supprimer un com de la bdd
if (isset($_POST['sup'])) {

    supCom($db, $_POST['id_com']);

    header('Location:../vue/adminCom.php');
    exit;
} elseif (isset($_POST['retour'])) {

    header('Location:../vue/adminCom.php');
    exit;
}
?>