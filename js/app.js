$(document).ready(function(){
	function limpiarCampos(){
		$("#txtInvCruDateCrossing").val("");
		$("#txtInvCruTrailerNumber").val("");
		$("#txtInvCruDescription").val("");
	}
	function actualizarTabla(id){
		var InvId = id;
		$.ajax({
			url:"php/llenarTabla.php",
			type:"GET",
			data:{"id":id,"clave":1}
		}).done(function(data){
			//alert(data);
			var response = $.parseJSON(data);
			console.log(response);
			//alert(response[0]["InvCruDateCrossing"]);
			$("#tablacruces tbody tr").remove();
			for (var i = response.length - 1; i >= 0; i--) {
				$("#tablacruces tbody").append("<tr><td>"+response[i]["InvCruDateCrossing"]+"</td><td>"+response[i]["InvCruTrailerNumber"]+"</td><td>"+response[i]["InvCruAmount"]+"</td><td>"+response[i]["InvCruDescription"]+"</td><td>"+response[i]["txtInvCruFrom"]+"</td><td>"+response[i]["InvNum"]+"</td><tr>")
			}
		});
	}
	
	$("#btnAsignar").click(function(){
		if($("#InvDate").val() == ""){
          		alert("Debe ingresar una fecha.");
       		}else{
         			if ($("#txtCustumerNum").val() == "") {
            				alert("Debe ingresar un numero.");
          				}else{
            					$("#InvDate").prop('disabled', true);
            					$("#txtCustumerNum").prop('disabled', true);

            					var InvDate = $("#InvDate").val();
            					var CustumerNum = $("#txtCustumerNum").val();
            					var InvNumber = $("#txtInvNum").val();
            					$.ajax({
            						url : "php/TraerIdInv.php",
            						type : "GET",
            						data : {"InvDate":InvDate,"CustumerNum":CustumerNum,"InvNumber":InvNumber}
            					}).done(function(data){
            						$("#txtInvId").val(data);
            						$("#txtInvCruDateCrossing").prop('disabled', false);
            						$("#txtInvCruTrailerNumber").prop('disabled', false);
            						$("#txtInvCruDescription").prop('disabled', false);
							$("#txtInvCruAmount").prop('disabled', false);
          							});
	       					}
	   			}
	});
	$("#btnNuevo").click(function(){
		location.reload();
		history.go(0);
		window.location.href = window.location.href;
	});
	var a = 1;
	$("#btnGuardar").click(function(){
		var InvCruDateCrossing 	= $("#txtInvCruDateCrossing").val();
		var InvCruTrailerNumber 		= $("#txtInvCruTrailerNumber").val();
		var InvCruAmount 				= $("#txtInvCruAmount").val();
		var InvCruDescription			= $("#txtInvCruDescription").val();
		var txtInvCruFrom				= $("#txtInvCruFrom").val();
		var InvId                       = $("#txtInvId").val();
			$.ajax({
			url:"php/guardarCruce.php",
			type:"GET",
			data:{"InvCruDateCrossing":InvCruDateCrossing,"InvCruTrailerNumber":InvCruTrailerNumber,"InvCruAmount":InvCruAmount,
			"InvCruDescription":InvCruDescription,"txtInvCruFrom":txtInvCruFrom,"InvId":InvId}
			}).done(function(data){	
				limpiarCampos();
				actualizarTabla(InvId);
			});
		
		
	});
	$("#btnGuardarDet").click(function(){
		var InvCruDateCrossing 	= $("#txtInvCruDateCrossingDet").val();
		var InvCruTrailerNumber 		= $("#txtInvCruTrailerNumberDet").val();
		var InvCruAmount 				= 90;
		var InvCruDescription			= $("#txtInvCruDescriptionDet").val();
		var txtInvCruFrom				= $("#txtInvCruFromDet").val();
		var InvId                       = $("#txtInvIdIns").val();
		$.ajax({
			url:"php/guardarCruce.php",
			type:"GET",
			data:{"InvCruDateCrossing":InvCruDateCrossing,"InvCruTrailerNumber":InvCruTrailerNumber,"InvCruAmount":InvCruAmount,
			"InvCruDescription":InvCruDescription,"txtInvCruFrom":txtInvCruFrom,"InvId":InvId}
		}).done(function(data){

			location.reload();

		});
	});
});