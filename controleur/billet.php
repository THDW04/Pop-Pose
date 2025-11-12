<?php
include('../connexion.php');
require('../modele/billet.php');

//Tous les billets
$billets = getBillets($db);

//Un seul billet
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $billet = getBilletById($db, $id);

    //Afficher la modale
    $showModal = true;
} else {
    $showModal = false;
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if (isset($id) && $action === 'edit') {
    $showEdit = true;
}else{$showEdit = false;}

if (isset($id) && $action === 'delete') {
    $showDelete = true;
}else{$showDelete = false;}


//Ajouter un billet à la bdd
if(isset($_POST['nv-billet'])){
    ajoutBillet($db,$_POST['titre'],$_POST['contenu'],1);
    header('Location:../vue/adminBillet.php');
}

//Modifier un biller de la bdd
if (isset($_POST['update'])){

    updateBillet($db, $_POST['id_billet'], $_POST['titre'], $_POST['contenu'],$_POST['date']);

    header('Location:../vue/adminBillet.php');
    exit;
}

//Supprimer un billet de la bdd
if (isset($_POST['sup'])) {

    supBillet($db, $_POST['id_billet']);

    header('Location:../vue/adminBillet.php');
    exit;
} elseif (isset($_POST['retour'])) {
    
    header('Location:../vue/adminBillet.php');
    exit;
}
?>