<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document" style="margin-top: 50px; width: 85%;height: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Select Item</h5>
        <button id="close_add_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          
          <table class="table table-bordered" style="width: 100%" id="item_table">
            <thead>
              <tr>
                <td>Item Code</td>
                <td>Item Name</td>
                <td>Item Brand</td>
            </tr>
            </thead>
          </table>
          
          <input type="hidden" id="code_holder">
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
  $('#item_table').DataTable({
    processing: true,
    serverside: true,
    language: {
      processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
    },

    ajax : {
      "url" : "{{ route('serverside.receiving') }}",
      "dataType" : "json",
      "type" : "post",
      "data" : {"_token":"<?= csrf_token() ?>"}
    },

    columns : [
          {"data":'ITEM_CODE'},
          {"data":'ITEM_DESC'},
          {"data":'ITEM_BRAND'},
    ]
  });
});


$('#item_table').on('dblclick', 'tr', function() { //Function For Double Click

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
     var code = 'item_code'+$('#code_holder').val();
     var get_code = 'get_code'+$('#code_holder').val();

     $('#'+code).val(value2).change();
     $('#'+get_code).val(value2).change();
     $('#exampleModal').modal('hide');

});//End of Function
</script>