<!DOCTYPE html>
<?php
session_start();
?>

<html>

<head>
    <meta charset="utf-8" />
    <title> Page de connexion </title>
    <link rel="stylesheet" href="../css/page_de_connexion.css" />
    <script type="text/javascript" src="../scripts/jquery-3.7.1.min.js"></script>
</head>

<body>
    <section class="contenu">
        <div class="haut">
            <td><img id="bus" src="../medias/bus.png"></td>
        </div>

        <div class="bas">
            <input type="email" id="login" placeholder="Tapez votre compte" />
            <input type="password" id="mdp" placeholder="Mot de passe" />
        </div>

        <div class="connexion">
            <input type="submit" value="Se connecter" id="ok" class="button" />
            <p id="retour"></p>
        </div>

    </section>

    <script>
        // lors du clic sur bouton Connexion
        // req. AJAX qui appelle modeles/verifLogin.php 
        // avec login et mot de passe comme données POST
        $("#ok").on({
            "click": function () {
                // récupération du login et du mdp
                let login = $("#login").val();
                let mdp = $("#mdp").val();
                let donnees = 'login=' + login + '&mdp=' + mdp;
                // requête AJAX
                $.ajax({
                    url: '../modeles/verifLogin.php',
                    data: donnees,
                    type: 'POST',
                    dataType: 'text',
                    success: function (reponse, statut) {
                        // retour de la requete AJAX
                        if (reponse == "3") {
                            // 3- authentification réussie => redirection vers la page appli.php
                            document.location.href = "page_de_consultation.php";
                            //Si connexion réussie, on initialise la variable logged_in comme true;
                        } else {
                            if (reponse == "1") {
                                // 1- Login inexistant
                                $("#retour").text("Login inexistant");
                            } else {
                                // 2- Mdp incorrect
                                $("#retour").text("Mot de passe incorrect");
                            }
                        }

                    }
                });

            }
        });

    </script>

</body>

</html>