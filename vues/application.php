<DOCTYPE html>
    <?php
        session_start();
        include_once("../modeles/connexion_base.php");
    ?>
    <head>
        <meta charset="utf-8"/>
        <title> CocoRebus </title>
        <link rel="stylesheet" href="../css/page_application.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <script type="text/javascript" src="../scripts/jquery-3.7.1.min.js"></script>
    </head>

    <header>
        <div id = "logoTitre">
            <!--Titre le clic sur cet élément permet un retour vers la page de consultation ou page accueil si user pas co !-->
            <h1>
                <a href="page_de_consultation.php"> Cocorpus </a>
            </h1>
            
            <!--Logo !-->
            <img src="../medias/coconut.png" alt="Logo Cocorpus"/>

        </div>
    </header>
    

    <body>
        <!--INTERFACE (un grand div contenant deux div - un pour la partie gauche un pour la partie droite) !-->
        <div class = "interface">

<!-----------------------------------------------------------------!-->
            <!-- ZONE GAUCHE (affichage texte, image) !-->
            <div id = "leftarea" class = "leftarea">

                <!-- ZONE TITRE !-->
                <div id = "title">
<!--------------------------------------------------------------------------------------------!-->
                    <!-- Récupère le titre si le formulaire filtretext a été envoyé !-->
                    <?php include "../controleurs/replaceTitle.php";?>
<!-------------------------------------------------------------------------------------------------------!-->     
                </div>

                <!-- ZONE AFFICHAGE TEXTE ! DEUX CAS-->
                <div id = "textarea" class = "textarea">
                    <!-- Récupère le titre si le formulaire filtretext a été envoyé  !-->
                    <!-- Récupération via le filtre sur les noms !-->
                    <div id="textareadisplayed" readonly> <!-- readonly pour que le texte ne soit pas modifiable !-->
                        <?php include ("../controleurs/displayTextFilter.php");?>
                    </div>
                    <!-- Récupération via un clic dans le tableau VOIR PARTIE SCRIPT!-->
                </div>

                <!-- ZONE FILTRES SUR TEXTES !-->
                <div id = "textareafilter">
                    <fieldset>
                        <legend> Options d'affichage </legend>
                        <div>
                            <input type="radio" id="v1" name="filtercheck" value="v1" checked/>
                            <label for="v1">Version 1</label>
                        </div>
                        <div>
                            <input type="radio" id="intervEns" name="filtercheck" value="intervEns"/>
                            <label for="intervEns">Intervention Enseignant</label>
                        </div>
                        <div>
                            <input type="radio" id="intervCher" name="filtercheck" value="intervCher"/>
                            <label for="intervCher">Intervention Chercheur</label>
                        </div>
                        <div>
                            <input type="radio" id="intervEnsCher" name="filtercheck" value="intervEnsCher"/>
                            <label for="intervEnsCher">Enseignant et Chercheur (Cliquez d'abord sur Chercheur) </label>
                        </div>

                    </fieldset>
                </div>

                <!-- ZONE BOUTONS AFFICHER IMAGE, IMPORTER TEXTE ET JPG !-->
                <div id = "buttonOption" class = "buttonOption">
                    <!--bouton afficher le texte au format jpg !-->
                    <div id = "displayImg">
                        <input id ="displayImg" type="button" value="Afficher la version image" />
                    </div>
                    <!--Affichage du bouton pour télécharger le fichier au format xml!-->
                    <div id = "downloadXml">
                        <?php include ("../modeles/downloadXml.php"); ?>
                    </div>
                    <!--Affichage du bouton pour télécharger le fichier au format xml!-->
                    <div id = "downloadJpg">
                        <?php include ("../modeles/downloadJpg.php"); ?>
                    </div>
                </div>

                <!-- ZONE AFFICHAGE PHOTO !-->
                <div id="imgArea" /hidden>
                    <?php include ("../controleurs/displayImg.php"); ?>
                    <?php include ("../controleurs/displayImgClic.php"); ?>
                </div>


            </div>

<!-----------------------------------------------------------------!-->
            <!-- ZONE DROITE !-->
            <div class = "rightarea">
                
            <!-- ZONE DE FILTRES !-->
                <div class="rightfiltercontent"> 

                    <!--Titre !-->
                    <h1> Filtres </h1>

                    <!-- FILTRES POSSIBLES !--> 
                    <div class = "rightfilterlist">
<!----------------------------------------------------------------------------------------------------------------->                        
                        <!-- RECHERCHE PAR NOM DANS LA BARRE DE RECHERCHE  !-->
                        <div class = "searchbyname">

                            <label for="textname-choice">Rechercher un texte</label>
                            <input list="textname-list" id="textname-choice" name="textname-choice" />
                            <datalist id="textname-list">
                                <?php include("../controleurs/listeFichiers.php"); ?>
                            </datalist>
                            <input class ="button" type="submit" id ="filtrernom" name="filtrernom" value="Rechercher"/><br/>
                        </div>


<!----------------------------------------------------------------------------------------------------------------->                        
                        <!-- RECHERCHE PAR SELECTION DU TEXTE DANS LA LISTE DE TEXTE !-->
                        <div class = "browselist">
                            <div class="namefilter">
                                <!-- FORMULAIRE SELECTION TEXTE:  pour sélectionner un texte à partir du nom !-->
                                <form id="titleform" method="POST" action="application.php">
                                    <p>Rechercher dans la liste </p>
                                    <select id="fic" name="fic">
                                        <?php include("../controleurs/listeFichiers.php"); ?>
                                    </select>
                                    <!-- BOUTON DE VALIDATION pour la liste de texte complète!-->
                                    <input class ="button" type="submit" id ="filtretext" name="filtretext" value="Rechercher"/><br/>
                                </form>

<!----------------------------------------------------------------------------------------------------------------->
                            </div>
                        </div>

                        <!-- RECHERCHE PAR CRITERES !-->
                        <div class = "searchbyfilter">

                            <!-- FILTRES sélectionnés !-->
                            <div class = "selectedfilters">

                                <form id="filtrage" method="POST" action="application.php">
                         
                                <!-- ELEVE !-->
                                    <div id = "levelfilter">
                                        <p>Élève</p>
                                        <select id = "student" name = "student">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Élève FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Élève']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>



                                <!-- NIVEAU ELEVE !-->
                                    <div id = "levelfilter">
                                        <p>Niveau</p>
                                        <select id = "level" name = "level">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Niveau FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Niveau']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>

                                <!-- CLASSE ELEVE !-->
                                    <div id="gradefilter">
                                                    <p>Classe</p>
                                                    <select id = "grade" name = "grade">
                                                        <option value=""></option> <!-- Option vide -->
                                                        <?php
                                                            $requete = 'SELECT DISTINCT Classe FROM info_xml'; #prend seulement les valeurs uniques
                                                            $recuptexte = $pdo->prepare($requete);
                                                            $recuptexte->execute();
                                                            $textes = $recuptexte->fetchAll();
                                                            
                                                            foreach ($textes as $texte) {
                                                                ?>
                                                                <option>
                                                                    <?php echo $texte['Classe']; ?>
                                                                </option>
                                                                <?php
                                                            }?>
                                                    </select>
                                            </div>

                                <!-- ANNEE !-->
                                    <div id="yearfilter">
                                        <p>Année</p>
                                        <select id ="year" name = "year">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Année FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Année']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>

                                <!-- CORPUS !-->
                                    <div id="corpusfilter">
                                        <p>Corpus</p>
                                        <select id = "corpus" name = "corpus">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Corpus FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Corpus']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>
                            
                                <!-- NORMALISATION !-->
                                    <div id="normalisationfilter">
                                        <p>Normalisation</p>
                                        <select id = "norm" name = "norm">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Normalisation FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Normalisation']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>

                                    <!-- VERSION !-->
                                    <div id="versionfilter">
                                        <p>Version</p>
                                        <select id = "version" name = "version">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Version FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Version']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>

                                <!--TEMPS INTERVENTION !-->
                                    <div id="intervfilter">
                                        <p>Temps d'intervention </p>
                                        <select id = "inter" name = "inter">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT Temps FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['Temps']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>

                                  
                                <!-- TEMPS ENSEIGNANT !-->
                                    <div id="proffilter">
                                        <p>Temps d'interv. Ens.</p>
                                        <select id = "profinter" name = "profinter">
                                            <option value=""></option> <!-- Option vide -->
                                            <?php
                                                $requete = 'SELECT DISTINCT InterventionEn FROM info_xml'; #prend seulement les valeurs uniques
                                                $recuptexte = $pdo->prepare($requete);
                                                $recuptexte->execute();
                                                $textes = $recuptexte->fetchAll();
                                                
                                                foreach ($textes as $texte) {
                                                    ?>
                                                    <option>
                                                        <?php echo $texte['InterventionEn']; ?>
                                                    </option>
                                                    <?php
                                                }?>
                                        </select>
                                    </div>

                                    <!-- BOUTON DE VALIDATION DES CRITERES SELECTIONNES !-->
                                    <div id = "validation">
                                        <input class ="button" type="submit" id = "filtrage" name="filtrage" value="Filtrer"/><br/>
                                    </div>
                                </form>
                            </div>                   
                    </div>
                </div>


            <!------------------------------ RESULTATS !------------------------------>
                <div id = "resultdiv">

                    <table id="textlisttable" class="textlistresult">
                        <tr>
                            <td>Texte </td>
                            <td>Niveau </td>
                            <td>Élève </td>
                            <td>Classe </td>
                            <td>Version</td>
                            <td>Année</td>
                            <td>Corpus</td>
                            <td>Temps d'intervention</td>
                            <td>Intervention Enseignant</td>
                            <td>Normalisation</td>
                        </tr>
<!----------------------------------------------------------------------------------------------------------------->
                        <!-- Lignes contenant les résultats après filtrage selon les critères!-->
                        <?php include("../modeles/filterResults.php"); ?>
<!----------------------------------------------------------------------------------------------------------------->
                    </table>    
                </div>
            </div>
        </div>
         </div>
        <footer>
            <a id="mentions" href="../vues/mentionsLegales.php"><p> Mentions légales </p></a>
        </footer>

    </body>

<!----------------------------------------------------------- INTERACTIVITE !---------------------------------------------------------------------------------->
    <script src="../scripts/main.js"></script>

</html>