<?php
//chemin du repertoire a parcourir 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //verifier si un fichier a supprimer a ete sectionne 
    if (isset($_POST['fichier_a_supprimer'])) {
        //chemin du repertoire a parcourir 
        $repertoire = '../DATA/';

        //recuperer le nom du fichier a supprimer depuis le formulaire 
        $file_a_supprimer = $_POST['fichier_a_supprimer'];

        //verifier si le fichier a supprimer existe 
        if (file_exists($repertoire . $file_a_supprimer)) {
            //supprimer le fichier 
            if (unlink($repertoire . $file_a_supprimer)) {
                $message = "Le fichier  $file_a_supprimer a été supprimé avec succès. 💁🏻‍♀️👌🏻";
            } else {
                echo "Erreur lors de la suppression du fichier $file_a_supprimer.";
            }
        } else {
            $$message = "Le fichier $file_a_supprimer n'existe pas. 🤷🏻‍♀️";
        }
    } else {
        $message = "Aucun fichier à supprimer sélectionné. 🤦🏻‍♀️";
    }
} else {
    $message = "Le formulaire n'a pas ete soumis.";
}

echo $message
    ?>