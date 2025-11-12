<?php
include('../connexion.php');

// Récupérer tous les utilisateurs
function getUser($db) {
    $stmt = $db->prepare("SELECT * FROM utilisateur");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un utilisateur précis par son login
function getUserByLogin($db, $login) {
    $stmt = $db->prepare("SELECT * FROM utilisateur WHERE login = :login");
    $stmt->bindValue(':login', $login, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Ajouter un utilisateur 
function addUser($db, $pseudo, $motDePasse, $img){
    $requete = $db->prepare("INSERT INTO utilisateur VALUES (0, :role, :login, :mot_de_passe, :photo)");
    $requete->execute(
        array(
            "role" => "utilisateur",
            "login" => $pseudo,
            "mot_de_passe" => $motDePasse,
            "photo" => $img
        ));
}

//Modifier un utilisareur 
function updateUser($db, $id, $login, $role, $img)
{
    $stmt = $db->prepare("UPDATE utilisateur SET login = :login, role = :role, photo = :photo WHERE id_user = :id_user");
    $stmt->execute(
        array(
            'id_user' => $id,
            "login" => $login,
            "role" => $role,
            "photo" => $img
        )
    );
}

// Supprimer un utilisateur
function supUser($db, $id) {
    $stmt = $db->prepare("DELETE FROM utilisateur WHERE id_user = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

?>