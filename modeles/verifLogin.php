<?php
	session_start();

	if (isset($_POST['login']) and isset($_POST['mdp'])) {
		$login = $_POST['login'];
		$mdp = $_POST['mdp'];
		include_once("login_user.php");
		$requete = "SELECT mdp FROM contact WHERE login='$login'";
		// print $requete;
		if ($reponse = $pdo->query($requete)) {
			if ($enr = $reponse->fetch()) {
				// le login existe
				if ($mdp==$enr['mdp']) {
					// mdp utilisateur = celui de la BD
					print "3"; // authentification réussie
					$_SESSION['login']= $login;
					$_SESSION['connected'] = true;
				} else {
					print "2"; // mot de passe incorrect
				}
			} else {
				// le login est inexistant
				print "1";
			}	
		} else {
			print "Erreur de requête";
		}
	}
?>