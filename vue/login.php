<?php
session_start();

//Mauvais login ou mdp
if (isset($_SESSION['erreur'])) {
    $erreur = $_SESSION['erreur'];
    unset($_SESSION['erreur']);
}

//Inscription validée
if (isset($_SESSION['valide'])) {
    $valide = $_SESSION['valide'];
    unset($_SESSION['valide']);
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Pop & Pose</title>
    <link rel="stylesheet" href="../css/login.css">
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
            </ul>
        </nav>
    </header>
    <main>
        <?php if (isset($valide)) {
            echo '<p class="valide">' . $valide . '</p>';
        }
        ?>

        <section>
            <div class="inscription">
                <h2>S'inscrire</h2>

                <div id="inscri">
                    <h3>Pas encore inscrit ?</h3>
                    <p>Commencez-ici.</p>
                    <button id="btn">S'inscrire</button>
                </div>

                <form action="../controleur/traitement.php" method="POST" enctype="multipart/form-data"
                    id="inscription">
                    <p>*Tous les champs sont obligatoires.</p>
                    <div>
                        <label for="pseudo">Pseudo*</label><br>
                        <input type="text" name="pseudo" id="pseudo" autocomplete="off" required>
                    </div>

                    <div>
                        <label for="mot-de-passe">Mot de passe*</label><br>
                        <input type="password" name="mot-de-passe" id="mot-de-passe" autocomplete="off" required>
                    </div>

                    <div>
                        <label for="img">Choisissez une photo de profil*</label><br>
                        <input type="file" name="img" id="img" accept="image/*" required>
                    </div>

                    <input type="submit" value="S'inscrire" name="inscription">
                </form>
            </div>

            <div class="connexion">
                <h2>Se connecter</h2>
                <form action="../controleur/traitement.php" method="POST">

                    <?php if (isset($erreur)) {
                        echo '<p class="erreur">' . $erreur . '</p>';
                    }
                    ?>

                    <div>
                        <label for="login">Login</label><br>
                        <input type="text" name="login" id="login" required>
                    </div>
                    <br>
                    <div>
                        <label for="mdp">Mot de passe</label><br>
                        <input type="password" name="mdp" id="mdp" required>
                    </div>
                    <br>
                    <input type="submit" value="Se connecter" name="connexion">
                </form>
            </div>
        </section>
    </main>
    <footer>
        <p class="logo">&copy; Pop & Pose</p>
    </footer>


    <script>
        //Affiche le form d'inscription
        let sign = document.getElementById('btn');
        let inscrip = document.getElementById('inscription');

        sign.addEventListener('click', () => {
            inscrip.style.display = 'block';
            document.getElementById('inscri').style.display = 'none';
        });

        //Menu pour mobile
        const menuBtn = document.getElementById('menu-btn');
        const navLinks = document.querySelector('.link');

        menuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    </script>
</body>

</html>