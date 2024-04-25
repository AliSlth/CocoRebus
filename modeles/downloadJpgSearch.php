<?php
if (isset($_POST["searchTerm"])) {
    // Récupérer la valeur envoyée par AJAX
    $searchTerm = $_POST["searchTerm"];
    $baseName = pathinfo($searchTerm, PATHINFO_FILENAME); 
    // Construction du chemin du fichier image sans .xml
    $cheminImage = "../DATA/" . $baseName . "-001.jpg";

    // Afficher le bouton de téléchargement
    echo '<a class="download" href="' . $cheminImage . '" download="' . $searchTerm . '">Télécharger au format JPG</a>';
}
?>


