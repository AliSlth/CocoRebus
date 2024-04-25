<?php
    if (isset($_POST["filtretext"])) {
        // Récupérer le nom du fichier sans l'extension
        $nomFichierSansExtension = pathinfo($_POST["fic"], PATHINFO_FILENAME);

        // Construction du chemin de l'image en ajoutant .jpg
        $cheminImage = "../DATA/" . $nomFichierSansExtension . "-001.jpg" ;

        // Vérifier si le fichier image existe
        if(file_exists($cheminImage)) {
            // Afficher le bouton de téléchargement
            echo '<a class="download" href="' . $cheminImage . '" download="' .$cheminImage . '">Télécharger au format JPG</a>';
        }
    }
?>
