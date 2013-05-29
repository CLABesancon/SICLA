jQuery(document).ready(function() {
		
	// demandes présentes au chargement de la page
	var tableau_id_demandes=new Array();
	var i=0;
	$('.demandes_logement').each(function() {
		tableau_id_demandes[i]=$(this).attr("id");
		i++;
	});
	
	// demandes présentes dans la liste déroulante
	var tableau_id_demandes_liste=new Array()
	i=0;
	
	$('#sicla_arabundle_affectationdemandetype_demande > *').each(function(){
		tableau_id_demandes_liste[i]=$(this).attr("value");
		i++;
	});
	
	// On compare les deux tableaux
	
	for (i=0; i<=tableau_id_demandes_liste.length; i++) {
		present=false;
		for(j=0; j<=tableau_id_demandes.length; j++)
		{
			if(tableau_id_demandes_liste[i]==tableau_id_demandes[j]){
				present=true;
				j=tableau_id_demandes.length;
			}
			
		}
		if(present==false){
			$('#sicla_arabundle_affectationdemandetype_demande option[value='+tableau_id_demandes_liste[i]+']').remove();
		}

	 }
	 $(".demandes_logement").first().show();

	// On affiche la fiche lorsque l'élément est sélectionné
	
	$('#sicla_arabundle_affectationdemandetype_famille').change(function(){
		  
      var id='famille-'+$(this).find("option:selected").attr('value');
	  
	  $(".table_famille").each(function(){ 
			if($(this).attr("id")==id)
				{
					$('#'+$(this).attr("id")).show();
				}else{
					$('#'+$(this).attr("id")).hide();
				}
		});
	});
});	