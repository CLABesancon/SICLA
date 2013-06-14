jQuery(document).ready(function() {
    $("#map").googleMap();
	
	$('.adresse').each(function() {
        $("#map").addMarker({
    	address: $(this).html(), // Adresse postale	
		});
    });
	$("#map").addWay({
    	start:$('.adresse').first().html(), // Adresse postale du départ 
		end: ' 6 rue gabriel plancon 25000 besançon', // Coordonnées GPS ou adresse postale d'arrivée (obligatoire)
		route : 'way', // ID du bloc dans lequel injecter le détail de l'itinéraire (optionnel)
		langage : 'french' // Langue du détail de l'itinéraire (optionnel, en anglais)
	});
  });