<?php
// Vérifier si l'ID a été envoyé via la méthode POST (requête ajax)
if (isset($_POST["id"])) {
    // Récupérer l'ID de l'élément cliqué
    $id = $_POST["id"];

    // Construire le chemin du fichier à partir de l'ID
    $cheminImage = "../DATA/" . $id . "-001.jpg";

    // Vérifier si le fichier image existe
    if(file_exists($cheminImage)) {
        // Afficher l'image + affecter la classe 'image'
        print '<img class="image" src="' . $cheminImage . '" alt="Version jpg" />';
    } else {
        print "Aucune image correspondante. Impossible d'afficher l'image";
    }
}
?>
