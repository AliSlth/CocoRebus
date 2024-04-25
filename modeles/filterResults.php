<?php
    if (isset($_POST["filtrage"])) {
        // Connexion à la base de données
        include_once("../modeles/connexion_base.php");
        // Script de connexion

        try {
            // Récupérer les valeurs des champs sélectionnés
            $Niveau = $_POST["level"];
            $Élève = $_POST["student"];
            $Classe = $_POST["grade"];
            $Version = $_POST["version"];
            $Année = $_POST["year"];
            $Corpus = $_POST["corpus"];
            $Intervention = $_POST["inter"];
            $InterventionEn = $_POST["profinter"];
            $Normalisation = $_POST["norm"];

            // Initialisation de la requête SQL
            $requete = "SELECT * FROM info_xml WHERE 1=1"; //requête sans condition de filtrage supplémentaire

            // Ajout des conditions basées sur les valeurs des champs
            if (!empty($Niveau)) {
                $requete .= " AND Niveau = '$Niveau'";
            }
            if (!empty($Élève)) {
                $requete .= " AND Élève = '$Élève'";
            }
            if (!empty($Classe)) {
                $requete .= " AND Classe = '$Classe'";
            }
            if (!empty($Version)) {
                $requete .= " AND Version = '$Version'";
            }
            if (!empty($Année)) {
                $requete .= " AND Année = '$Année'";
            }
            if (!empty($Corpus)) {
                $requete .= " AND Corpus = '$Corpus'";
            }
            if (!empty($Intervention)) {
                $requete .= " AND Temps = '$Intervention'";
            }
            if (!empty($InterventionEn)) {
                $requete .= " AND InterventionEn = '$InterventionEn'";
            }
            if (!empty($Normalisation)) {
                $requete .= " AND Normalisation = '$Normalisation'";
            }
            
            //exécutino requête 
            $recup = $pdo->prepare($requete);
            $recup->execute();

            //récup resultatss
            $textes = $recup->fetchAll();

            // Affichage des résultats dans un tableau HTML
            foreach ($textes as $texte) {
                // Affichage des lignes répondant aux critères
                ?>
                <tr>
                    <td class="link" id="<?php echo $texte['ID']; ?>"> <?php echo $texte['ID']; ?> </td>
                    <td id="<?php echo $texte['Niveau']; ?>"> <?php echo $texte['Niveau']; ?> </td>
                    <td> <?php echo $texte['Élève']; ?> </td>
                    <td> <?php echo $texte['Classe']; ?> </td>
                    <td> <?php echo $texte['Version']; ?> </td>
                    <td> <?php echo $texte['Année']; ?> </td>
                    <td> <?php echo $texte['Corpus']; ?> </td>
                    <td> <?php echo $texte['Temps']; ?> </td>
                    <td> <?php echo $texte['InterventionEn']; ?> </td>
                    <td> <?php echo $texte['Normalisation']; ?> </td>
                    <td> <?php echo $texte['CatégorieFaute']; ?> </td>
                </tr>
                <?php
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }}
?>             