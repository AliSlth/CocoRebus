<?php
// Fonction pour valider le XML par rapport au DTD
function xml_validate_against_dtd($xmlContent)
{
    // Chemin vers le fichier DTD
    $dtdFile = 'normes.DTD'; // Remplacez cela par le chemin vers votre fichier DTD

    // Créer un document DOM pour le XML
    $doc = new DOMDocument();

    // Activer la gestion des erreurs XML
    libxml_use_internal_errors(true);

    // Charger le fichier XML
    if (!$doc->loadXML($xmlContent)) {
        // Si le chargement échoue, récupérer les erreurs et les renvoyer
        $errors = libxml_get_errors();
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->message;
        }
        libxml_clear_errors();
        return implode("\n", $errorMessages);
    }

    // Charger le fichier DTD
    if (!$doc->validateOnParse) {
        $doc->load($dtdFile);
    }

    // Valider le document par rapport au DTD
    if ($doc->validate()) {
        return true;
    } else {
        // Si la validation échoue, récupérer les erreurs et les renvoyer
        $errors = libxml_get_errors();
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->message;
        }
        libxml_clear_errors();
        return implode("\n", $errorMessages);
    }
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si un fichier a été sélectionné
    if (isset($_FILES['file_a_ajouter']) && $_FILES['file_a_ajouter']['error'] === UPLOAD_ERR_OK) {
        // Définir le répertoire de téléchargement sur le serveur
        $uploadDirectory = '../DATA/';
        // Récupérer le nom du fichier
        $fileName = $_FILES['file_a_ajouter']['name'];
        // Récupérer l'extension du fichier
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Vérifier si l'extension est autorisée (jpg ou xml)
        if ($fileExtension == 'jpg' || $fileExtension == 'xml') {
            // Récupérer le chemin temporaire du fichier
            $fileTmpName = $_FILES['file_a_ajouter']['tmp_name'];
            // Définir le chemin final du fichier sur le serveur
            $targetFilePath = $uploadDirectory . $fileName;

            // Si c'est un fichier XML, vérifier sa validité par rapport au schéma DTD
            if ($fileExtension == 'xml') {
                // Charger le fichier XML
                $xmlContent = file_get_contents($fileTmpName);

                // Valider le fichier XML par rapport au DTD
                $validationResult = xml_validate_against_dtd($xmlContent);
                if ($validationResult !== true) {
                    $message = "Le fichier XML ne respecte pas le schéma DTD spécifié : \n$validationResult";
                } else {
                    // Déplacer le fichier du répertoire temporaire vers le répertoire de téléchargement
                    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                        $message = "Le fichier $fileName a été téléchargé avec succès ! 💁🏻‍♀️👌🏻";
                    } else {
                        $message = "Une erreur est survenue lors du téléchargement du fichier. 🤦🏻‍♀️";
                    }
                }
            } else {
                // Pour les fichiers JPG, déplacer simplement le fichier
                if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                    $message = "Le fichier $fileName a été téléchargé avec succès ! 💁🏻‍♀️👌🏻";
                } else {
                    $message = "Une erreur est survenue lors du téléchargement du fichier. 🤦🏻‍♀️";
                }
            }
        } else {
            $message = "L'extension du fichier n'est pas autorisée. Veuillez télécharger un fichier avec une extension .jpg ou .xml. 🚫";
        }
    } else {
        $message = "Aucun fichier n'a été envoyé. 🤷🏻‍♀️";
    }
} else {
    $message = "Aucune requête POST reçue.";
}

echo $message;
?>