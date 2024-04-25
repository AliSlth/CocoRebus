<?php
if (isset($_POST["searchTerm"])) {
    // Récupérer l'id de l'élément cliqué
    $searchTerm = $_POST["searchTerm"]; #enlever la fin .xml
    // On retire .xml pour obtenir le nom de base
    // Construction du chemin à partir de l'id
    $cheminLien = "../DATA/" . $searchTerm; 

    // Afficher le bouton de téléchargement 
    echo '<a class="download" href="' . $cheminLien . '" download="' . $searchTerm . '">Télécharger au format XML</a>';
}
?>

