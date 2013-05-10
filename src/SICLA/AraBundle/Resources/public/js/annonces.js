jQuery(document).ready(function() {
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").show();
	$('#Annonces').change(function(){
			   
       var type=$(this).find("option:selected").attr('value');
	  if(type==1){
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").show();
		   } else if(type=='2'){
			   $(".annonce-validee").show();
			   $(".annonce-non-validee").hide();
			   $(".annonce-archivee").hide();
			   $(".annonce-revisee").hide();
		   }else if(type==3){
			   $(".annonce-validee").hide();
			   $(".annonce-non-validee").hide();
			   $(".annonce-archivee").show();
			   $(".annonce-revisee").hide();
		   }else if(type==4){
			   $(".annonce-validee").show();
			   $(".annonce-non-validee").show();
			   $(".annonce-archivee").show();
			   $(".annonce-revisee").show();
		   }
	});
});
