jQuery(document).ready(function() {
	
	/************** Partie concernant les affectations des apprenants **************/
	$(".demandes_logement").each(function(){ 

					$('#'+$(this).attr("id")).hide();
		});
	
	
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
	 
	 // on affiche la première demande de logement présente dans la liste
	 $(".demandes_logement").first().show();

	// On affiche la fiche lorsque l'élément est sélectionné
	
	$('#sicla_arabundle_affectationdemandetype_demande').change(function(){
		
		  
      var id=$(this).find("option:selected").attr('value');
	  
	  $(".demandes_logement").each(function(){ 
			if($(this).attr("id")==id)
				{
					$('#'+$(this).attr("id")).show();
				}else{
					$('#'+$(this).attr("id")).hide();
				}
		});
	});
	
	/************** Partie concernant les affectations des familles **************/
	$(".block-right").each(function(){ 

					$('#'+$(this).attr("id")).hide();
		});
	
	
	//familles présentes au chargement de la page
	var tableau_id_familles=new Array();
	var i=0;
	$('.block-right').each(function() {
		tableau_id_familles[i]=$(this).attr("id");
		i++;
	});
	
	// familles présentes dans la liste déroulante
	var tableau_id_familles_liste=new Array()
	i=0;
	
	$('#sicla_arabundle_affectationdemandetype_famille > *').each(function(){
		tableau_id_familles_liste[i]=$(this).attr("value");
		i++;
	});
	
	// On compare les deux tableaux
	
	for (i=0; i<=tableau_id_familles_liste.length; i++) {
		present=false;
		for(j=0; j<=tableau_id_familles.length; j++)
		{
			if(tableau_id_familles_liste[i]==tableau_id_familles[j]){
				present=true;
				j=tableau_id_familles.length;
			}
			
		}
		if(present==false){
			$('#sicla_arabundle_affectationdemandetype_famille option[value='+tableau_id_familles_liste[i]+']').remove();
		}

	 }
	 $(".block-right").first().show();

	// On affiche la fiche lorsque l'élément est sélectionné
	
	$('#sicla_arabundle_affectationdemandetype_famille').change(function(){
		  
      var id=$(this).find("option:selected").attr('value');
	  
	  $(".block-right").each(function(){ 
			if($(this).attr("id")==id)
				{
					$('#'+$(this).attr("id")).show();
				}else{
					$('#'+$(this).attr("id")).hide();
				}
		});
	});
});	