<?php
session_start();
require('../controleur/billet.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archives | Pop & Pose</title>
    <link rel="stylesheet" href="../css/billet.css">
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
                <?php
                if (isset($_SESSION['id_user'])) {
                    echo '<li><a href="profil.php">Profil</a></li>
                <li><a href="../controleur/deconnexion.php" class="accent">Déconnexion</a></li>';
                } else {
                    echo '<li><a href="login.php" class="accent">Connexion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Archives</h1>
        <section class="billets">
            <?php
            foreach ($billets as $b) {
                $texte = $b['contenu'];
                $extrait = substr($texte, 0, 200);

                echo "<div class='billet'>
                        <h2>{$b['titre']}</h2>
                        <p>{$b['date']}</p>
                        <p>{$extrait}...</p>
                        <a href='article.php?id={$b['id_billet']}'>lire l'article</a>
                    </div>";
            }
            ?>
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