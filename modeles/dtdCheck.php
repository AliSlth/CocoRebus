<?php
function validerDocumentXML($cheminFichierXML, $cheminDTD) {
    // Activer les erreurs libxml
    libxml_use_internal_errors(true);
    
    // Créer un nouveau document XML
    $xml = new DOMDocument();
    
    // Charger le document XML à partir du chemin spécifié
    $xml->load($cheminFichierXML);
    
    // Valider le document XML par rapport à la DTD spécifiée
    if ($xml->validate()) {
        return "Le document est valide par rapport à la DTD.";
    } else {
        // Si le document n'est pas valide, récupérer les erreurs de validation
        $erreurs = [];
        foreach (libxml_get_errors() as $erreur) {
            $erreurs[] = $erreur->message;
        }
        return "Le document n'est pas valide par rapport à la DTD : " . implode(', ', $erreurs);
    }
}

$cheminFichierXML = ;
$cheminDTD = '../DATA/normes.v2.dtd';

$resultatValidation = validerDocumentXML($cheminFichierXML, $cheminDTD);
echo $resultatValidation;
?>
