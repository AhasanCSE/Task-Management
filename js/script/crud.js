$(document).ready(function(){
	$("#btnAdd").on("click",function(){
		var is_true = 1;
		var table_name = $(this).attr("table_name");
		var fileds = [];
		var values = [];
		$(".field_data").each(function(){
			var name = $(this).attr("name");
			var val = $(this).val().trim();
			fileds.push(name);
			values.push(val);	
			if($(this).attr('req') == 1 && val == ''){
				var string = name.split(' ')
				   .map(w => w[0].toUpperCase() + w.substr(1).toLowerCase())
				   .join(' ');
				swal("Required!", "Please Fillup "+string+".", "error");
				is_true = 0;
				return false;
			}
			if($(this).attr('is_double') == 1 && isNaN(val)){
				var string = name.split(' ')
				   .map(w => w[0].toUpperCase() + w.substr(1).toLowerCase())
				   .join(' ');
				swal("Wrong Type!", string+" must be Number.", "error");
				is_true = 0;
				return false;
			}
		});
		if(is_true == 0)
			return false;
		if($("#btnAdd").val() == "Save"){
			$.post("ajax/ajax_save.php",{table_name:table_name,fileds:fileds.toString(),values:values.toString()},function(data){
				if(data == 1){
					swal("Success!", "Data Save Successfully", "success");
					clear();
					$("#btnSearch").trigger('click');
				}else{
					swal("Fail!", "Could not Save Data", "error");
				}
			});
		}else{
			$.post("ajax/ajax_update.php",{id_name:id_name,id_value:id_value,table_name:table_name,fileds:fileds.toString(),values:values.toString()},function(data){
				if(data == 1){
					swal("Success!", "Data Update Successfully", "success");
					$("#btnAdd").val("Save");
					clear(); 
					$("#btnSearch").trigger('click');
				}else{
					swal("Fail!", "Could not Update Data", "error");
				}
			});
		}
	});

	function clear(){
		$(".field_data").each(function(){
			$(this).val('');
		});
	}

	$("#btnSearch").on("click",function(){
		var table_name = $(this).attr("table_name");
		var fileds = [];
		var values = [];
		$(".src_data").each(function(){
			var name = $(this).attr("name");
			var val = $(this).val().trim();
			fileds.push(name);
			values.push(val);
		});
		$.post("ajax/ajax_search.php",{table_name:table_name,fileds:fileds.toString(),values:values.toString()},function(data){
			$("#recordList").html(data);
		});
	});
	var id_name = '';
	var id_value = '';
	$(document).on("click",".data_edit",function(){
		var data_fields = $(this).attr("data_fields").toString();
		data_fields = data_fields.split(",");
		var field_values =  $(this).attr("field_values").toString();
		field_values = field_values.split(",");
		for(var i = 0; i < data_fields.length; i++){
			$(".field_data").each(function(){
				var a = $(this).attr('name');
				var b = data_fields[i];
				if($(this).attr('name') == data_fields[i])
					$(this).val(field_values[i]);
			});
		}
		id_name = data_fields[0];
		id_value = field_values[0];
		$("#btnAdd").val("Update");
	});

	$(document).on("click",".data_remove",function(){
		id_name = $(this).attr('id_name');
		id_value = $(this).attr('id_value');
		swal("Are you sure you want to Remove?", {
		  buttons: ["Oh noez!", true],
		}).then(function(isConfirm) {
      if (isConfirm) {
        swal({
          title: 'Yah!',
          text: 'Data Removed Successfully!',
          icon: 'success'
        }).then(function() {		
        	var table_name = $("#btnAdd").attr("table_name");
        	$.post("ajax/ajax_remove.php",{table_name:table_name,id_name:id_name,id_value:id_value},function(data){
				$("#btnSearch").trigger('click');
        	});
        });
      } 
    });
	});

});