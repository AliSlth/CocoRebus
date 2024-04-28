# Projet CocoRebus

Groupe : DU Xinyi et SOUNALATH Alissa
Le projet E-Calm vise à gérer un corpus de productions scolaires allant du CP au lycée, comprenant des scans de copies accompagnés de transcriptions au format XML-TEI.

## Fonctionnalités disponibles

#### Page d'accueil
* Accéder à la page de connexion
* Consulter les données sans être connecté

#### Page de connexion
* Se connecter avec des identifiants (message d'erreur si login inexistant ou vide)

#### Page de consultation
* Accéder à la page d'application
* Accéder à la page de gestion
* Se déconnecter

#### Page de gestion
* Importation de fichiers dans un autre format (jpg ou xml)
* Ajout dans la base de donnée
* Supprimer un fichier du serveur
* Suppression dans la base de donnée

#### Page d'application
* Consulter les données
* Connexion à la base de données
* Retour arrière vers la page de consultation (utilisateur connecté) ou d'accueil (si non connecté)
* Rechercher un texte dans une barre de recherche 
* Sélectionner un texte dans un menu déroulant
* Filtrer les textes dans la base de données selon des critères
* Afficher le texte avec plusieurs options d’affichage
* Afficher l’image jpg
* Zoomer sur l'image 
* Télécharger un fichier (jpg ou xml)


#### AUTRE 
* Mentions légales 
* Architecture MVC
* Messages d'erreurs


### Accès au site
* url : i3l.univ-grenoble-alpes.fr/~sounalaa/page_accueil.php
* identifiants : user : xinyi / mdp : 1234
* navigateur : Mozilla 

### Technologies utilisées : 
* Serveur i3L
* PHPmyAdmin
* PHP
* jQuery
* HTML / CSS
* Javascript

## Fonctions 

## Page d'accueil


La page d'acceuil se compose de deux div (partie en haut le logo de notre projet et parite en bas les deux buttons des opérations. 

La première button en haut permet aux utilisateurs d'accéder à la page de connexion. L'autre en bas sert à sauter directement à la page d'application. 


### se connecter 
Fonctionnement: cliquer sur les bouttons 

<form action="URL"> permet d'envoyer les données du formulaire lorsqu'il est soumis.
se connecter: dans "vues/page_de_connexion.php" se trouve la page 


### consulter sans se connecter 
Fonctionnement: cliquer sur les bouttons 

<form action="URL"> permet d'envoyer les données du formulaire lorsqu'il est soumis.
consulter sans connexion: dans "vues/application.php" se trouve la page 



## Page de connexion


La page de connexion se compose de trois parties: le logo, les deux boîtes de saisie et une boutton de connexion. 

Dès que l'utilisateur clique la boutton de connexion, les données saisies dans la boîte du compte de login et celle du mot de passe seront récupérées. Et ils seront transmises dans le module "verifLogin.php" qui permet de comparer les données saisies avec les données stockées dans la base de données à l'aide du module d'accès à la base de données: "connexion.php"


### saisie les informations de connexion 
Fonctionnement: taper les informations de connexion dans la boîte de compte de login et la boîte de mot de passe. 

On tape les informations de login, et on clique sur le bouton de se connecter pour envoyer les données de la part de l'utilsateur au serveur. 


### comparer les données saisies avec les données de la base de données
Fonctionnement: Dès que les données saisies de la part de l'utilisateur sont envoyées au serveur, la variable $login conserve les données du compte, la variable mdp conserve les données du mot de passe. À l'aide de ajax, on ouvre ensuite le script "module/veriflogin.php" qui gère la vérification du mot de passe et son compte correspondant. 

Si le mot de passe saisi peut être retrouvé dans la base de données et les données de login saisies correspond bien à son login sur la base de données, une variable renvoyée au script principal de cette page, et ce qui permet de sauter à la page de consultation dans "vues/page_de_consultation.php"

Si le mot de passe saisi ne peut pas être retrouvé dans la base de données, une autre variable renvoyée au script principal de cette page, et ce qui permet de s'afficher une phrase "Mot de passe incorrect" en bas de la boîte d'opération. 

Si aucune information sont repérée, une nouvelle variable renvoyée au script principal de cette page, et ce qui permet de s'afficher une phrase "Login inexistant" en bas de la boîte d'opération. 


### connecter automatiquement à la base de donnée
Fonctionnement: Dès que les données saisies sont envoyées et stockées dans des variables au script "verifLogin.php", il connecte automatique au scirpt "connexion.php" dans module, qui permet d'accéder à la base de données. 




## Page de consultation


La page de consultation se compose de deux div: le logo et les choix d'opération. 

Si l'utilisateur clique sur le bouton de Gérer les fichiers, on a l'accès à la page de filtrage dans le script "application.php". 
Si l'utilisateur clique sur le bouton de Consulter les données, on a l'accès à la page de consultation dans le script "page_de_gestion.php"
Si l'utilsateur clique sur le bouton de Déconnecter, on a l'accès à la page d'acceuil dans le script "logout.php". 


### Gérer les fichiers 
Fonctionnement: cliquer sur le boutton

<form action="URL"> permet d'envoyer les données du formulaire lorsqu'il est soumis.
se connecter: dans "vues/application.php" se trouve la page 


### Consulter les données 
Fonctionnement: cliquer sur le boutton 

<form action="URL"> permet d'envoyer les données du formulaire lorsqu'il est soumis.
consulter les données: dans "vues/page_de_gestion.php" se trouve la page 


### Se déconnecter
Fonctionnement: cliquer sur le boutton

<form action="URL"> permet d'envoyer les données du formulaire lorsqu'il est soumis.
se déonnecter: dans "module/logout.php" qui nettoye les annciennes données saisies de login et renvoie à la page d'acceuil.  




## Page de gestion


La page de gestion est structurée autour de deux div principaux contenus dans la boîte d'opération <div class="bas"> : la partie gauche est dédiée à l'opération d'ajout de fichiers, tandis que la partie droite concerne la suppression de fichiers.

La partie gauche permet à l'utilisateur d'envoyer une paire de fichiers (au format JPG et XML) vers le serveur. La partie droite, quant à elle, permet de supprimer des fichiers du serveur. Toutes les deux fonctions permettent de mettre à jour les métadonnées dans la base de données.


### Ajouter une paire de fichiers (au format JPG et XML)
Fonctionnement: Ajouter une paire de fichiers de même nom au format JPG et XML. 

Dans la boîte d'ajout, deux champs de type "file" sont présents. À l'aide de contraintes spécifiées avec l'attribut "accept", les deux barres d'ajout de fichiers n'acceptent que les fichiers au format XML et JPEG.


### Supprimer des fichiers (au format JPG et XML) 
Fonctionnement: Supprimer n'importe quel fichier du serveur. 


### Vérifier les noms des fichiers ajoutés 
Fonctionnement: Lorsque l'utilisateur clique sur le bouton "Submit", le système vérifie immédiatement les noms des fichiers pour déterminer s'ils sont identiques.

Si les noms sont identiques, les deux fichiers seront ajoutés sur le serveur;  sinon l'opération échoue. 


### Suppression des anciennes données dans la base de données
Fonctionnement: Avant de stocker les nouvelles métadonnées des fichiers XML, toutes les anciennes données sont supprimées de la base de données pour garantir l'actualité des informations.

Dans l'élement d'Url, on place le script "module/supprimer_BaseDeDonnee.php" qui accède à la base de données et supprime toutes les anciennes données dans le tableau de "info_xml" qui stocke les métadonnées suivantes des fichiers XML: ID, Niveau, Élève, Classe, Version, Année, Corpus,Temps,InterventionEn, Normalisation. 


### Traitement des fichiers XML
Fonctionnement: Après l'ajout des fichiers, tous les fichiers au format XML sont parcourus afin de retirer les métadonnées et de les stocker dans la base de données.

* **Pour ID, Niveau, Élève, Classe, Version, Année
Expression réguière utilisée: /<title>(([^-]+)-([^-]+)-([^-]+)-([^-]+)-([^-]+)-([^<]+)-([^<]+))<\/title>/

* **Pour Corpus 
Expression régulière utilisée: /<bibl>([^<\s(]+)\s*\([^<]*<\/bibl>/

* **Pour Temps
L'élément et l'attribue que l'on chercheent: <mod seq=>...</mod>

Si l'élément "T3" est rencontré, sa valeur est directement ajoutée comme valeur de "Temps". Si "T3" n'est pas trouvé mais que "T2" est rencontré, alors la valeur de "Temps" est définie comme "T2". Si ni "T3" ni "T2" ne sont trouvés, la valeur de "Temps" est remplie avec "T1".

* **Pour InterventionEn et Normalisation
L'élément et l'attribue que l'on chercheent: <note resp>...</note>

Si l'élément "P" est rencontré, alors la valeur de "Intervention" est automatiquement définie comme "Oui". Sinon, elle est définie comme "Non".

Si l'élément "chercheur" est rencontré, alors la valeur de "Intervention" est automatiquement définie comme "Oui". Sinon, elle est définie comme "Non".




## Page d'application 


La page d’application est constituée de deux div (partie gauche et partie droite).

La partie gauche gère tout ce qui est affichage du texte, des options de textes, affichage des images. Les affichages sont disponibles avec deux façons, php, lorsqu’on envoie un formulaire on envoie la requête, et lorsqu’on clique sur un élément mis sur écoute, on envoie la requête AJAX pour exécuter le php. On a 3 formulaires qui permettent d’accéder aux textes: le premier qui permet de rechercher un texte par le nom grâce à une barre de recherche, le deuxième de sélectionner un texte parmi une liste contenue dans une barre déroulante, et le dernier qui est un filtre qui trie et renvoie les textes qui correspondent aux critères sélectionnés.

La partie droite va servir à rechercher des textes selon des critères dans la base de données et c’est ici qu’on pourra choisir le texte.


### Rechercher un texte dans une barre de recherche 
Fonctionnement : Entrer le nom du texte (entier ou partiel), la barre de recherche suggère le nom entier du fichier. Cliquer sur le fichier voulu puis sur le bouton Rechercher.

Dans un élément ```dataset```, on place le script ```controleurs/listeFichiers.php``` qui explore le répertoire spécifique (DATA), extrait les noms des fichiers XML qui s'y trouvent, et affiche ces fichiers comme options dans un formulaire pour sélectionner un fichier XML. L'utilisateur peut insérer le début du nom du texte et le nom complet est suggéré. Le formulaire est géré par le bouton ayant  ```l'id "#filtrernom" ```

### Afficher les textes (options disponibles) dans un sélecteur déroulant
Fonctionnement : Cliquer sur la barre du sélecteur déroulant et sélectionner un texte puis appuyer sur Rechercher.

Dans un élément ```select```, on place le script ```controleurs/listeFichiers.php``` qui explore le répertoire spécifique (DATA), extrait les noms des fichiers XML qui s'y trouvent, et affiche ces fichiers comme options dans un formulaire pour sélectionner un fichier XML. Le formulaire est géré par le bouton ayant  ```l'id "#filtretext" ```

### Filtrer les textes dans la base de données selon des critères
Fonctionnement : Cliquer sur le sélecteur déroulant du critère à filtrer puis cliquer sur Filtrer. Plusieurs choix sont possibles.

* **Pour les valeurs possibles de filtre (voir le div <div class = "selectedfilters">)** 
On se connecte à la  base de données et grâce à une requête on extrait les valeurs possibles UNIQUES. On fait ça pour chaque colonne dans la base de données (Eleve, Classe, Niveau, Année…)
ex. de requête pour extraires les valeurs possibles du filtre sur le Niveau```SELECT DISTINCT Niveau from info_xml```. Les résultats sont affichés dans une liste déroulante HTML de type ```<select>```.

* **Pour le filtrage :**
```modeles/filterResults.php```
Les valeurs des champs du formulaire sont récupérées avec```$_POST```.
ex. $Niveau = $_POST["level"]; $Classe = $_POST["grade"]; etc...
La requête SQL qui affiche les textes répondant aux critères **est construite en fonction des valeurs des champs soumis, chaque condition étant ajoutée à la requête si le champ correspondant n'est pas vide.**
La requête SQL est préparée et exécutée via PDO, et les résultats sont récupérés avec ```fetchAll()```.
Les résultats sont affichés dans un tableau HTML à l'aide d'une boucle ```foreach```.



### Changement du titre lorsqu’on change de texte 

Comme on a plusieurs formulaires, on a une méthode différente pour chaque formulaire. 


* Dans “scripts/main.js” : On écoute les éléments ayant la **classe “link”** (càd les éléments dans le tableau) 
```$('.link').on("click", function()```  **récupérer l'id de l'élément cliqué et remplacer le titre** avec un ```        $("#title").text(id récupérée)```

* Dans “scripts/main.js” : On écoute l’élément ayant l’**id “filtrernom”** (càd le bouton rechercher à côté de la barre de navigation).
```$('#filtrernom’).on("click", function() ```  récupérer la **valeur de l'élément séléctionné après clic sur "Rechercher"** et remplace le titre avec un ```$("#title").text(valeur récupérée)```

* Dans “controleurs/replaceTitle.php" 
```replaceTitle.php``` récupère le titre d'un fichier sélectionné **lorsque le formulaire est soumis** (clic sur le deuxième "Rechercher").  Il extrait la valeur du champ "fic" (qui contient le nom du fichier sélectionné) de la requête POST et l'assigne à la variable $selectedFile qui remplacera le titre.

### Affichage du texte
Comme pour l'affichage du titre, on a plusieurs méthodes assez similaires.

* Dans “scripts/main.js” : On écoute l’élément ayant l’**id** “filtrernom” (càd le bouton rechercher à côté de la barre de navigation).
```$('#filtrernom’).on("click", function() ``` envoie une requête AJAX avec le script ```controleurs/displayTextSearch.php``` qui utilise la valeur récupérée et **construit ensuite le chemin du fichier XML correspondant à cet valeur**, puis lit et print son contenu ligne par ligne. 


* Dans “scripts/main.js” : On écoute les éléments ayant la classe “link” (càd les éléments dans le tableau) 
```$('.link').on("click", function()``` envoie une requête AJAX avec le script ```controleurs/displayTextClic.php``` qui utilise l'id et **construit ensuite le chemin du fichier XML correspondant à cet id**, puis lit et print son contenu ligne par ligne. 

* Dans “controleurs/displayTextFilter.php" 
```displayTextFilter.php``` est activé lors de la soumission du formulaire et **construit le chemin complet du fichier XML à partir du répertoire de données et du nom de fichier récupéré** depuis le menu déroulant et lit et affiche le fichier ligne par ligne.



### Affichage du texte au format JPG 
Fonctionnement : Cliquer sur le bouton afficher la version image.

Même principe que l'affichage du titre et du texte,  dans un premier temps on récupère l'id / valeur du champ sélectionné / nom du fichier puis on construit le chemin complet du fichier à partir des informations extraites. 

* Dans “scripts/main.js” : On écoute l’élément ayant l’**id** “filtrernom” (càd le bouton rechercher à côté de la barre de navigation).
```$('#filtrernom’).on("click", function() ``` envoie une requête AJAX avec le script ```controleurs/displayImgSearch.php``` qui utilise la valeur récupérée et **construit ensuite le chemin du fichier JPG correspondant à cet valeur**

* Dans “scripts/main.js” : On écoute les éléments ayant la classe “link” (càd les éléments dans le tableau) 
```$('.link').on("click", function()``` envoie une requête AJAX avec le script ```controleurs/displayImgClic.php``` qui utilise l'id et **construit ensuite le chemin du fichier JPG correspondant à cet id**

* Dans “controleurs/displayImg.php" 
```displayImg.php``` est activé lors de la soumission du formulaire et **construit le chemin complet du fichier JPG à partir du répertoire de données et du nom de fichier récupéré** depuis le menu déroulant

L'image est chargée dans un div dédié à la zone d'affichage de l'image, d'abord mise en tant que ```hidden``` par défaut. Il suffit d'appuyer sur le bouton **Afficher la version image** qui sert à afficher ou masquer grâce à un ```toggle switch```. 

### Télécharger la version JPG ou XML du texte
Fonctionnement : Cliquer sur le bouton "Télécharger au format...".

Même principe que l'affichage du titre et du texte ou affichage de la version JPG  dans un premier temps on récupère l'id / valeur du champ sélectionné / nom du fichier puis on construit le chemin complet du fichier à partir des informations extraites. 

* Dans “scripts/main.js” : On écoute l’élément ayant l’**id** “filtrernom” (càd le bouton rechercher à côté de la barre de navigation).
```$('#filtrernom’).on("click", function() ``` envoie une requête AJAX avec le script **Téléchargement de l'image** ```modeles/downloadJpgSearch.php``` 
**Téléchargement du XML** ```modeles/downloadXmlSearch.php```

* Dans “scripts/main.js” : On écoute les éléments ayant la classe “link” (càd les éléments dans le tableau) 
```$('.link').on("click", function()``` envoie une requête AJAX avec le script **Téléchargement de l'image** ```modeles/downloadJpgClic.php```
**Téléchargement du XML** ```modeles/downloadXmlClic.php```

* Dans “modeles/downloadJpg.php" 
**Téléchargement de l'image** ```modeles/downloadJpg.php```
**Téléchargement du XML** ```modeles/downloadXml.php```

Puis on affiche un boutton de téléchargement tel que : 
```<a class="download" href="' . $cheminImage . '" download="' .$cheminImage . '">Télécharger au format JPG </a>```


### Afficher le texte selon plusieurs options d'affichage 
Fonctionnement : Cocher une option après l'autre. 

Dans "scripts/main.js"
* En mettant sur écoute les options d'affichage avec jQuery, on peut afficher la version 1, la version Enseignant, la version Chercheur ou les deux.
* Le texte original est stocké dans une variable à chaque rechargement du texte (recherche avec la barre de recherche ou par sélection de texte par la liste complète ou clic dans le tableau). À chaque fois qu'on clique sur une option d'affichage, on traite le texte original et affiche le texte modifié dans la zone dédiée à l'affichage du texte.

Il y a plusieurs fonctions qui capture des éléments spécifiques et permettent de soit afficher en couleur ou masquer les éléments en agissant sur le CSS.

**Expressions régulières :**
* ```regex = /(?:<text>)([\s\S]*?)(?:<\/text>)/;``` Capture les éléments entre les balises <text>
* ```regex = /(?:<teiheader>)([\s\S]*?)(?:<\/teiheader>)/;``` Capture les éléments entre les balises <teiHeader>
* ```regex = /(?:<back>)([\s\S]*?)(?:<\/back>)/g;```  Capture les éléments entre les balises <back>
* ```regex = /(?<!<mod type="del" seq="T1" resp="E">)<del>(.*?)<\/del>/g;``` Regex qui capture les balises <del> sauf celles qui ne sont pas entourées de <mod type="del" seq="T1" resp="E">
* ```regex = /(?:<add>|<reg>)(.*?)(?:<\/add>|<\/reg>)/g;``` Capturer les ajouts et interventions chercheurs = entre les balises <add> ou <reg>
*  ```regex = /<(?:reg)>(.*?)<\/(?:reg)>/g;``` Capture les interventions des chercheurs entre <reg>
*  ```regex = /((<[^<>]*resp="P"[^<>]*>(.*?)<\/[^<>]*>)|(?:<mod type="subst" resp="E" seq="T1">)(.*?)(?:<\/mod>)|(?:<back>)([\s\S]*?)(?:<\/back>))/g```     Capture les balises dont le resp = P + celles de type <mod type = "subst"...>




**Fonctions qui appliquent du CSS au contenu capturé :**
* function ```hideTeiHeader()``` cache le contenu entre les balises ```<teiHeader>``` entre ```<span>```
* function ```hideBack()``` cache le contenu entre les balises ```<back>``` entre ```<span>```
* function ```removeDelTags()```sert à afficher le contenu sans les <del> sauf ceux de l'élève (pour garder le visuel barré = celle de l'élève en T1)
* function ```hideAddReg()``` masque le contenu des interventions des professeurs entre ```<span>```
* function ```hideResearcher()``` masque les interventions de type ```<reg>``` des chercheurs
* function ```highlightP()``` met en valeur les ajouts des professeurs avec ```<span style="color: red;">```
* function ```highlightCher()``` met en valeur les interventions des chercheurs ```<span style="color: yellow;">```
* function ```highlightProfCher()```  met en valeur les interventions des chercheurs et des chercheurs ```<span style="color: yellow;">```


** Selon l'affichage voulu, les fonctions sont apliquées :**
Par exemple : 
```
   function displayV1() {
        resetText();
        hideTeiHeader();
        removeDelTags();
        hideBack();
        hideAddReg();
    }
```
Ici, on cache les éléments entre <teiHeader>, on enlève les éléments <del> du professeur et les commentaires entre <back> ainsi que les interventions chercheurs = laisse la version 1 

#### Autre
### Retour arrière vers la page de consultation (utilisateur connecté) ou d'accueil (si non connecté)

* En cliquant sur le titre en haut à gauche,  le script renvoie à la ```page_de_consultation.php```. Au début de script est ajouté une vérification de la valeur ```connected``` qui est initialisée avec la valeur ```true``` uniquement lorsque l'utilisateur s'est connecté. 
Si la valeur == false, l'utilisateur est redirigé vers la page_accueil.php avec un  ```header```


#### Améliorations

* Pour la partie d'options d'affichage sur textes : afficher les commentaires à l'endroit où il a été réellement ajouté sur la copie
* L'affichage des images ne gère pas le cas où il y a plusieurs images.
  

