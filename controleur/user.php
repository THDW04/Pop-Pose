<?php
session_start();
include('../connexion.php');
require('../modele/utilisateur.php');

//Appel des users
$users = getUser($db);

if (isset($_GET['login'])) {
    $user = getUserByLogin($db, $_GET['login']);
    $login = $_GET['login'];

  //Afficher la modale
    $showModal = true;
} else {
    $showModal = false;
}

if(isset($_GET['action'])){
    $action = $_GET['action'];
}

if (isset($login) && $action === 'edit') {
    $showEdit = true;
}else{$showEdit = false;}

if (isset($login) && $action === 'delete') {
    $showDelete = true;
}else{$showDelete = false;}

//Modification du profil
if (isset($_POST['update'])) {
    $u = getUserByLogin($db, $_POST['login']);
    $img = $u['photo'];

    if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] != "") {
        $tmpName = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        move_uploaded_file($tmpName, '../images/' . $name);
        $img = '../images/' . $name;
    }

    updateUser($db, $_POST['id_user'], $_POST['login'], $_POST['role'], $img);

    header('Location:../vue/adminUser.php');
    exit;
}

//Supprimer un user de la bdd
if (isset($_POST['sup'])) {

    supUser($db, $_POST['id_user']);

    header('Location:../vue/adminUser.php');
    exit;
} elseif (isset($_POST['retour'])) {

    header('Location:../vue/adminUser.php');
    exit;
}
?>