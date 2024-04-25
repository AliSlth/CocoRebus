<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=CocoRebus", 'sounalaa', 'Grenoblemimo10');
    //print "La base est ouverte ! <br/> \n";
} catch (Exception $e) {
    die("Erreur: " . $e->getMessage());
    print "Accès impossible à la base ! <br/> \n";
}
?>