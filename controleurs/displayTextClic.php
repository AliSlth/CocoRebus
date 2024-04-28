<?php
// Vérifier si l'ID a été envoyé via la méthode POST (requête ajax)
if (isset($_POST["id"])) {
    // Récupérer l'ID de l'élément cliqué
    $id = $_POST["id"];

    // Construire le chemin du fichier à partir de l'id récupéré
    $fichier = "../DATA/" . $id . ".xml";

    // Vérifier si le fichier correspondant à l'id existe
    if (is_file($fichier)) {
        $hfic = fopen($fichier, "r");
        //on va imprimer les lignes
        while ($ligne = fgets($hfic)) {
            print "$ligne";
        }
        // mot d'explication au cas où le fichier ne se charge pas
    } else
        print "<p> Fichier $fichier inexistant </p>";
}
?>
