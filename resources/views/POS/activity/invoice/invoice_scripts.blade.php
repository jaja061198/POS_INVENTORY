@php
	use App\Helpers\Helper;
@endphp

<script>

var numRows = 0;
	
$('#addRow').click(function(){


	numRows2 = $("#tbl_receive #trList").length; // COUNTS THE NUMBER OF ROWS IN THE TABLE
	numRows+=1;
	$row = $('<tr id="trList">'

		+'<td style="padding:0px;"><div class="input-group"><input type="text" class="form-control item-code" id="item_code'+numRows+'" name="item_code[]" readonly placeholder="Item Code" required><input type="hidden" name="get_code[]" id="get_code'+numRows+'" onchange="populate(this.id)">'

		+'<span class="input-group-btn"><button class="btn btn-primary" type="button" id="search_part'+numRows+'" name="search_part'+numRows+'" style="height: 39px; font-size: 12px; border-radius: 0px;" onclick="searchpartcode(this.name)" data-target="#exampleModal" data-toggle="modal"><i class="fa fa-search"></i></button></span></div></td>'

		+'<td style="padding:0px;"><input type="text" placeholder="Item Name" id="item_desc'+numRows+'" class="form-control" readonly></td>'

		+'<td style="padding:0px;"><input type="number" onchange="calculateQuantity(this.id)" min=1 id="quantity'+numRows+'" name="quantity[]" value=0 class="form-control" required readonly></td><input type="hidden" id="get_quant'+numRows+'" name="get_quantity">'

		+'<td style="padding:0px;"><input type="text" min=1 id="unit_cost'+numRows+'"  name="unit_cost[]" value="0.00" class="form-control" required readonly></td><input type="hidden" name="get_unit_cost[]">'

		+'<td style="padding:0px;"><input type="text" min=1 onchange="calculateDiscount(this.id)" id="discount'+numRows+'" name="discount[]" value="0.00" class="form-control discount" required onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');"></td>'

		+'<td style="padding:0px;"><input type="text" min=1 name="total_cost[]" value="0.00" id="total_cost'+numRows+'" class="form-control total-cost" readonly></td>'
 
		+'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow3(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times fa-1x"></i></button></td>' 
		+'</tr>'
	);

	$('#tbl_receive').append($row);

});


//servie Modal

var numRows3 = 0;
	
$('#addRow2').click(function(){


	numRows4 = $("#tbl_service").length; // COUNTS THE NUMBER OF ROWS IN THE TABLE
	numRows3+=1;
	$row = $('<tr id="trList">'

		+'<td style="padding:0px;"><div class="input-group"><input type="text" class="form-control item-code" id="service_code'+numRows3+'" name="service_code[]" readonly placeholder="Service Code" required><input type="hidden" name="get_code_service[]" id="get_code_service'+numRows3+'" onchange="populate2(this.id)">'

		+'<span class="input-group-btn"><button class="btn btn-primary" type="button" id="search_part'+numRows3+'" name="search_part'+numRows3+'" style="height: 39px; font-size: 12px; border-radius: 0px;" onclick="searchServiceCode(this.name)" data-target="#serviceModal" data-toggle="modal"><i class="fa fa-search"></i></button></span></div></td>'

		+'<td style="padding:0px;"><input type="text" placeholder="Service Name" id="service_desc'+numRows3+'" class="form-control" readonly></td>'

		+'<td style="padding:0px;"><input type="text" min=1 id="service_cost'+numRows3+'"  name="service_cost[]" value="0.00" class="form-control service-cost" required readonly></td><input type="hidden" name="get_unit_cost[]">'

		+'<td style="padding: 0px; vertical-align: middle; text-align: center;"><button onclick="deleteRow3(this)" style="background-color:transparent; border:0px; color:#F00;"><i class="fa fa-times fa-1x"></i></button></td>' 
		+'</tr>'
	);

	$('#tbl_service').append($row);

});

function deleteRow3(btn) {
	var row3 = btn.parentNode.parentNode;
	row3.parentNode.removeChild(row3);
	calculateTotalCost();
	calculateTotalCost2();
	calculateTotalDiscount();
	calculateServiceCost();
}



function searchpartcode(name)
{	
	var value = name;
	var location = value.substr(11);
	$('#code_holder').val(location).change();
	// $('#exampleModal').modal('toggle');
	// $('#exampleModal').modal('show');
}

function searchServiceCode(name)
{	
	var value = name;
	var location = value.substr(11);
	$('#code_holder_service').val(location).change();
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

			$('#item_desc'+element_id.substr(8)).val(data.datas['ITEM_DESC']).change();
			$('#get_quant'+element_id.substr(8)).val(data.datas['QUANTITY']).change();
			$('#quantity'+element_id.substr(8)).attr("max",data.datas['QUANTITY']);
			$('#discount'+element_id.substr(8)).val('0.00').change();
			$('#unit_cost'+element_id.substr(8)).val(PutComma(data.datas['STANDARD_COST'])).change();
			document.getElementById('quantity'+element_id.substr(8)).readOnly = false;
		}

	});
}


function populate2(element_id)
{
	// alert(element_id.substr(8));
	var item = $('#'+element_id).val();

	$.ajax({

		type: "GET",
		url : "{{ route('populate.invoice.service') }}",
		cache: false,
		data : {service_code:item},
		success : function(data)
		{

			$('#service_desc'+element_id.substr(16)).val(data.datas['SERVICE_DESC']).change();
			$('#service_cost'+element_id.substr(16)).val(PutComma(data.datas['STANDARD_COST'])).change();
			calculateServiceCost();
		}

	});
}




function calculateServiceCost()
{

	sum = 0;


		$(".service-cost").each(function() {
			sum += parseFloat(removeComma(this.value));
		});

		sum = sum.toFixed(2);
		document.getElementById('service_amount').value = PutComma(sum);
		// document.getElementById('pay_amount').value = '0.00';
		// document.getElementById('change').value = '0.00';
	calculateTotalCost2();
}

function calculateQuantity(quantity)
{	
	var id = quantity;
	var subs = id.substr(8);

	var unit_p = document.getElementById('unit_cost'+subs);
	var quantity = document.getElementById(quantity).value;
	var discounted_price = document.getElementById('discount'+subs).value; 
	var total_price = (quantity * removeComma(unit_p.value)).toFixed(2);
	// var total_price = (total_price - removeComma(discounted_price)).toFixed(2);
	document.getElementById('total_cost'+subs).value = PutComma(total_price);
	calculateTotalCost();
	calculateTotalCost2();

}


function calculateAdditionalDiscount()
{

	calculateTotalCost2();
}


function calculateDiscount(discount)
{
  var id = discount.substr(8);

  var discounted_price = document.getElementById(discount).value;
  var unit_p = document.getElementById('unit_cost'+id);
  var quantity = document.getElementById('quantity'+id).value;
  var total_price = (quantity * removeComma(unit_p.value)).toFixed(2);
  var less_discounted = (total_price - discounted_price).toFixed(2);
  document.getElementById('total_cost'+id).value = PutComma(less_discounted);
  calculateTotalDiscount();
  calculateTotalCost();
  calculateTotalCost2();
}

function calculateTotalCost()
{

	sum = 0;


		$(".total-cost").each(function() {
			sum += parseFloat(removeComma(this.value));
		});

		sum = sum.toFixed(2);
		document.getElementById('total_amount').value = PutComma(sum);
		document.getElementById('pay_amount').value = '0.00';
		document.getElementById('change').value = '0.00';
}

function calculateTotalDiscount()
{

	sum = 0;


		$(".discount").each(function() {
			sum += parseFloat(removeComma(this.value));
		});

		sum = sum.toFixed(2);
		document.getElementById('total_discount').value = PutComma(sum);
		calculateAdditionalDiscount();
}

function calculateTotalCost2()
{

		sum = document.getElementById('total_amount').value;

		total_discount = removeComma(document.getElementById('total_discount').value);

		total_amount = removeComma(document.getElementById('total_amount').value);

		additional_discount = removeComma(document.getElementById('additional_discount').value);

		service_cost = removeComma(document.getElementById('service_amount').value);

		total_discount = parseFloat(total_discount);

		total_discount = total_discount.toFixed(2);

		fixed_disc1 = parseFloat(additional_discount);

		fixed_disc1 = fixed_disc1.toFixed(2);

		total_discounted_amt = parseFloat(total_discount) + parseFloat(fixed_disc1);

		total_discounted_amt = total_discounted_amt.toFixed(2);

		total_amount = parseFloat(total_amount) + parseFloat(service_cost);

		total_amount = total_amount.toFixed(2);

		gross_amt = parseFloat(total_amount) - parseFloat(total_discounted_amt);

		gross_amt = gross_amt.toFixed(2);

		document.getElementById('total_amount2').value = PutComma(gross_amt);	
}


function calculateChange()
{
	total_amt2 = removeComma(document.getElementById('total_amount2').value);

	pay_amt = removeComma(document.getElementById('pay_amount').value);

	total_amt2 = parseFloat(total_amt2);

	total_amt2 = total_amt2.toFixed(2);

	pay_amt = parseFloat(pay_amt);

	pay_amt = pay_amt.toFixed(2);

	change = parseFloat(pay_amt) - parseFloat(total_amt2);

	change = change.toFixed(2);

	document.getElementById('change').value = PutComma(change);
}


//CURRENCY FORMAT
//


function clickme(_val){
  removezero(_val);
  getAmount(_val);
}

//GET VALUE CONVERT TO FLOAT WITHOUT COMMA
function _p(_val){
  //  return parseFloat(removeComma(document.getElementById(e).value));
  return parseFloat(removeComma(document.getElementById(_val).value));
}

//GET VALUE ONLY
function _t(id){
    return document.getElementById(id).value;
}

//SET VALUE
function _v(id, _val){
    return document.getElementById(id).value = _val;
}

//PUT COMMA WITH DECIMAL
function _f(_val){
  return PutComma((_val).toFixed(2))
}

function removezero(_val){
  var id = $(_val).attr('id');
  if($(_val).val() == "0.00"){
    $('#'+id).val('');
  }else{
    var input1 = $('#'+id).val().replace(/[^0-9.]/g, '');
    var input2 = Number(input1);
    var input3 = input2.toFixed(2);
    $('#'+id).val(input3);
  }
}

function blurme(_val){
  var id = $(_val).attr('id');
  var input1 = $('#'+id).val().replace(/\,/g,'');
  var input2 = Number(input1);
  var input3 = PutComma(input2.toFixed(2));
  var number = input3.split('.');
  var num1 = number[0].replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  var num2 = number[1];
  $('#'+id).val(num1+'.'+num2);
}


function getAmount(_val){
  var id = $(_val).attr('id');
  var valid = $('#'+id).val().replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1').replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  if(valid.indexOf('.') !== -1)
  {
    var number = valid.split('.');
    if(number[1].length > 1 && number[1].keyCode != 46 && number[1].keyCode != 8)
    {
      var input = $('#'+id).val().replace(/[^0-9.,]/g, '');
      $('#'+id).val(input);
      var input2 = $('#'+id).val().replace(/\,/g,'');
      var input3 = Number(input2);
      var input4 = input3.toFixed(2);
    }else{
      $('#'+id).val(valid);
    }
  }else{
    $('#'+id).val(valid);
  };
}

function PutComma(id){
  var wo_comma =  id;
  var split_val = wo_comma.split('.');
  var val1 = split_val[0].replace(/(\d)(?=(\d\d\d)+(?!\d))/g, '$1,');
  var val2 = val1 +'.'+ split_val[1];
  return val2;
}

function removeComma(value){
  return (value.indexOf(',') > 0) ? value.replace(/\,/g,'') : value;
}

</script>