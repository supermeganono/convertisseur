<?php
$tab = array(2,10,16);
if( !isset($_POST["frombase"]) || !isset($_POST["tobase"]) || !isset($_POST["enonce"]) || !isset($_POST["reponse"]) ){
	$retour["erreur"] = "Variable transmise incorrect.";
} elseif ( !in_array($_POST["frombase"],$tab) ){
	$retour["erreur"] = "Mauvaise base from"; 
} elseif ( !in_array($_POST["tobase"],$tab) ){
	$retour["erreur"] = "Mauvaise base to";
} else {

	$resultat = base_convert($_POST["enonce"], $_POST["frombase"], $_POST["tobase"]);
	if ( $resultat == $_POST["reponse"] ){
		$rand_tab[0] = "Bien joué !";
		$rand_tab[1] = "Monster Kill";
		$rand_tab[2] = "Le savoir est en toi ! Félicitation.";
		$rand_tab[3] = "T'arrête pas la ! T'es pas loin du record du monde !";
		$rand_tab[4] = "Celui la était trop facile pour toi non ?";
		$rand_tab[5] = "Encore un cadeau que je t'ai fait ! Ha lalala...";
		$rand_tab[6] = "Quand on est prof, on a pas le droit de jouer ! C'est de la triche !";
		$rand_tab[7] = "Sérieux t'es doué, t'as pensé à postulé à la NASA ?";
		$rand_tab[7] = "L'eurosa t'ouvrira grande ces portes !";

		$retour["ret_bonresultat"] = $rand_tab[array_rand($rand_tab)];
		// generation d'un nouvel excercice
		$retour["ret_enonce"] = mt_rand(10,150);
		$retour["ret_frombase"] = $tab[array_rand($tab)];

		if ( $retour["ret_frombase"] == 2 ){
			$sec_tab = array(10,16);
			$retour["ret_tobase"] = $sec_tab[array_rand($sec_tab)];
		} elseif ( $retour["ret_frombase"] == 10 ){
			$sec_tab = array(2,16);
			$retour["ret_tobase"] = $sec_tab[array_rand($sec_tab)];
		} else {
			$sec_tab = array(2,10);
			$retour["ret_tobase"] = $sec_tab[array_rand($sec_tab)];
		}
		
		$retour["triche"] = base_convert($retour["ret_enonce"], 10, $retour["ret_tobase"]);
		$retour["ret_enonce"] = base_convert($retour["ret_enonce"], 10, $retour["ret_frombase"]);

		// explication
		if ( $retour["ret_tobase"] == 2 ){
			$retour["ret_explication"] = "Veuillez convertir ".$retour["ret_enonce"]."(".$retour["ret_frombase"].") en binaire";
		} elseif ( $retour["ret_tobase"] == 10 ){
			$retour["ret_explication"] = "Veuillez convertir ".$retour["ret_enonce"]."(".$retour["ret_frombase"].") en decimal ";
		} else {
			$retour["ret_explication"] = "Veuillez convertir ".$retour["ret_enonce"]."(".$retour["ret_frombase"].") en octal ( hexadecimal )";
		}


	} else {
		$rand_tab[0] = "Repousse toujours tes limites, trouve la solution !";
		$rand_tab[1] = "Le savoir s'acquiert avec le temps, réessaye !";
		$rand_tab[2] = "Tomber pour mieux se relever ! Tu peux le faire !";
		$rand_tab[3] = "Tu as presque déglongué le serveur sur ce coup !";
		$rand_tab[4] = "Persévérance !";
		$rand_tab[5] = "Vérifiez votre réponse svp !";
		$rand_tab[6] = "Avant de devenir un beau chêne, on a tous été un gland !";
		$rand_tab[7] = "Invoque la force du Jedi si nécessaire !";
		$rand_tab[7] = "Perséver tu devra !";
		$retour["ret_badresultat"] = $rand_tab[array_rand($rand_tab)];
	}

}

// renvoi en Json
header('Content-type: application/json;');
echo json_encode($retour);
?>
