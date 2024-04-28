<?php
    //on fouille dans le dossier DATA et à partir de DATA on extrait le nom des fichiers
    $chemin="../DATA/";
    if (is_dir("$chemin")){
    $doss = opendir("$chemin");
    while ($fichier = readdir($doss)) 
        /* on vérifie que c'est un fichier et qu'il finit par xml pour ne pas afficher les jpg dans la liste */
        if (is_file("$chemin".$fichier) && (pathinfo($fichier, PATHINFO_EXTENSION) === 'xml')){
        /* on affiche le nombre d'option correspondant avec comme valeur et id le nom du fichier */
        print "<option class='filelist' value='$fichier' id='$fichier'>$fichier</option>";
        }          
    }
?>