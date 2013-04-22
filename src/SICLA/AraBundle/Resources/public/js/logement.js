jQuery(document).ready(function() {
	//on modifie l'emplacement du curseur en fonction de la valeur indiquée dans le champ
	
	// ***** Consommation d'énergie *****
	consommation=$("#arabundle_logementtype_consommationEnergie").val();
	
	if(consommation <=50){
		$(".curseur_energie").css('top','15px');
	}
	if(consommation >=51 && consommation <=90){
		$(".curseur_energie").css('top','42px');
	}
	if(consommation >=91 && consommation <=150){
		$(".curseur_energie").css('top','68px');
	}
	if(consommation >=151 && consommation <=230){
		$(".curseur_energie").css('top','92px');
	}
	if(consommation >=231 && consommation <=330){
		$(".curseur_energie").css('top','118px');
	}
	if(consommation >=331 && consommation <450){
		$(".curseur_energie").css('top','144px');
	}
	if(consommation >=450){
		$(".curseur_energie").css('top','167px');
	}
	
	// ***** Emissions GES *****
	GES=$("#arabundle_logementtype_emissionGes").val();
	if(GES<=5){
			$(".curseur_ges").css('top','15px')
	}
	if(GES >=6 && GES <=10){
			$(".curseur_ges").css('top','42px')
	}
	if(GES >=11 && GES <=20){
			$(".curseur_ges").css('top','68px')
	}
	if(GES >=21 && GES <=35){
			$(".curseur_ges").css('top','92px')
	}
	if(GES >=36 && GES <=55){
			$(".curseur_ges").css('top','118px')
	}
	if(GES >=56 && GES <=80){
			$(".curseur_ges").css('top','144px')
	}
	if(GES >80){
			$(".curseur_ges").css('top','167px')
	}
	
});