<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Item</h5>
        <button id="close_edit_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'update.item')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Code:</label> <small style="color:red;visibility: hidden;" id="edit_code_msg"><i></i></small>
            <input type="text" class="form-control" id="edit_item_code" name="edit_item_code" required placeholder="Item Code" onchange="validateCodeEdit(this.value)">
            <input type="hidden" name="get_code" id="get_code">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Description:</label> 
            <input type="text" class="form-control" id="edit_item_desc" name="edit_item_desc" required placeholder="Item Description">
          </div>
          

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Brand:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <select name="edit_item_brand" id="edit_item_brand" class="form-control" required>
              <option value="" selected disabled>Select Brand</option>
              @foreach ($brand as $element)
                <option value="{{ $element['BRAND_CODE'] }}">{{ $element['BRAND_DESC'] }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Item Type:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <select name="edit_item_type" id="edit_item_type" class="form-control" required>
              <option value="" selected disabled>Select Type</option>
              @foreach ($type as $element)
                <option value="{{ $element['ITEM_TYPE_CODE'] }}">{{ $element['ITEM_TYPE_DESC'] }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Minimum Level:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="number" class="form-control" id="edit_min_level" name="edit_min_level" required min=0 value=0>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Maximum Level:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="number" class="form-control" id="edit_max_level" name="edit_max_level" required min=0 value=0>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Quantity:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="number" class="form-control" id="edit_quantity" name="edit_quantity" min=0 value=0>
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Standard Cost:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control zero_rated" id="edit_item_cost" name="edit_item_cost" required value="0.00" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Standard Price:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control zero_rated" id="edit_item_price" name="edit_item_price" required value="0.00" onclick="clickme(this)" onblur="blurme(this)" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\').replace(/(\\..*)\\./g, \'$1\');">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Image:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="file" class="form-control" id="edit_item_img" name="edit_item_img">
          </div>

          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Image Preview:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <img id="edit_preview"  src="#" alt="your image" style="height: 80px;width: 80px;background-color: grey;">
          </div>


          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;"></i> Description:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <textarea class="form-control" id="edit_item_desc" name="edit_item_desc"></textarea>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="edit_item_btn" class="btn btn-primary">Save</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>