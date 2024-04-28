<?php
// Vérifier si l'ID a été envoyé via la méthode POST (requête ajax)
if (isset($_POST["searchTerm"])) {
    // Récupérer la valeur envoyée par AJAX
    $searchTerm = $_POST["searchTerm"];
    // Construire le chemin du fichier à partir de l'ID
    $fichier = "../DATA/" . $searchTerm ;

    // Vérifier si le fichier correspondant à l'ID existe
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
