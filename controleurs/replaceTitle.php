<?php
        //Si le form filtretext a été envoyé
        if (isset($_POST["filtretext"])) {
            //récupérer le nom ddu fichier dans la variable $selectedFile
            $selectedFile = $_POST["fic"];
            // Afficher le nom du fichier sélectionné = sert à afficher le nom du fichier
            print '<p>'. $selectedFile . '</p>';
        }
?>