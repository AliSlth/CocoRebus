<?php
// Vérifier si l'ID a été envoyé via la méthode POST (requête ajax)
if (isset($_POST["searchTerm"])) {
    // Récupérer la valeur envoyée par AJAX
    $searchTerm = $_POST["searchTerm"]; #enlever la fin .xml
    // Retirer l'extension .xml pour obtenir le nom de base
    $baseName = pathinfo($searchTerm, PATHINFO_FILENAME); 
    // Construire le chemin du fichier image sans l'extension .xml
    $cheminImage = "../DATA/" . $baseName . "-001.jpg";

    
    // Vérifier si le fichier image existe
    if(file_exists($cheminImage)) {
        // Afficher l'image avec la classe 'image'
        print '<img class="image" src="' . $cheminImage . '" alt="Version jpg" />';
    } else {
        print "Aucune image correspondante. Impossible d'afficher l'image";
    }
}

?>
