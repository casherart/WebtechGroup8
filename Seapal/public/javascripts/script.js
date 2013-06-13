
function submitForm(){
	var isOK = true;
	
	
	
	/*.select-medium, add if check for select boxes*/
	$(".input-medium").each(function(){		
		if($(this).val() == ""){
			$(this).parent().addClass("control-group error");
			isOK = false;
		}
	});
	if(isOK){
		$.ajax({
			  type: "POST",
			  url: "../server/receive_form.php",
			  data: $("#appForm").serialize(),
			  success: alert("Daten wurden gespeichert"),
			  dataType: "html"
			});
	}else{
		alert("Bitte nachbessern");
	}
}