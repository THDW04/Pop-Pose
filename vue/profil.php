<?php
include '../controleur/user.php';

if (!isset($_SESSION['id_user'])) {
    echo "Vous n'êtes pas connecté !";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil | Pop & Pose</title>
    <link rel="stylesheet" href="../css/profil.css">
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
        <h1>Bonjour <em><?php echo $_SESSION['login'] ?> </em>, content de vous revoir !</h1>
        <section class="infos">
            <img src="<?php echo $_SESSION['photo'] ?>" alt="Photo de profil">
            <div class="profil">
                <p><strong>Pseudo:</strong> <?php echo $_SESSION['login'] ?></p>
                <p><strong>Rôle:</strong> <?php echo $_SESSION['role'] ?></p>
                <br>
            </div>
        </section>

        <?php
        if ($_SESSION["role"] === 'propriétaire')
            echo "<section class='admin'>
            <h2>Admin</h2>
            <a href='adminBillet.php'>Gérer les billets</a>
            <a href='adminUser.php'>Gérer les utilisateurs</a>
            <a href='adminCom.php'>Gérer les commentaires</a>            
        </section>"
        
        ?>

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