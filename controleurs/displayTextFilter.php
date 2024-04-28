<?php
//le code s'exécute si "$_POST("filtretext") existe
if (isset($_POST["filtretext"])) {
    $fichier = "../DATA/" . $_POST["fic"];
    //Bien vérifier que le fichier existe
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