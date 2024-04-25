<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8" />
    <title> Page d'accueil </title>
    <link rel="stylesheet" href="css/page_style.css" />
    <script type="text/javascript" src="scripts/jquery-3.7.1.min.js"></script>
</head>

<body>
    <section class="contenu">
        <div class="haut">
            <td><img id="bus" src="medias/bus.png"></td>
        </div>

        <div class="bas">
            <form action="vues/page_de_connexion.php" method="post">
                <input type="submit" name="connexion" value="Se connecter" class="button">
            </form>

            <form action="vues/application.php" method="post">
                <input type="submit" name="consultation" value="Consulter sans se connecter" class="button">
            </form>
        </div>
    </section>
</body>

</html>