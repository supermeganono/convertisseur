<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="author" content="Damocorp"/>
<meta name="publisher" content="Damocorp"/>
<meta name="Keywords" content="Exercice"/>
<meta name="Description" content="Apprendre en s'exerceant"/>
<title>S'exercer à la conversion</title>
<script src="jquery.js" type="text/javascript"></script>
<link href="global.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="centre">
	<div id="omg_triche"><img src="triche.jpg" width="550" height="400" alt="http://tout-nimporte-koi.skyrock.com/2320485189-Tricher-ou-ne-pas-tricher-telle-est-la-question.html" title="http://tout-nimporte-koi.skyrock.com/2320485189-Tricher-ou-ne-pas-tricher-telle-est-la-question.html" /></div>
	<div id="erreur" class="erreur"></div>
	<div id="reussite" class="reussite"></div>
	<div id="score"></div>
	<div class="enonce" id="explication">Veuillez convertir 369(10) en binaire</div>
	<div class="center">
	<form id="form_transfert">
		Réponse : <input type="text" id="reponse" name="reponse" />
		<input type="hidden" name="enonce" id="enonce" value="" />
		<input type="hidden" name="frombase" id="frombase" value="" />
		<input type="hidden" name="tobase" id="tobase" value="" />
		<input type="submit" name="submit" id="envoyeur" value="envoyer"  />
	</form>
	</div>
	<div id="triche"><input type="submit" id="triche" name"submit" value="tricher" /></div>
	<div id="resultat" class="resultat">Connection au serveur de la NASA en cours<span id="trucalacon">.</span></div>
</div>
</body>
</html>
<script type="text/javascript">
var nbr_triche = 0;
var essai = 0;
var essai_reussi = 0;
$("#form_transfert").submit(function(e){

    e.preventDefault();
    $("#omg_triche").hide();

	enonce = $("#enonce").val();
	frombase = $("#frombase").val();
	tobase = $("#tobase").val();
	reponse = $("#reponse").val();

    $.post(
        'ajax.php',
        {enonce:enonce,frombase:frombase,tobase:tobase,reponse:reponse},
        function(retour){
        	if ( typeof(retour.erreur) != "undefined" ){
        		$("#erreur").html(retour.erreur);
        	} else if ( typeof(retour.ret_badresultat) != "undefined" ){

        		$("#reussite").hide();

        		$("#erreur").html(retour.ret_badresultat);
        		$("#erreur").show();
        		essai++;
        		aff_resultat();

        	}  else if ( typeof(retour.ret_bonresultat) != "undefined" ){

        		$("#erreur").hide();

        		$("#reussite").html(retour.ret_bonresultat);
        		$("#reussite").show();

        		$("#enonce").val(retour.ret_enonce);
        		$("#frombase").val(retour.ret_frombase);
        		$("#tobase").val(retour.ret_tobase);
        		$("#explication").html(retour.ret_explication);
        		$("#reponse").val("");
        		triche = retour.triche;
        		essai++;
        		essai_reussi++;
        		aff_resultat();

        	}
        }
    );
});
$(function(){
	var rand = Math.round(Math.random(10,150)*100);
	$("#enonce").val(rand);
	$("#frombase").val(10);
	$("#tobase").val(2);
	$("#explication").html("Veuillez convertir "+rand+"(10) en binaire :");
	triche=rand.toString(2);
});
$("#triche").click(function(){
	$("#reponse").val(triche);
	$("#omg_triche").show();
	nbr_triche++;
	aff_resultat();
});
function troispoint(){
	var etat = $("#trucalacon").html();
	var longueur = 10;
	var lg_actuel = etat.length;

	if( lg_actuel < longueur ){
		$("#trucalacon").html(etat+".");
	} else {
		$("#trucalacon").html(".");
	}

}
function aff_resultat(){
	clearInterval(time_interval);
	if ( nbr_triche > 1 ){
		var aff_triche=nbr_triche+" triches.";
	} else {
		var aff_triche=nbr_triche+" triche.";
	}
	$("#resultat").html("Total de "+essai_reussi+"/"+essai+"<br />Dont : "+aff_triche);
}
var time_interval = setInterval("troispoint()",500);
</script>