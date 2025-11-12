<?php
session_start();
require('../controleur/billet.php');
require('../controleur/commentaire.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $billet['titre'] ?> | Pop & Pose</title>
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
        <section class="article">
            <?php
            echo "<h1>{$billet['titre']}</h1>
                <p>Date : {$billet['date']}</p>
                <br>
                <p>{$billet['contenu']}</p>";
            ?>
        </section>

        <section class="coms">
            <h2>Commentaires</h2>
            <?php
            if (count($coms) > 0) {
                echo '<button id="affiche">Afficher les commentaires</button>';
                foreach ($coms as $c) {
                    echo "<div class = 'com'>
                    <span><img src='{$c['photo']}' alt='photo de profil'>
                    <p><strong>{$c['login']}</strong> | {$c['role']}</p></span>
                        <p><em>{$c['date_com']}</em></p>
                        <p>{$c['contenu_com']}</p>
                        <hr>
                </div>";
                }
            } else {
                echo "<p><em>Aucun commentaire pour cet article.</em></p>";
            }
            ?>

            <div class="form">
                <?php
                //si connecté, affiche le form
                if (isset($_SESSION['id_user'])) {

                    echo "
                <form action='../controleur/commentaire.php' method='post'>
                <label for='com'>Écrivez un commentaire :</label><br>
                <textarea name='com' id='com' placeholder='Wow, quel bel article' required></textarea>
                <br>
                <input type='hidden' name='id_billet' value= '{$billet['id_billet']}'>
                <input type='hidden' name='id_user' value= '{$_SESSION['id_user']}'>
                <input type='submit' value='Envoyer' name='comBtn'>
                </form>
                ";
                }
                ?>


            </div>
        </section>
    </main>
    <footer>
        <p class="logo">&copy; Pop & Pose</p>
    </footer>

    <script>
        //Bouton menu pour mobile
        const menuBtn = document.getElementById('menu-btn');
        const navLinks = document.querySelector('.link');

        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        //Affichage des coms
        let bouton = document.querySelector('#affiche');

        bouton.addEventListener('click', () => {

            if (bouton.textContent.includes('Afficher')) {
                bouton.textContent = bouton.textContent.replace('Afficher', 'Masquer');
            } else {
                bouton.textContent = bouton.textContent.replace('Masquer', 'Afficher');
            };

            document.querySelectorAll('.com').forEach((com) => {
                com.classList.toggle('vue');
            });
        })
    </script>
</body>

</html>