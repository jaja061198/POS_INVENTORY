<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Fullname:</label>
            <input type="text" class="form-control" id="edit_fullname" name="edit_fullname" required placeholder="Full Name" >
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Username:</label>
            <input type="text" class="form-control" id="edit_username" name="edit_username" required placeholder="Username" readonly>
          </div>

          <div class="form-group">
            <label for="message-text" class="col-form-label"><i style="color:red;">*</i> Email:</label>
            <input type="email" class="form-control" id="edit_email" name="edit_email" required placeholder="Email">
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect2"><i style="color:red;">*</i> User Level</label>
            <select class="form-control" id="edit_user_level" name="edit_user_level" required>
              <option value="" selected disabled>Select User Level</option>
              @if(Auth::user()->user_level == 0)
                <option value="0">Super Admin</option>
              @endif
              <option value="1">Admin</option>
              <option value="3">Ordinary</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Update User</button>
      </div>
    </div>
  </div>
</div>