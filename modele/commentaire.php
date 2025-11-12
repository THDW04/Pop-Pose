<?php
include('../connexion.php');

// Récupérer tous les commentaires d'un article/billet
function getComBillet($db, $id)
{
    $requete = "SELECT * FROM commentaire, utilisateur
            WHERE fk_billet = :id_billet 
            AND fk_user_com = id_user
            ORDER BY date_com DESC";

    $stmt = $db->prepare($requete);
    $stmt->bindValue(':id_billet', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer tous les commentaires
function getCom($db)
{
    $requete = "SELECT * FROM commentaire, utilisateur, billet 
            WHERE fk_billet = id_billet 
            AND fk_user_com = id_user
            ORDER BY date_com DESC";

    $stmt = $db->prepare($requete);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Récupérer un commentaire
function getComById($db, $id)
{
    $requete = "SELECT * FROM commentaire WHERE id_com = :id";
    $stmt = $db->prepare($requete);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

//Ajouter un commentaire
function ajoutCom($db, $id_user, $contenu, $fk_billet)
{
    $date_com = date('Y-m-d H:i:s');

    $requete = "INSERT INTO commentaire (date_com, contenu_com, fk_user_com, fk_billet) 
            VALUES (:date_com, :contenu, :fk_user_com, :fk_billet)";
    $stmt = $db->prepare($requete);
    $stmt->execute([
        ':date_com' => $date_com,
        ':contenu' => $contenu,
        ':fk_user_com' => $id_user,
        ':fk_billet' => $fk_billet
    ]);
}

// Supprimer un commentaire
function supCom($db, $id)
{
    $stmt = $db->prepare("DELETE FROM commentaire WHERE id_com = :id");
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}

?>