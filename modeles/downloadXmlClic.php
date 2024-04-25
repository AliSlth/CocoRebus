<?php
if (isset($_POST["id"])) {
    // On récupère l'id de l'élément cliqué
    $id = $_POST["id"];

    // le chemin est construit à partir de l'id récupéré
    $cheminLien = "../DATA/" . $id . ".xml"; 

    //Création et affichage du bouton de téléchargement 
    echo '<a class="download" href="' . $cheminLien . '" download="' . $id . '">Télécharger au format XML</a>';
}
?>

