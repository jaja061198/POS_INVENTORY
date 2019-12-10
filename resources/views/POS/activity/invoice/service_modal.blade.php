<div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document" style="margin-top: 50px; width: 85%;height: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Service</h5>
        <button id="close_add_modal2" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          
          <table class="table table-bordered" style="width: 100%" id="service_modal">
            <thead>
              <tr>
                <td>Service Code</td>
                <td>Service Name</td>
                <td>Service Cost</td>
            </tr>
            </thead>
          </table>
          
          <input type="hidden" id="code_holder_service">
      </div>

      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_brnd_btn" class="btn btn-primary">Save</button> --}}
      </div>

    </div>
  </div>
</div>

<script>

$(document).ready( function () {
  $('#service_modal').DataTable({
    processing: true,
    serverSide: true,
    language: {
      processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },

    ajax : {
      "url" : "{{ route('serverside.invoice.service') }}",
      "dataType" : "json",
      "type" : "post",
      "data" : {"_token":"<?= csrf_token() ?>"}
    },

    columns : [
          {"data":'SERVICE_CODE'},
          {"data":'SERVICE_DESC'},
          {"data":'STANDARD_COST'},
    ]
  });
});


$('#service_modal').on('dblclick', 'tr', function() { //Function For Double Click

    var td = this.cells[1];  // the first <td>
    // alert( $(td).text() );
    var value = $(td).text();

    var td2 = this.cells[0];//Quantity

    var value2 = $(td2).text();//Quantity

    var condition = "";

    // alert(value2);

    $(".item-code").each(function () { //Verify If Existing on the list

        var selector = new Array();
        selector.push($(this).val());

        for(i = 0 ; i < selector.length; i++){

          if(selector[i] == value2){
            condition = "F";
          }

        }

    })


    if(condition == "F"){ // Terminate the entire function if the item is existing
      alert('This item already exist on the list.')
      return false;
    }
     var code = 'service_code'+$('#code_holder_service').val();
     var get_code = 'get_code_service'+$('#code_holder_service').val();
     $('#'+code).val(value2).change();
     $('#'+get_code).val(value2).change();
     $('#close_add_modal2').click();
     

});//End of Function
</script>