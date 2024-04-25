<?php


//connexion a la base de donne
$servername = "localhost";
$bdname = "CocoRebus";
$username = "xinyi";  // a remplire
$motdepass = "xinyiDU47!"; //a remplire 

try {
    $pdo = new mysqli($servername, $username, $motdepass, $bdname);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
    print "Accès impossible à la base !<br/>\n";
}


// vider la table 
try {
    // Préparer la requête de suppression
    $sql = "DELETE FROM info_xml";
    $stmt = $pdo->prepare($sql);
    // Exécuter la requête
    $stmt->execute();
    // Vérifier si la suppression a réussi
    if ($stmt->affected_rows > 0) {
        echo "Toutes les données ont été supprimées avec succès.";
    } else {
        echo "La table était déjà vide.";
    }
} catch (Exception $e) {
    // Afficher un message d'erreur en cas d'échec de la suppression
    echo 'Erreur : ' . $e->getMessage();
}

// Fermeture de la connexion à la base de données
$pdo->close();
?>