jQuery(document).ready(function() {

	var value_famille = $("#famille_select").val();	
	var statut_famille = $("#statut_select").val();	

	if (value_famille == 1) {
		$(".famille_accueil").show();
		$(".semi_independance").show();
		$('#TypeFamilles').val('1');

	} else if (value_famille == 2) {
		$(".famille_accueil").hide();
		$(".semi_independance").show();
		$('#TypeFamilles').val('2');

	} else if (value_famille == '3') {
		$(".famille_accueil").show();
		$(".semi_independance").hide();
		$('#TypeFamilles').val('3');
	}
	
	if (statut_famille == 1) {
		$(".disponible").show();
		$(".indisponible").hide();
		$(".attente").hide();
		$(".proposition_ok").hide();
		$(".affectation_ok").hide();
		$('#StatutFamilles').val('1');

	} else if (statut_famille == 2) {
		$(".disponible").hide();
		$(".indisponible").show();
		$(".attente").hide();
		$(".proposition_ok").hide();
		$(".affectation_ok").hide();
		$('#StatutFamilles').val('2');

	} else if (statut_famille == '3') {
		$(".disponible").hide();
		$(".indisponible").hide();
		$(".attente").show();
		$(".proposition_ok").hide();
		$(".affectation_ok").hide();
		$('#StatutFamilles').val('3');
		
	} else if (statut_famille == '4') {
		$(".disponible").hide();
		$(".indisponible").hide();
		$(".attente").hide();
		$(".proposition_ok").show();
		$(".affectation_ok").hide();
		$('#StatutFamilles').val('4');
		
	} else if (statut_famille == '5') {
		$(".disponible").hide();
		$(".indisponible").hide();
		$(".attente").hide();
		$(".proposition_ok").hide();
		$(".affectation_ok").show();
		$('#StatutFamilles').val('5');
	}



	$('#TypeFamilles').change(function() {

		var type_hbgt = $(this).find("option:selected").attr('value');
		if (type_hbgt == 1) {
			$(".famille_accueil").show();
			$(".semi_independance").show();
			$("#famille_select").val('1');
			$.cookie("famille_selectionee", "1");
		} else if (type_hbgt == 2) {
			$(".famille_accueil").hide();
			$(".semi_independance").show();
			$("#famille_select").val('2');
			$.cookie("famille_selectionee", "2");
		} else if (type_hbgt == '3') {
			$(".famille_accueil").show();
			$(".semi_independance").hide();
			$("#famille_select").val('3');
			$.cookie("famille_selectionee", "3");
		}
	});
	
	$('#StatutFamilles').change(function() {

		var statut_famille = $(this).find("option:selected").attr('value');
		if (statut_famille == 1) {
			$(".disponible").show();
			$(".indisponible").hide();
			$(".attente").hide();
			$(".proposition_ok").hide();
			$(".affectation_ok").hide();
			$("#statut_select").val('1');
			$.cookie("statut_select", "1");
			
		} else if (statut_famille == 2) {
			$(".disponible").hide();
			$(".indisponible").show();
			$(".attente").hide();
			$(".proposition_ok").hide();
			$(".affectation_ok").hide();
			$("#statut_select").val('2');
			$.cookie("statut_select", "2");
			
		} else if (statut_famille == '3') {
			$(".disponible").hide();
			$(".indisponible").hide();
			$(".attente").show();
			$(".proposition_ok").hide();
			$(".affectation_ok").hide();
			$("#statut_select").val('3');
			$.cookie("statut_select", "3");
			
		}else if (statut_famille == '4') {
			$(".disponible").hide();
			$(".indisponible").hide();
			$(".attente").hide();
			$(".proposition_ok").show();
			$(".affectation_ok").hide();
			$("#statut_select").val('4');
			$.cookie("statut_select", "4");
			
		}else if (statut_famille == '5') {
			$(".disponible").hide();
			$(".indisponible").hide();
			$(".attente").hide();
			$(".proposition_ok").hide();
			$(".affectation_ok").show();
			$("#statut_select").val('5');
			$.cookie("statut_select", "5");
			
		}
		
	});

});

/*
 * 
 * 	   
 
 
 */