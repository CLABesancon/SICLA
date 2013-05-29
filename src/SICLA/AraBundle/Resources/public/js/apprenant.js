jQuery(document).ready(function() {
	
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
	


});