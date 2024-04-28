<?php
// Fonction pour valider XML par rapport au DTD
function xml_valider_contre_dtd($xmlContenu)
{
    // Créer un objet DOMDocument
    $doc = new DOMDocument();

    // Charger le contenu XML dans DOMDocument
    if (!$doc->loadXML($xmlContenu)) {
        return "Échec du chargement du contenu XML.";
    }

    // Chemin vers le fichier DTD
    $dtdFichier = "../normes.DTD";

    // Activer la gestion des erreurs internes
    libxml_use_internal_errors(true);

    // Charger le contenu du fichier DTD
    $contenuDtd = file_get_contents($dtdFichier);
    if ($contenuDtd === false) {
        return "Échec du chargement du fichier DTD.";
    }

    // Créer un fichier temporaire pour stocker le contenu du DTD
    $fichierDtdTemp = tempnam(sys_get_temp_dir(), 'dtd');
    if ($fichierDtdTemp === false) {
        return "Impossible de créer un fichier DTD temporaire.";
    }

    // Écrire le contenu du DTD dans le fichier temporaire
    if (file_put_contents($fichierDtdTemp, $contenuDtd) === false) {
        unlink($fichierDtdTemp);
        return "Impossible d'écrire le fichier DTD temporaire.";
    }

    // Valider le document par rapport au fichier DTD temporaire
    if ($doc->validate()) {
        unlink($fichierDtdTemp); // Supprimer le fichier DTD temporaire
        return true;
    } else {
        // Si la validation échoue, collectez et retournez les messages d'erreur
        $erreurs = libxml_get_errors();
        $messagesErreur = [];
        foreach ($erreurs as $erreur) {
            $messagesErreur[] = $erreur->message;
        }
        libxml_clear_errors();
        unlink($fichierDtdTemp); // Supprimer le fichier DTD temporaire
        return implode("\n", $messagesErreur);
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si un fichier a été sélectionné
    if (isset($_FILES['xml_a_ajouter']) && isset($_FILES['jpg_a_ajouter'])) {
        if ($_FILES['xml_a_ajouter']['error'] === UPLOAD_ERR_OK && $_FILES['jpg_a_ajouter']['error'] === UPLOAD_ERR_OK) {
            // Obtenir les noms des fichiers
            $nomFichierXML = pathinfo($_FILES['xml_a_ajouter']['name'], PATHINFO_FILENAME);
            $nomFichierJPG = pathinfo($_FILES['jpg_a_ajouter']['name'], PATHINFO_FILENAME);

            // Vérifier si les noms de fichier sont identiques
            if ($nomFichierXML !== $nomFichierJPG) {
                $message = "Les noms de fichier JPG et XML ne correspondent pas. 🙅🏻‍♀️Veuillez choisir des fichiers avec des noms identiques.";
            } else {
                // Obtenir les chemins temporaires des fichiers
                $cheminFichierTempXML = $_FILES['xml_a_ajouter']['tmp_name'];
                $cheminFichierTempJPG = $_FILES['jpg_a_ajouter']['tmp_name'];

                // Définir le répertoire de téléchargement sur le serveur
                $repertoireTelechargement = '../DATA/';

                // Définir les chemins finaux des fichiers sur le serveur
                $cheminFichierFinalXML = $repertoireTelechargement . $nomFichierXML;
                $cheminFichierFinalJPG = $repertoireTelechargement . $nomFichierJPG;

                // Valider et déplacer le fichier XML
                if (move_uploaded_file($cheminFichierTempXML, $cheminFichierFinalXML)) {
                    // Lire le contenu du fichier XML
                    $contenuXml = file_get_contents($cheminFichierFinalXML);

                    // Valider le fichier XML par rapport au schéma DTD
                    $resultatValidation = xml_valider_contre_dtd($contenuXml);
                    if ($resultatValidation !== true) {
                        // Supprimer le fichier XML et afficher un message d'erreur
                        unlink($cheminFichierFinalXML);
                        $message = "Le fichier XML ne respecte pas le schéma DTD spécifié : \n$resultatValidation";
                    } else {
                        // Valider et déplacer le fichier JPG
                        if (move_uploaded_file($cheminFichierTempJPG, $cheminFichierFinalJPG)) {
                            $message = "Les fichiers ont été téléchargés avec succès ! 💁🏻‍♀️👌🏻";
                        } else {
                            // Supprimer le fichier XML et afficher un message d'erreur
                            unlink($cheminFichierFinalXML);
                            $message = "Une erreur est survenue lors du téléchargement du fichier JPG. 🤦🏻‍♀️";
                        }
                    }
                } else {
                    $message = "Une erreur est survenue lors du téléchargement du fichier XML. 🤦🏻‍♀️";
                }
            }
        } else {
            $message = "Une erreur est survenue lors du téléchargement des fichiers. 🤦🏻‍♀️";
        }
    } else {
        $message = "Veuillez sélectionner à la fois un fichier XML et un fichier JPG. 🚫";
    }
} else {
    $message = "Aucune requête POST reçue.";
}

echo $message;
?>