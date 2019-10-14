
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Service</h5>
        <button id="close_add_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'add.service')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Service Code:</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" id="add_service_code" name="add_service_code" required placeholder="Service Code" onchange="validateCode(this.value)">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Service Description:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control" id="add_service_desc" name="add_service_desc" required placeholder="Service Description">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Standard Cost:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control zero_rated" id="add_service_cost" name="add_service_cost" required value="0.00" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');" onchange="calculateDiscount(this.id)">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_service_btn" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>