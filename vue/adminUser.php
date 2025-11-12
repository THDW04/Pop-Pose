<?php
require('../controleur/user.php'); //utilisateur

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
            <a href="adminUser.php" class="actif">Utilisateurs</a>
            <a href="adminCom.php">Commentaires</a>
        </div>
        <section class="users" id="user">
            <table>
                <caption>Liste des ustilisateurs</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Role</th>
                        <th>Login</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($users as $u) {
                        echo "<tr>
                                    <td>{$u['id_user']}</td>
                                    <td>{$u['role']}</td>
                                    <td class='img'><img src='{$u['photo']}' alt='image de l'utilisateur {$u['login']}'> {$u['login']}</td>
                                    <td>
                                        <button class='action edit'><a href='adminUser.php?login={$u['login']}&action=edit'>Modifier</a></button> |
                                        <button class='action delete'><a href='adminUser.php?login={$u['login']}&action=delete'>Supprimer</a></button>
                                    </td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <section class="modal" style="<?php echo $showModal ? 'display:block;' : 'display:none;'; ?>">
            <div class="modifier" class="modifier"
                style="<?php echo $showEdit ? 'display:block;' : 'display:none;'; ?>">
                <form action="../controleur/user.php" method="POST" enctype="multipart/form-data">
                    <img src="<?php echo $user['photo']; ?>" alt="">

                    <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                    <div>
                        <label for="login">Login de l'utilisateur</label><br>
                        <input type="text" name="login" id="login" value="<?php echo $user['login']; ?>" required>
                    </div>
                    <br>
                    <div>
                        <label for="role">Role du profil</label><br>
                        <input type="text" name="role" id="role" value="<?php echo $user['role']; ?>" require>
                    </div>
                    <br>
                    <div>
                        <label for="image">Nouvelle photo de profil</label><br>
                        <input type="file" name="image" id="image">
                    </div>
                    <br>
                    <div class="btn">
                        <input type="submit" value="Annuler" name="retour">
                        <input type="submit" value="Envoyer" name="update">
                    </div>
                </form>
            </div>

            <div class="supp" style="<?php echo $showDelete ? 'display:block;' : 'display:none;'; ?>">
                <form action="../controleur/user.php" method="POST">
                    <input type="hidden" name="id_user" value="<?php echo $user['id_user']; ?>">
                    <p>Etes-vous sur de vouloir supprimer cet utilisateur ?</p>
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

        const modal = document.querySelector('.modal');
        const closeBtn = document.querySelector('.close');

        closeBtn.addEventListener('click', () => {
            modal.style.display = 'none';
        });

        // Fermer si clique en dehors du modal
        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }
        });

    </script>
</body>

</html>