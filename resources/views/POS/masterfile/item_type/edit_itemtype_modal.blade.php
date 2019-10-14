<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Item Type</h5>
        <button id="close_edit_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.itemtype')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Type Code:</label> <small style="color:red;visibility: hidden;" id="edit_code_msg"><i></i></small>
            <input type="text" class="form-control" id="edit_item_type_code" name="edit_item_type_code" required placeholder="Item Type Code" onchange="validateCodeEdit(this.value)">
            <input type="hidden" name="get_code" id="get_code">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Type Description:</label> 
            <input type="text" class="form-control" id="edit_item_type_desc" name="edit_item_type_desc" required placeholder="Item Type Description">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="edit_item_type_btn" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>