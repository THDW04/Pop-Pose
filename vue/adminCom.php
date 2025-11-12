<?php
session_start();
require('../controleur/commentaire.php'); //commentaires

if (!isset($_SESSION['id_user']) || $_SESSION['role'] !== 'propriétaire') {
    echo "Accès refusé";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau de gestion | Pop & Pose</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Instrument+Serif:ital@0;1&display=swap"
        rel="stylesheet">
</head>

<body>
    <header>
        <a href="../index.php" class="logo">Pop & Pose</a>
        <nav>
            <button id="menu-btn">Menu</button>
            <ul class="link">
                <li><a href="../index.php">Accueil</a></li>
                <li><a href="archives.php">Archives</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="../controleur/deconnexion.php" class="accent">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Panneau de gestion</h1>
        <div class="links">
            <a href="adminBillet.php">Billets</a>
            <a href="adminUser.php">Utilisateurs</a>
            <a href="adminCom.php" class="actif">Commentaires</a>
        </div>

        <section class="commentaires" id="commentaire">
            <table>
                <caption>Liste des commentaires</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th>Date</th>
                        <th>Contenu</th>
                        <th>Billet</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($commentaires as $c) {
                        echo "<tr>
                                    <td>{$c['id_com']}</td>
                                    <td class='img'><img src='{$c['photo']}' alt='image de l'utilisateur {$c['login']}'> {$c['login']}</td>
                                    <td>{$c['date_com']}</td>
                                    <td>{$c['contenu_com']}</td>
                                    <td>{$c['titre']}</td>
                                    <td>
                                        <button id='supBtn' class='action delete'><a href='adminCom.php?id_com={$c['id_com']}&action=delete'>Supprimer</a></button>
                                    </td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="modal" style="<?php echo $showModal ? 'display:block;' : 'display:none;'; ?>">
            <div class="supp" style="display:block;">
                <form action="../controleur/commentaire.php" method="POST">
                    <input type="hidden" name="id_com" value="<?php echo $com['id_com']; ?>">
                    <p>Etes-vous sur de vouloir supprimer ce commentaire ?</p>
                    <div>
                        <input type="submit" value="Oui" name="sup">
                        <input type="submit" value="Non" name="retour">
                    </div>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p class="logo">&copy; Pop & Pose</p>
    </footer>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const navLinks = document.querySelector('.link');

        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

    </script>
</body>

</html>