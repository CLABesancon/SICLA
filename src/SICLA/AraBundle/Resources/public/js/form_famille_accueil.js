jQuery(document).ready(function() {
	$(".famille").hide();
	$(".semi-independance").show();
	
	$('#sicla_arabundle_familleaccueiltype_typeAccueil').change(function(){
			  
      var type=$(this).find("option:selected").attr('value');
	  if(type=="Famille d'accueil"){
			   $(".famille").show();
			   $(".semi-independance").hide();
			   
		   } else if(type=="Semi indépendance"){
			   $(".famille").hide();
			   $(".semi-independance").show();
		   }
	});
});
