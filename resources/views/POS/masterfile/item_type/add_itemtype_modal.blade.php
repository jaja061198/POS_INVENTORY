<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item Type</h5>
        <button id="close_add_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'add.itemtype')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Type Code:</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" id="add_item_type_code" name="add_item_type_code" required placeholder="Item Type Code" onchange="validateCode(this.value)">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Type Description:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control" id="add_item_type_desc" name="add_item_type_desc" required placeholder="Item Type Description">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_item_type_btn" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>