jQuery(document).ready(function() {
	// Liste des demandes d'hébergement :
	var demande_select = $("#demande_select").val();
 if( demande_select==1){
			   $(".logement").show();
			   $(".famille_accueil").hide();
			   $(".semi_independance").hide();
			   $("#Demandes").val('1');
		   } else if( demande_select=='2'){
			   $(".logement").hide();
			   $(".famille_accueil").show();
			   $(".semi_independance").hide();
			   $("#Demandes").val('2');
		   }else if( demande_select==3){
			   $(".logement").hide();
			   $(".famille_accueil").hide();
			   $(".semi_independance").show();
			   $("#Demandes").val('3');
		   }else if( demande_select==4){
			    $(".logement").show();
			   $(".famille_accueil").show();
			   $(".semi_independance").show();
			   $("#Demandes").val('4');
		   }

	$('#Demandes').change(function(){
			   
       var type=$(this).find("option:selected").attr('value');
	  if(type==1){
			   $(".logement").show();
			   $(".famille_accueil").hide();
			   $(".semi_independance").hide();
			  $.cookie("demande_select","1");
		   } else if(type=='2'){
			    $(".logement").hide();
			   $(".famille_accueil").show();
			   $(".semi_independance").hide();
			   $("#Demandes").val('2');
			   $.cookie("demande_select","2");
		   }else if(type==3){
			  $(".logement").hide();
			   $(".famille_accueil").hide();
			   $(".semi_independance").show();
			   $.cookie("demande_select","3");
		   }else if(type==4){
			    $(".logement").show();
			   $(".famille_accueil").show();
			   $(".semi_independance").show();
			   $.cookie("demande_select","4");
		   }
	});

	// On masque automatiquement les div concernant les détails si la valeur cochée est non au chargement de la page
	// Utile pour les view_apprenant, étant donné qu'il n'y a pas de changement, la valeur est cochée par défaut
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[handicapPhysique]']:checked").val()=="0"){
			$(".handicapPhysique").hide();
		}
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[traitementMedical]']:checked").val()=="0"){
			$(".traitementMedical").hide();
		}
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[allergiesAnimaux]']:checked").val()=="0"){
			$(".allergiesAnimaux").hide();
		}
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[allergiesAlimentaires]']:checked").val()=="0"){
			$(".allergiesAlimentaires").hide();
		}
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[allergiesAutres]']:checked").val()=="0"){
			$(".allergiesAutres").hide();
		}
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[voeuxPersonnels]']:checked").val()=="0"){
			$(".detailVoeuxPersonnels").hide();
		}
	if($("input[name='sicla_arabundle_apprenantdemandelogementtype[loisirsParticuliers]']:checked").val()=="0"){
			$(".detailLoisirsParticuliers").hide();
		}	
		
	/// On masque/affiche le div concernant les détails de chaque élément en fonction de ce qui est sélectionné
	
	$('#sicla_arabundle_apprenantdemandelogementtype_handicapPhysique').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[handicapPhysique]']:checked").val()=="1"){
			$(".handicapPhysique").show();
		}else{
			$(".handicapPhysique").hide();
		}
	});
	$('#sicla_arabundle_apprenantdemandelogementtype_traitementMedical').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[traitementMedical]']:checked").val()=="1"){
			$(".traitementMedical").show();
		}else{
			$(".traitementMedical").hide();
		}
	});	
	$('#sicla_arabundle_apprenantdemandelogementtype_allergiesAnimaux').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[allergiesAnimaux]']:checked").val()=="1"){
			$(".allergiesAnimaux").show();
		}else{
			$(".allergiesAnimaux").hide();
		}
	});	
	$('#sicla_arabundle_apprenantdemandelogementtype_allergiesAlimentaires').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[allergiesAlimentaires]']:checked").val()=="1"){
			$(".allergiesAlimentaires").show();
		}else{
			$(".allergiesAlimentaires").hide();
		}
	});
	$('#sicla_arabundle_apprenantdemandelogementtype_allergiesAutres').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[allergiesAutres]']:checked").val()=="1"){
			$(".allergiesAutres").show();
		}else{
			$(".allergiesAutres").hide();
		}
	});
	$('#sicla_arabundle_apprenantdemandelogementtype_voeuxPersonnels').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[voeuxPersonnels]']:checked").val()=="1"){
			$(".detailVoeuxPersonnels").show();
		}else{
			$(".detailVoeuxPersonnels").hide();
		}
	});	
	$('#sicla_arabundle_apprenantdemandelogementtype_loisirsParticuliers').change(function() {
		if($("input[name='sicla_arabundle_apprenantdemandelogementtype[loisirsParticuliers]']:checked").val()=="1"){
			$(".detailLoisirsParticuliers").show();
		}else{
			$(".detailLoisirsParticuliers").hide();
		}
	});	
	
	/// Affichage des champs du formulaire en fonction du type d'hébergement souhaité.
	
	var valeur_select=$("#sicla_arabundle_apprenantdemandelogementtype_typeHebergement").find("option:selected").attr('value');
	if(valeur_select=="Famille d'accueil")
		{
			$(".famille_accueil").show();
			$(".semi-independance").hide();
			$('.logement').hide();
		}
	if(valeur_select=="Semi indépendance")
		{
			$(".famille_accueil").hide();
			$(".semi-independance").show();
			$('.logement').hide();
		}
	if(valeur_select=="Logement")
		{
			$(".famille_accueil").hide();
			$(".semi-independance").hide();
			$('.logement').show();
		}	
	$('#sicla_arabundle_apprenantdemandelogementtype_typeHebergement').change(function() {
		var valeur_select=$("#sicla_arabundle_apprenantdemandelogementtype_typeHebergement").find("option:selected").attr('value');
	if(valeur_select=="Famille d'accueil")
		{
			
			$(".semi-independance").hide();
			$('.logement').hide();
			$(".famille_accueil").show();
		}
	if(valeur_select=="Semi indépendance")
		{
			$(".famille_accueil").hide();
			$('.logement').hide();
			$(".semi-independance").show();
		
		}
	if(valeur_select=="Logement")
		{
			$(".famille_accueil").hide();
			$(".semi-independance").hide();
			$('.logement').show();
		}	
	});	
	
	var hbgt_select=$('.type_hebergement').text();
	if(hbgt_select=="Famille d'accueil")
		{
			$(".semi-independance").hide();
			$('.logement').hide();
			$(".famille_accueil").show();
		}
	if(hbgt_select=="Semi indépendance")
		{
			$(".famille_accueil").hide();
			$('.logement').hide();
			$(".semi-independance").show();
			
		}
	if(hbgt_select=="Logement")
		{
			$(".famille_accueil").hide();
			$(".semi-independance").hide();
			$('.logement').show();
		}	
});