   
//-------------------------------------------------------------------------------------------------------------------//
    //Lors du click sur le bouton valider depuis la liste complète de textes
    function getTitle() {
        // Récupérer la valeur sélectionnée dans la liste déroulante
        let titleToDisplay = document.querySelector("#fic").value;
        // Mettre à jour le texte de l'élément avec l'ID "title" avec la valeur sélectionnée
        $("#title").text(titleToDisplay);
    }

//-------------------------------------------------------------------------------------------------------------------//
    // Met en valeur les éléments ayant la classe .link
    $(document).ready(function() {
        $('.link').hover(function(){
            $(this).addClass('hover');    
        },function(){
            $(this).removeClass('hover');    
        });
    });

    // Met en valeur les éléments ayant la classe button
    $(document).ready(function() {
        $('.button').hover(function(){
            $(this).addClass('hover');    
        },function(){
            $(this).removeClass('hover');    
        });
    });
//-------------------------------------------------------------------------------------------------------------------//
    //Evenement clic = rendre visible la zone contenant l'image
    $("#displayImg").on("click", function() {
            $("#imgArea").toggle();
        });

//-------------------------------------------------------------------------------------------------------------------//
// RECHERCHE PAR LE NOM DU TEXTE AVEC LA BARRE DE RECHERCHE
$('#filtrernom').on("click", function() {       
    // Récupérer la valeur du champ de recherche
    let termesRecherche = $('#textname-choice').val(); 

    if (termesRecherche) { 
        // Requête AJAX pour récupérer le texte correspondant depuis la base de données
        $.ajax({
            url: '../controleurs/displayTextSearch.php', 
            method: 'POST',
            data: { searchTerm: termesRecherche }, // Utiliser la même variable
            success: function(response) {
                $("#textareadisplayed").html(response); 
                originalText = document.getElementById('textareadisplayed').innerHTML;
                displayV1();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        // Requête AJAX pour récupérer l'image correspondante depuis la base de données
        $.ajax({
            url: '../controleurs/displayImgSearch.php', 
            method: 'POST',
            data: { searchTerm: termesRecherche }, 
            success: function(response) {
                $("#imgArea").html(response); // Afficher l'image
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        // Requête AJAX pour afficher le bouton de téléchargement XML
        $.ajax({
            url: '../modeles/downloadXmlSearch.php', 
            method: 'POST',
            data: { searchTerm: termesRecherche }, 
            success: function(response) {
                $("#downloadXml").html(response); // Afficher le lien de téléchargement XML
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        // Requête AJAX pour afficher le bouton de téléchargement JPG
        $.ajax({
            url: '../modeles/downloadJpgSearch.php', 
            method: 'POST',
            data: { searchTerm: termesRecherche }, 
            success: function(response) {
                $("#downloadJpg").html(response); // Afficher le lien de téléchargement JPG
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    } else {
        console.error("Le terme de recherche est vide."); // Message d'erreur si la recherche est vide
    }
});
//-------------------------------------------------------------------------------------------------------------------//
// RECUPERE LE TEXTE correspondant à l'ID de l'élément cliqué depuis la base de données
    $('.link').on("click", function() {       
        // Récupérer l'ID de l'élément cliqué
        let idElement = $(this).attr("ID");
        // On remplace le texte titre avec la valeur de l'id correspondant
        $("#title").text(idElement); 

        // Requête AJAX pour récupérer le texte correspondant depuis la base de données
        $.ajax({
            url: '../controleurs/displayTextClic.php', // Chemin vers le script PHP qui récupère le texte depuis la base de données
            method: 'POST',
            data: {id: idElement}, // Envoyer l'ID de l'élément cliqué au script PHP
            success: function(response) {
                // Mettre à jour le contenu de la zone de texte avec le texte récupéré depuis la base de données
                $("#textareadisplayed").html(response);
                //Stocker le texte original dans une variable
                originalText = document.getElementById('textareadisplayed').innerHTML;
                //Traitement sur le texte : afficher la version 1 par défaut
                displayV1();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        // Requête AJAX pour récupérer l'image correspondante depuis la base de données
        $.ajax({
            url: '../controleurs/displayImgClic.php', // Chemin vers le script PHP qui récupère l'image depuis la base de données
            method: 'POST',
            data: {id: idElement}, // Envoyer l'ID de l'élément cliqué au script PHP
            success: function(response) {
                // Mettre à jour le contenu de la zone d'affichage de l'image avec l'image récupérée depuis la base de données
                $("#imgArea").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        
        // Requête AJAX pour afficher le bouton de téléchargement avec le lien 
        $.ajax({
            url: '../modeles/downloadXmlClic.php', // Chemin vers le script PHP qui récupère l'image depuis la base de données
            method: 'POST',
            data: {id: idElement}, // Envoyer l'ID de l'élément cliqué au script PHP
            success: function(response) {
                // Mettre à jour le contenu de la zone d'affichage de l'image avec l'image récupérée depuis la base de données
                $("#downloadXml").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

            // Requête AJAX pour afficher le bouton de téléchargement avec le lien 
        $.ajax({
            url: '../modeles/downloadJpgClic.php', // Chemin vers le script PHP qui récupère l'image depuis la base de données
            method: 'POST',
            data: {id: idElement}, // Envoyer l'ID de l'élément cliqué au script PHP
            success: function(response) {
                // Mettre à jour le contenu de la zone d'affichage de l'image avec l'image récupérée depuis la base de données
                $("#downloadJpg").html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    
//-------------------------------------------------------------------------------------------------------------------//
    //Initialiser une variable qui stockera le texte original qu'on utilisera à chaque changement de filtre pour éviter de modifier le texte directement 
    var originalText; 

    //RECUPERATION DU TEXTE DANS LA VARIABLE originalText
    document.addEventListener("DOMContentLoaded", function() {
        //Stocker le texte original dans une variable
        originalText = document.getElementById('textareadisplayed').innerHTML;
        displayV1(); // par défaut, le texte se charge et affiche le filtre sur version 1 
        //console.log(originalText);
    });



    // Fonction pour récupérer le texte actuel dans #textareadisplayed
    function getCurrentText() {
        return document.getElementById('textareadisplayed').innerHTML;
    }

    // Fonction pour réécrire le texte d'origine dans #textareadisplayed
    function resetText() {
        document.getElementById('textareadisplayed').innerHTML = originalText;
    }
//-------------------------------------------------------------------------------------------------------------------//

//-------------------------------------------------------------------------------------------------------------------//
//FONCTION QUI CACHE LE CONTENU ENTRE <teiheader> = métadonnées
    function hideTeiHeader() {
        // Sélectionner le texte entre les balises
        var message = getCurrentText();
        var regex = /(?:<teiheader>)([\s\S]*?)(?:<\/teiheader>)/; //Sélectionne tout ce qu'il y a entre <teiHeader>
        // Rechercher tous les éléments correspondants dans le message
        var teiHeaderContent = message.replace(regex, function(match, content) {
            // style CSS pour chaque elt capturé
            return '<span style="display:none;">' + match + '</span>';
        });
        //console.log(teiHeaderContent);
        // Mettre à jour le contenu de l'élément avec le contenu de teiHeaderContent
        $('#textareadisplayed').html(teiHeaderContent);
    }

//-------------------------------------------------------------------------------------------------------------------//
//FONCTION QUI CACHE LE CONTENU ENTRE <back> = commentaire rpof
    function hideBack() {
        // Sélectionner le texte entre les balises
        var message = getCurrentText();
        // Regex qui capture tout ce qu'il y a entre <back>
        var regex = /(?:<back>)([\s\S]*?)(?:<\/back>)/g; //séléctionne les élt entre <back>
        // Rechercher tous les éléments correspondants dans le message
        var teiHeaderContent = message.replace(regex, function(match, content) {
            // style CSS pour chaque elt capturé
            return '<span style="display:none;">' + match + '</span>';
        });
        console.log(teiHeaderContent);
        // màj du contenu de la zone
        $('#textareadisplayed').html(teiHeaderContent);
    }

//-------------------------------------------------------------------------------------------------------------------//
//FONCTION SUPPRESSION BALISES <del> pour afficher seulement celles où les élèves ont supprimés en T1 pour pouvoir afficher les mots barrés 
    function removeDelTags() {
        var message = getCurrentText();
        // Regex qui capture les balises <del> qui ne sont pas entourées de <mod type="del" seq="T1" resp="E"> = laisser celles qui sont de l'élève
        var regex = /(?<!<mod type="del" seq="T1" resp="E">)<del>(.*?)<\/del>/g;
        // Remplacer toutes les balises <del> par leur contenu
        var updatedMessage = message.replace(regex, function(match, content) {
            // Retourner le contenu capturé sans les balises <del> ciblées
            return content;
        });
        // màj du contenu de la zone 
        $('#textareadisplayed').html(updatedMessage);
    }

//-------------------------------------------------------------------------------------------------------------------//
//CACHER

//FONCTION QUI CACHE LES ELEMENTS AJOUTES (profs + chercheurs)
    function hideAddReg() {
        var message = getCurrentText();
        // Expression régulière pour capturer les termes entre les balises <add> ou <reg>
        var regex = /(?:<add>|<reg>)(.*?)(?:<\/add>|<\/reg>)/g;
        var termes = message.match(regex);
        //console.log(termes);
            message = message.replace(regex, function(match, content) {
            // style CSS pour chaque elt capturé
            return '<span style="display:none">' + content + '</span>';
            });
            //màj contenu dans la zone
            $('#textareadisplayed').html(message);
        }

//FONCTION CACHE ELEMENT DES CHERCHEURS
    function hideResearcher() {
        var message = getCurrentText();
        // Expression régulière pour capturer les termes entre les balises <reg>
        var regex = /<(?:reg)>(.*?)<\/(?:reg)>/g;
        var termes = message.match(regex);
        //console.log(termes);
            message = message.replace(regex, function(match, content) {
            //style CSS pour chaque elt capturé
            return '<span style="display:none">' + content + '</span>';
            });
            //màj contenu dans la zone
            $('#textareadisplayed').html(message);
        }
    
//-------------------------------------------------------------------------------------------------------------------//
    // FONCTION QUI MET EN VALEUR LES AJOUTS DES PROFS 
    function highlightP() {
        // Sélectionner les éléments entre les balises
        var message = getCurrentText();
        //capture les balises dont le resp = P + celles de type <mod type = "subst"...> 
        var regex = /((<[^<>]*resp="P"[^<>]*>(.*?)<\/[^<>]*>)|(?:<mod type="subst" resp="E" seq="T1">)(.*?)(?:<\/mod>)|(?:<back>)([\s\S]*?)(?:<\/back>))/g 
        // Recherche de tous les éléments correspondants dans le message
        message = message.replace(regex, function(match, content) {
            //style CSS pour chaque elt capturé
            return '<span style="color: red;">' + content + '</span>';
        });
            $('#textareadisplayed').html(message);        
    }

//-------------------------------------------------------------------------------------------------------------------//
    // FONCTION QUI MET EN VALEUR LES AJOUTS etc... DES CHERCHEURS
    function highlightCher() {
        // Sélectionner les éléments entre les balises
        var message = getCurrentText();
        //capture les elt dans des balises ayant chercheur comme resp
        var regex = /<(?:reg)>(.*?)<\/(?:reg)>/g;
        // Rechercher tous les éléments correspondants dans le message
        message = message.replace(regex, function(match, content) {
            //style CSS pour chaque elt capturé
            return '<span style="color: yellow;">' + content + '</span>';
        });
            $('#textareadisplayed').html(message);        
    }
//-------------------------------------------------------------------------------------------------------------------//
    // FONCTION QUI MET EN VALEUR PROF + CHERCHEUR
    function highlightProfCher() {
        var message = getCurrentText();
        
        // Expression régulière pour capturer les éléments pour les profs en rouge
        var regexProf = /((<[^<>]*resp="P"[^<>]*>(.*?)<\/[^<>]*>)|(?:<mod type="subst" resp="E" seq="T1">)(.*?)(?:<\/mod>)|(?:<back>)([\s\S]*?)(?:<\/back>))/g;
        // Mettre en valeur les éléments pour les profs en rouge
        message = message.replace(regexProf, function(match, content) {
            return '<span style="color: red;">' + content + '</span>';
        });    
        
        // Expression régulière pour capturer les éléments pour les chercheurs en jaune
        var regexCher = /<(?:reg)>(.*?)<\/(?:reg)>/g;
        // Mettre en valeur les éléments pour les chercheurs en jaune
        message = message.replace(regexCher, function(match, content) {
            return '<span style="color: yellow;">' + content + '</span>';
        });
        
        // Mettre à jour le contenu de l'élément
        $('#textareadisplayed').html(message);
    }


//-------------------------------------------------------------------------------------------------------------------//
    //Traitement pour afficher la version 1
    function displayV1() {
        resetText();
        hideTeiHeader();
        removeDelTags();
        hideBack();
        hideAddReg();
    }

    //Traitement pour afficher Intervention professeur 
    function intervEns() {
        resetText();
        hideTeiHeader();
        highlightP();
        hideResearcher();
    }

    //Traitement pour afficher Intervention chercheur 
    function intervCher(){
        resetText();
        hideTeiHeader();
        highlightCher();
    }

    //Traitement pour afficher intervention chercheur et professeur
    function intervEnsCher(){
        resetText();
        hideTeiHeader();
        highlightProfCher();
    }
    
//-------------------------------------------------------------------------------------------------------------------//
    
    //ECOUTEURS

    //clic sur le filtre v1
    document.getElementById('v1').onclick = function() {
        displayV1();
    };

    //clic sur le filtre intervention enseignant
    document.getElementById('intervEns').onclick = function() {
        //On réecrit le texte d'origine pour reset 
        intervEns();
    };

    //clic sur le filtre intervention chercheur
    document.getElementById('intervCher').onclick = function() {
        //On réecrit le texte d'origine pour reset 
        intervCher();
    };

    //clic sur le filtre intervention chercheur
    document.getElementById('intervEnsCher').onclick = function() {
        //On réecrit le texte d'origine pour reset 
        highlightProfCher();
    };        

//-------------------------------------------------------------------------------------------------------------------//
