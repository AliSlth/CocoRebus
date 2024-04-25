<?php
if (isset($_POST["id"])) {
    // Récupérer l'ID de l'élément cliqué
    $id = $_POST["id"];

    // Construire le chemin du fichier à partir de l'id
    $cheminImage = "../DATA/" . $id . "-001.jpg"; 

    // Afficher le bouton de téléchargement
    echo '<a class="download" href="' . $cheminImage . '" download="' . $id . '">Télécharger au format JPG</a>';
}
?>

