<?php
include('../connexion.php');

// Récupérer tous les billets
function getBillets($db)
{
    $stmt = $db->prepare("SELECT * FROM billet ORDER BY date DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un billet précis par son id
function getBilletById($db, $id)
{
    $stmt = $db->prepare("SELECT * FROM billet WHERE id_billet = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Ajouter un billet
function ajoutBillet($db, $titre, $contenu, $id_user)
{
    $stmt = $db->prepare("INSERT INTO billet (titre, contenu, fk_user, date) 
                          VALUES (:titre, :contenu, :fk_user, NOW())");
    $stmt->execute([
        ':titre' => $titre,
        ':contenu' => $contenu,
        ':fk_user' => $id_user
    ]);
}

//Modifier un billet
function updateBillet($db, $id, $titre, $contenu, $date)
{
    $stmt = $db->prepare("UPDATE billet SET date = :date, titre = :titre, contenu = :contenu WHERE id_billet = :id_billet");
    $stmt->execute(
        array(
            'id_billet' => $id,
            "date" => $date,
            "titre" => $titre,
            "contenu" => $contenu
        )
    );
}

// Supprimer un billet
function supBillet($db, $id)
{
    $stmt = $db->prepare("DELETE FROM billet WHERE id_billet = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

?>