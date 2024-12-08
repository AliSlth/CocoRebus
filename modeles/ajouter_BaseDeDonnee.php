<?php


//connexion a la base de données
$servername = "localhost";
$bdname = "";
$username = "";  // a remplir
$motdepass = ""; //a remplir

$message = "";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$bdname", $username, $motdepass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    processFiles($pdo); // Appel de la fonction avec la connexion PDO
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
function processFiles($pdo)
{
    // Définition du répertoire des fichiers XML
    $repertoire = '../DATA/';

    // Définition du motif de correspondance pour les balises <title> et <bibl>
    $pattern1 = '/<title>(([^-]+)-([^-]+)-([^-]+)-([^-]+)-([^-]+)-([^<]+)-([^<]+))<\/title>/';
    $pattern2 = '/<bibl>([^<\s(]+)\s*\([^<]*<\/bibl>/';

    // Liste des temps possibles
    $temps_values = array('T3', 'T2', 'T1');

    // Parcours des fichiers XML dans le répertoire
    foreach (scandir($repertoire) as $xml_file) {
        // Ignorer les fichiers spéciaux
        if ($xml_file == '.' || $xml_file == '..') {
            continue;
        }

        try {
            // Construire le chemin complet du fichier XML
            $full_path = $repertoire . $xml_file;

            // Lire le contenu du fichier XML
            $xml = file_get_contents($full_path);

            // Initialiser les variables pour les données à extraire
            $id = $niveau = $eleve = $classe = $version = $annee = $corpus = '';

            // Initialiser les variables pour Temp, InterventionEn, Normalisation
            $temps_values_exported = $interventionEn = $normalisation = '';

            // Rechercher les données dans les balises <title> et <bibl>
            if (preg_match($pattern1, $xml, $matches)) {
                $id = $matches[1];
                $niveau = $matches[3];
                $eleve = $matches[7];
                $classe = $matches[5];
                $version = $matches[8];
                $annee = $matches[4];
            }

            if (preg_match($pattern2, $xml, $matches)) {
                $corpus = $matches[1];
            }

            // Charger le contenu XML dans un objet DOMDocument
            $dom = new DOMDocument();
            $dom->loadXML($xml);

            // Rechercher les balises <note> et extraire les informations nécessaires
            foreach ($dom->getElementsByTagName('note') as $note) {
                $resp = $note->getAttribute('resp');
                if ($resp == 'P') {
                    $interventionEn = "Oui";
                } else {
                    $interventionEn = "Non";
                }

                if ($resp == 'chercheur') {
                    $normalisation = "Oui";
                } else {
                    $normalisation = "Non";
                }
            }

            // Rechercher les balises <mod> et extraire les informations Temp
            foreach ($temps_values as $temp) {
                foreach ($dom->getElementsByTagName('mod') as $mod) {
                    if ($mod->hasAttribute('seq') && $mod->getAttribute('seq') == $temp) {
                        $temps_values_exported = $temp;
                        break 2; // Sortir des deux boucles foreach
                    }
                }
            }

            // Insérer les données extraites dans la base de données
            $sql = "INSERT INTO info_xml(ID, Niveau, Élève, Classe, Version, Année, Corpus,Temps,InterventionEn, Normalisation) VALUES ('$id', '$niveau', '$eleve','$classe', '$version', '$annee', '$corpus', '$temps_values_exported','$interventionEn','$normalisation')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id, $niveau, $eleve, $classe, $version, $annee, $corpus, $temps_values_exported, $interventionEn, $normalisation]);
            echo "Nouvel enregistrement créé avec succès";
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
            $message = "Accès impossible aux données !";
        }
    }
}
?>
