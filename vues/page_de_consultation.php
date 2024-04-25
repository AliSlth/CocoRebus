<?php 
session_start();
if(!isset($_SESSION['connected']) || $_SESSION['connected'] === false) {
    header('Location: ../page_accueil.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title> Page de gestion de fichiers </title>
    <link rel="stylesheet" href="../css/page_style.css" />
    <script type="text/javascript" src="../scripts/jquery-3.7.1.min.js"></script>
</head>

<body>
    <section class="contenu">
        <div class="haut">
            <td><img id="bus" src="../medias/bus.png"></td>
        </div>

        <div class="bas">
            <form action="page_de_gestion.php" method="post">
                <input type="submit" id="gestion" value="Gérer les fichiers" class="button">
            </form>

            <form action="application.php" method="post">
                <input type="submit" id="consultation" value="Consulter les données" class="button">
            </form>

            <form action="logout.php" method="post">
                <input type="submit" id="exist" value="Déconnexion" class="button">
            </form>
        </div>
    </section>
</body>

</html>
