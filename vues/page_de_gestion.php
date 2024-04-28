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
    <title> Page de traitement des fichiers </title>
    <link rel="stylesheet" href="../css/page_de_gestion.css" />
    <script type="text/javascript" src="../scripts/jquery-3.7.1.min.js"></script>
</head>


<body>
    <section class="contenu">
        <div calss="haut">
            <td><img id="bus" src="../medias/bus.png"></td>
        </div>

        <div class="bas">
            <p>
            <div class="form_ajout">
                <form action="../modeles/ajouter_un_fichier.php" method="post" enctype="multipart/form-data">
                    <div class="form_group">
                        <label for="file_a_ajouter" class="label_select">Déposer JPG :</label>
                        <input type="file" name="xml_a_ajouter" accept="image/jpeg" class="select_ajout1">
                        <label for="file_a_ajouter" class="label_select">Déposer XML :</label>
                        <input type="file" name="jpg_a_ajouter" accept="text/xml" class="select_ajout2">
                    </div>
                    <input type="submit" name="submit" value="submit" class="button">
                </form>
            </div>
            </p>


            <p>
            <div class="form_supprime">
                <form action="../modeles/supprimer_un_fichier.php" method="post">
                    <div class="form_group">
                        <label for="fichier_a_supprimer" class="label_select">Supprimer fichier: </label>
                        <select name="fichier_a_supprimer" id="fichier_a_supprimer" class="select_supprime" multiple>
                            <?php
                            //chemain du repertoire a parcourir 
                            $repertoire = './DATA/';

                            if ($handle = opendir($repertoire)) {
                                //parcourir chaque fichier dans le repertoire 
                                while (false !== ($file = readdir($handle))) {
                                    //Exclure les repertoires speciaux. et .. 
                                    if ($file != "." && $file != "..") {
                                        // Exclure les repertoire speciaux . et .. 
                                        if (is_file($repertoire . $file)) {
                                            //verifier si le chemin est un fichier 
                                            if (is_file($repertoire . $file)) {
                                                echo "<option value='$file'>$file</option>";
                                            }
                                        }
                                    }
                                }
                                //fermer le repertoire 
                                closedir($handle);
                            } else {
                                echo "<option> Aucun fichier trouvé</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="submit" name="submit" value="Supprimer" class="button">
                </form>
            </div>
            </p>
        </div>
    </section>

    <script>
        // Attendre que le DOM soit chargé
        $(document).ready(function () {
            // Sélectionner le formulaire d'ajout
            var formAjout = $('.form_ajout form');
            var formSupprime = $('.form_supprime form');

            // Attacher un événement submit au formulaire d'ajout
            formAjout.on('submit', function (event) {
                event.preventDefault(); // Empêcher le formulaire de se soumettre normalement

                // Soumettre le formulaire via AJAX
                $.ajax({
                    url: formAjout.attr('action'), // Récupérer l'URL d'action du formulaire
                    type: formAjout.attr('method'), // Récupérer la méthode de soumission du formulaire
                    data: new FormData(formAjout[0]), // Créer un FormData à partir du formulaire
                    processData: false,
                    contentType: false,
                    success: function (response) { // Fonction de succès
                        alert(response); // Afficher la réponse dans une boîte de dialogue

                        // Check if the uploaded file is XML
                        var uploadedFile = $('#file_a_ajouter')[0].files[0];
                        if (uploadedFile.type === 'text/xml') {
                            $.ajax({
                                url: '../modeles/supprimer_BaseDeDonnee.php',
                                type: 'POST',
                                success: function (response) {
                                    console.log(response); // Afficher la réponse dans la console
                                }
                            });

                            $.ajax({
                                url: '../modeles/ajouter_BaseDeDonnee.php',
                                type: 'POST',
                                success: function (response) {
                                    console.log(response); // Afficher la réponse dans la console
                                }
                            });
                        }
                    }
                });
            });

            formSupprime.on('submit', function (event) {
                event.preventDefault(); // Empêcher le formulaire de se soumettre normalement

                // Soumettre le formulaire via AJAX
                $.ajax({
                    url: formSupprime.attr('action'), // Récupérer l'URL d'action du formulaire
                    type: formSupprime.attr('method'), // Récupérer la méthode de soumission du formulaire
                    data: formSupprime.serialize(), // Sérialiser les données du formulaire
                    success: function (response) { // Fonction de succès
                        alert(response); // Afficher la réponse dans une boîte de dialogue

                        // Check if the uploaded file is XML
                        var uploadedFile = $('#file_a_ajouter')[0].files[0];
                        if (uploadedFile.type === 'text/xml') {
                            //une fois le fichier ajoute avec succes, executer les autres scripts
                            $.ajax({
                                url: '../modeles/supprimer_BaseDeDonnee.php',
                                type: 'POST',
                                success: function (response) {
                                    console.log(response); // Afficher la réponse dans la console
                                }
                            });

                            $.ajax({
                                url: '../modeles/ajouter_BaseDeDonnee.php',
                                type: 'POST',
                                success: function (response) {
                                    console.log(response); // Afficher la réponse dans la console
                                }
                            });
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>