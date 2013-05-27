jQuery(document).ready(function() {
	
	$('#sicla_arabundle_affectationdemandetype_demande > *').each(function() {
		if($(this).val()=='32')
			{
				$("#sicla_arabundle_affectationdemandetype_demande option[value="+$(this).val()+"]").remove();
			}
    });
	
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
