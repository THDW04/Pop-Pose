<?php
require('../controleur/user.php'); //utilisateur
require('../controleur/billet.php'); //billets

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
            <a href="adminBillet.php" class="actif">Billets</a>
            <a href="adminUser.php">Utilisateurs</a>
            <a href="adminCom.php">Commentaires</a>
        </div>
        <section class="billets" id="billet">
            <button id="ajoutBtn" class="action new">Ajouter un billet</button>
            <table>
                <caption>Liste des billets</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($billets as $b) {
                        echo "<tr>
                                    <td>{$b['id_billet']}</td>
                                    <td>{$b['titre']}</td>
                                    <td>{$b['date']}</td>
                                    <td>
                                        <button class='edit action'><a href='adminBillet.php?id={$b['id_billet']}&action=edit'>Modifier</a></button> |
                                        <button class='delete action'><a href='adminBillet.php?id={$b['id_billet']}&action=delete'>Supprimer</a></button>
                                    </td>
                                </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>



        <section class="modal" style="<?php echo $showModal ? 'display:block;' : 'display:none;'; ?>">
            <div class="ajout">
                <form action="../controleur/billet.php" method="POST">
                    <h2>Ajouer un billet</h2>
                    <br>
                    <div>
                        <label for="titre">Titre de l'article</label><br>
                        <input type="text" name="titre" id="titre" required>
                    </div>
                    <br><br>
                    <div>
                        <label for="date">La date du post</label><br>
                        <input type="date" name="date" id="date" required>
                    </div>
                    <br><br>
                    <div>
                        <label for="contenu">Contenu de l'article</label><br>
                        <textarea name="contenu" id="contenu" placeholder="Écrivez le contenu ici..."
                            required></textarea>
                    </div>
                    
                    <div class="btn">
                        <button class="close">Quitter</button>
                        <input type="submit" value="Envoyer" name="nv-billet">
                    </div>
                </form>
            </div>

            <div class="modifier" style="<?php echo $showEdit ? 'display:block;' : 'display:none;'; ?>">
                <form action="../controleur/billet.php" method="POST">
                    <div>
                        <input type="hidden" name="id_billet" value="<?php echo $billet['id_billet']; ?>">
                        <label for="titre">Titre de l'article</label><br>
                        <input type="text" name="titre" id="titre" value="<?php echo $billet['titre']; ?>" required>
                    </div>
                    <br>
                    <div>
                        <label for="date">La date du post</label><br>
                        <input type="date" name="date" id="date" value="<?php echo $billet['date']; ?>" required>
                    </div>
                    <br>
                    <div>
                        <label for="contenu">Contenu de l'article</label><br>
                        <textarea name="contenu" id="contenu" required><?php echo $billet['contenu']; ?></textarea>
                    </div>
                    <br>
                    <div class="btn">
                        <input type="submit" value="Annuler" name="retour">
                        <input type="submit" value="Envoyer" name="update">
                    </div>
                </form>
            </div>

            <div class="supp" style="<?php echo $showDelete ? 'display:block;' : 'display:none;'; ?>">

                <form action="../controleur/billet.php" method="POST">
                    <input type="hidden" name="id_billet" value="<?php echo $billet['id_billet']; ?>">
                    <p>Etes-vous sur de vouloir supprimer cet article ?</p>
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
        const addBtn = document.getElementById('ajoutBtn');
        const closeBtn = document.querySelector('.close');

        addBtn.addEventListener('click', () => {
            modal.style.display = 'block';
            document.querySelector('.ajout').style.display = 'block';
        });

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