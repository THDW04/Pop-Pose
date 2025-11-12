<?php
session_start();
include('connexion.php');

$stmt = $db->prepare("SELECT * FROM billet ORDER BY date DESC LIMIT 3");
$stmt->execute();
$billets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pop & Pose | Accueil</title>
    <link rel="stylesheet" href="css/style.css">
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

                <li><a href="index.php">Accueil</a></li>
                <li><a href="vue/archives.php">Archives</a></li>
                <?php
                if (isset($_SESSION['id_user'])) {
                    echo '<li><a href="vue/profil.php">Profil</a></li>
                <li><a href="controleur/deconnexion.php" class="accent">Déconnexion</a></li>';
                } else {
                    echo '<li><a href="vue/login.php" class="accent">Connexion</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h1>Pop & Pose</h1>
            <div class="img">
                <img src="images/img1.jpeg" alt="" id="img1">
                <img src="images/img2.jpeg" alt="" id="img2">
                <img src="images/img3.jpeg" alt="" id="img3">
            </div>
            <h2>Une pause créative dans un monde en mouvement.</h2>
            <p>Pop & Pose, c’est l’espace où la créativité prend la pose. <br>
                Ici, on parle d’art, de design, de beauté et d’inspiration sans filtre.</p>
            <p>Un univers coloré où chaque article capture une émotion, une idée, une image qui marque. <br>
                Reste, explore, découvre les artistes et tendances qui redessinent notre manière de voir le monde.
            </p>
            <a href="vue/archives.php">Lire un article !</a>
        </section>

        <section>
            <h2>Nos derniers articles</h2>

            <div class="billets">
                <?php
                foreach ($billets as $b) {
                    $texte = $b['contenu'];
                    $extrait = substr($texte, 0, 200);
                    echo "<div class='billet'>
                                <h3>{$b['titre']}</h3>
                                <p>{$b['date']}</p>
                                <p>{$extrait}...</p>
                                <a href='vue/article.php?id={$b['id_billet']}'>lire l'article</a>
                        </div><hr>";
                }
                ?>
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