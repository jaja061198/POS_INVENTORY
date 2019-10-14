
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
        <button id="close_add_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'add.item')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Code:</label> <small style="color:red;visibility: hidden;" id="add_code_msg"><i></i></small>
            <input type="text" class="form-control" id="add_item_code" name="add_item_code" required placeholder="Item Code" onchange="validateCode(this.value)">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Description:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control" id="add_item_desc" name="add_item_desc" required placeholder="Item Description">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Brand:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <select name="add_item_brand" id="add_item_brand" class="form-control" required>
              <option value="" selected disabled>Select Brand</option>
              @foreach ($brand as $element)
                <option value="{{ $element['BRAND_CODE'] }}">{{ $element['BRAND_DESC'] }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Type:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <select name="add_item_type" id="add_item_type" class="form-control" required>
              <option value="" selected disabled>Select Type</option>
              @foreach ($type as $element)
                <option value="{{ $element['ITEM_TYPE_CODE'] }}">{{ $element['ITEM_TYPE_DESC'] }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Minimum Level:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="number" class="form-control" id="add_min_level" name="add_min_level" required min=0 value=0>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Maximum Level:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="number" class="form-control" id="add_max_level" name="add_max_level" required min=0 value=0>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Standard Cost:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control zero_rated" id="add_item_cost" name="add_item_cost" required value="0.00" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');" onchange="calculateDiscount(this.id)">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_item_btn" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>