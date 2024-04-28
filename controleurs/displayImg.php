<?php
    //vérification form filtretext (celui qui filtre par liste)
    if (isset($_POST["filtretext"])) {
        // Récupérer le nom du fichier sans l'extension pour construire le chemin
        $nomFichierSansExtension = pathinfo($_POST["fic"], PATHINFO_FILENAME);

        // Chemin vers l'image en ajoutant l'extension .jpg
        $cheminImage = "../DATA/" . $nomFichierSansExtension . "-001.jpg" ;

        // Vérifier si le fichier image existe
        if(file_exists($cheminImage)) {
            // Afficher l'image
            print '<img class="image" src="' . $cheminImage . '" alt="Version jpg" />';
        } else {
            //Message si image pas trouvée
            print "Aucune image correspondante. Impossible d'afficher l'image";
        }
    }

?>
