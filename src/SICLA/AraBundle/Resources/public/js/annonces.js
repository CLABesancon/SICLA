jQuery(document).ready(function() {
var statut_select = $("#statut_select").val();
 if( statut_select==1){
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").show();
			   $("#Annonces").val('1');
		   } else if( statut_select=='2'){
			   $(".annonce-validee").show();
			   $(".annonce-non-validee").hide();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").hide();
			   $("#Annonces").val('2');
		   }else if( statut_select==3){
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").hide();
			   $(".annonce-archivee").show();
			   $(".annonce-revisee").hide();
			   $("#Annonces").val('3');
		   }else if( statut_select==4){
			   $(".annonce-validee").show();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").show();
			   $(".annonce-revisee").show();
			   $("#Annonces").val('4');
		   }

	$('#Annonces').change(function(){
			   
       var type=$(this).find("option:selected").attr('value');
	  if(type==1){
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").show();
			  $.cookie("statut_select","1");
		   } else if(type=='2'){
			   $(".annonce-validee").show();
			   $(".annonce-non-validee").hide();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").hide();
			   $.cookie("statut_select","2");
		   }else if(type==3){
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").hide();
			   $(".annonce-archivee").show();
			   $(".annonce-revisee").hide();
			   $.cookie("statut_select","3");
		   }else if(type==4){
			   $(".annonce-validee").show();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").show();
			   $(".annonce-revisee").show();
			   $.cookie("statut_select","4");
		   }
	});
});
