<?php
    if (isset($_POST["filtretext"])) {
        // Récupérer le nom du fichier sans l'extension
        $nomFichierSansExtension = pathinfo($_POST["fic"], PATHINFO_FILENAME);

        // Chemin vers l'image en ajoutant l'extension .xml
        $cheminLien = "../DATA/" . $nomFichierSansExtension . ".xml" ;

        // Vérifier si le fichier image existe sinon pas afficher le bouton
        if(file_exists($cheminLien)) {
            // Afficher le bouton de téléchargement
            echo '<a class="download" href="' . $cheminLien . '" download="' .$cheminLien . '">Télécharger au format XML</a>';
        }
    }
?>
