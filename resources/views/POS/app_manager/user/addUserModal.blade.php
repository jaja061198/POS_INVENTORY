<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
        <button id="close_add_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      {{ Form::open(array('route' => 'user.insert', 'id' => 'add_user_form')) }}
      <div class="modal-body">
          
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Fullname:</label> <small style="color:red;visibility: hidden;" id="fname_msg"><i></i></small>
            <input type="text" class="form-control" id="fullname" name="fullname" required placeholder="Full Name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><i style="color:red;">*</i> Username:</label>  <small style="color:red;visibility: hidden;" id="user_msg"><i></i></small>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Username">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><i style="color:red;">*</i> Password:</label>  <small style="color:red;visibility: hidden;" id="password_msg"><i></i></small>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label"><i style="color:red;">*</i> Email:</label> <small style="color:red;visibility: hidden;" id="email_msg"><i></i></small>
            <input type="email" class="form-control" id="email" name="email" required placeholder="Email">
            <input type="hidden" id="is_existing" value="0">
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1"><i style="color:red;">*</i> User Level</label> <small style="color:red;visibility: hidden;" id="userlvl_msg"><i></i></small>
            <select class="form-control" id="user_level" name="user_level" required>
              <option value="" selected disabled>Select User Level</option>
              @if(Auth::user()->user_level == 0)
                <option value="0">Super Admin</option>
              @endif
              <option value="1">Admin</option>
              <option value="3">Ordinary</option>
            </select>
          </div>

      </div>
      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
        <button type="button" id="add_user_btn" class="btn btn-primary">Add User</button>
      </div>
      {{ Form::close() }}
    </div>
  </div>
</div>