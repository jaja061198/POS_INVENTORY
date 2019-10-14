<?php use App\Http\Traits\app_manager\NavigationTraits;; ?>
<script>


function deleteRow(btn){

    $('#deleteModal').modal('show');
    var refcode = $(btn).attr('data-id');
    var refcode2 = $(btn).attr('data-id2');
    $(".modal-body #del_name").html(refcode);
    $(".modal-body #del_name2").html(refcode2);
    $(".modal-footer #del_id").val(refcode);
    $(".modal-footer #del_id2").val(refcode2);

}

var numRows = 0;
	
$('#addRow').click(function(){


	numRows2 = $("#tbl_nav #trList").length; // COUNTS THE NUMBER OF ROWS IN THE TABLE
	numRows+=1;
	$row = $('<tr id="trList">'

		+'<td style="padding:0px;"><input type="text" name="code_add[]" placeholder="Window Code" class="form-control" required></td>'

		// +'<td style="padding:0px;"><select name="window_class_add[]"  class="form-control" required>'
				
		// 		+'<option value="A">Activity</option>'

		// 		+'<option value="TM">Masterfile</option>'

		// 		+'<option value="AM">App Manager</option>'

		// 		+'<option value="SC">System Control</option>'

		// +'</td>'

		+'<td style="padding:0px;"><input type="text" name="desc_add[]" placeholder="Nav Description" class="form-control" required></td>'


		+'<td style="padding:0px;"><select name="icon_add[]"  class="fa form-control" required>'

			@foreach ($icons as $element)
				
				+'<option value="{{ $element['id'] }}"> {{ $element['icon_class'] }}</option>'
			@endforeach

		+'</td>'


		+'<td style="padding:0px;"><select name="parent_add[]" id="parent'+numRows+'" class="form-control" required>'

			@foreach (NavigationTraits::getParentItems() as $element)
				
				+'<option value="{{ $element['NAV_ID'] }}">{{ $element['NAV_DESCRIPTION'] }}</option>'

			@endforeach

		+'</td>'

		+'<td style="padding:0px;"><select name="child_add[]" id="child_add'+numRows+'" class="form-control" required onchange="changeWithChildAdd(this.id)">'
				
				+'<option value="0">NO</option>'

				+'<option value="1">YES</option>'

		+'</td>'


		+'<td style="padding:0px;"><input type="text" name="route_add[]" placeholder="Route" id="route_add'+numRows+'" class="form-control" required></td>'

		+'<td style="padding:0px;"><input type="text" name="order_add[]" placeholder="Order" id="order'+numRows+'" class="form-control" required></td>'
 
		+'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow3(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times fa-1x"></i></button></td>' 
		+'</tr>'
	);

	$('#table_category').append($row);

});


function deleteRow3(btn) {
	var row3 = btn.parentNode.parentNode;
	row3.parentNode.removeChild(row3);
}


function changeWithChild(child)
{
	var index = child.substring(10);

	if (document.querySelector("#"+child).value == 1) 
	{
		document.querySelector("#route"+index).readOnly = true;
	}
	else
	{
		document.querySelector("#route"+index).readOnly = false;
	}
}

function changeWithChildAdd(child)
{
	var index = child.substring(9);

	if (document.querySelector("#"+child).value == 1) 
	{
		document.querySelector("#route_add"+index).readOnly = true;
	}
	else
	{
		document.querySelector("#route_add"+index).readOnly = false;
	}
}

</script>