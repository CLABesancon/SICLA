jQuery(document).ready(function() {

	var value_famille = $("#famille_select").val();	

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
	$('#TypeFamilles').change(function() {
		var type_hbgt = $(this).find("option:selected").attr('value');
		if (type_hbgt == 1) {
			$(".famille_accueil").show();
			$(".semi_independance").show();
			$.cookie("famille_selectionee", "1");
		} else if (type_hbgt == 2) {
			$(".famille_accueil").hide();
			$(".semi_independance").show();
			$.cookie("famille_selectionee", "2");
		} else if (type_hbgt == '3') {
			$(".famille_accueil").show();
			$(".semi_independance").hide();
			$.cookie("famille_selectionee", "3");
		}
	});
	
	

});

/*
 * 
 * 	   
 
 
 */