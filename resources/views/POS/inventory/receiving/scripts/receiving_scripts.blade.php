<script>

var numRows = 0;
	
$('#addRow').click(function(){


	numRows2 = $("#tbl_receive #trList").length; // COUNTS THE NUMBER OF ROWS IN THE TABLE
	numRows+=1;
	$row = $('<tr id="trList">'

		+'<td style="padding:0px;"><div class="input-group"><input type="text" class="form-control item-code required" id="item_code'+numRows+'" name="item_code[]" required placeholder="Item Code" onchange="populate3(this.id)"><input type="hidden" name="get_code[]" id="get_code'+numRows+'" onchange="populate(this.id)">'

		+'<span class="input-group-btn"><button class="btn btn-primary" type="button" id="search_part'+numRows+'" name="search_part'+numRows+'" style="height: 32px; font-size: 12px; border-radius: 0px;" onclick="searchpartcode(this.name)" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-search"></i></button></span></div></td>'

		+'<td style="padding:0px;"><input type="text" placeholder="Item Name" id="item_desc'+numRows+'" class="form-control" readonly></td>'

		+'<td style="padding:0px;"><input type="number" min=1 name="quantity[]" value=0 class="form-control" required></td><input type="hidden" id="get_quant'+numRows+'" name="get_quantity">'
 
		+'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow3(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times fa-1x"></i></button></td>' 
		+'</tr>'
	);

	$('#tbl_receive').append($row);

	$( "#item_code"+numRows ).focus();

});

function deleteRow3(btn) {
	var row3 = btn.parentNode.parentNode;
	row3.parentNode.removeChild(row3);
}

function searchpartcode(name)
{	
	var value = name;
	var location = value.substr(11);
	$('#code_holder').val(location).change();
	// $('#exampleModal').modal('toggle');
	// $('#exampleModal').modal('show');
}


function populate(element_id)
{
	// alert(element_id.substr(8));
	var item = $('#'+element_id).val();
	$.ajax({

		type: "GET",
		url : "{{ route('populate.item') }}",
		cache: false,
		data : {item_code:item},
		success : function(data)
		{
			if (data.datas == null) {
				alert('Item Not Found on the database');
				$('#'+element_id).val('');
				$('#'+element_id).focus();
				return false;
			}

			$('#item_desc'+element_id.substr(8)).val(data.datas['ITEM_DESC']).change();
			$('#get_quant'+element_id.substr(8)).val(data.datas['QUANTITY']).change();

		}

	});
}

function populate3(element_id)
{
	// alert(element_id.substr(8));
	var item = $('#'+element_id).val();
	$.ajax({

		type: "GET",
		url : "{{ route('populate.item') }}",
		cache: false,
		data : {item_code:item},
		success : function(data)
		{
			if (data.datas == null) {
				alert('Item Not Found on the database');
				$('#'+element_id).val('');
				$('#'+element_id).focus();
				return false;
			}
			$('#get_code'+element_id.substr(8)).val(data.datas['ITEM_CODE']).change();
			$('#item_desc'+element_id.substr(9)).val(data.datas['ITEM_DESC']).change();
			$('#get_quant'+element_id.substr(9)).val(data.datas['QUANTITY']).change();
			event.preventDefault();
			$('#addRow').click();
		}

	});
}

$('#submitbtm').click(function(event){

var ret = true;
$(".required").each( function() {
    var check = $(this).val();

    if(check == '') {
        //alert($(this).attr("id"));
        ret = false;
        event.preventDefault();
    }
});

if(!ret) {
    alert("One or more fields cannot be blank");
    event.preventDefault();
    return false;
}

$('#receive_form').submit();

});
</script>