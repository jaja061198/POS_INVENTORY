<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Service</h5>
        <button id="close_edit_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.service')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Service Code:</label> <small style="color:red;visibility: hidden;" id="edit_code_msg"><i></i></small>
            <input type="text" class="form-control" id="edit_service_code" name="edit_service_code" required placeholder="Service Code" onchange="validateCodeEdit(this.value)">
            <input type="hidden" name="get_code" id="get_code">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Service Description:</label> 
            <input type="text" class="form-control" id="edit_service_desc" name="edit_service_desc" required placeholder="Service Description">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Standard Cost:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control zero_rated" id="edit_service_cost" name="edit_service_cost" required value="0.00" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');" onchange="calculateDiscount(this.id)">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="edit_service_btn" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>