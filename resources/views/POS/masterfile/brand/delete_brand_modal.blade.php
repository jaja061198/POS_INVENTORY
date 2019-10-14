<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 100px; width: 450px;">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                
                <h4 class="modal-title" style="color: #F00;"><i class="fa fa-times-circle"></i> Delete Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding: 30px 25px 30px 25px; text-align: center;">

                Are you sure you want to delete (<b id="code_display"></b>) from the list  ?

            </div>
            <div class="modal-footer">

                    {{ Form::open(array('route' => 'delete.brand')) }}

                <input type="hidden" id="code" name="code" value="" />
                <button type="button" class="btn btn-danger" data-dismiss="modal" style="width:50px; height:30px; padding:2px 2px 2px 2px; float:right; margin-left:10px;">No</button>
                <input type="submit" name="submit" value="Yes" class="btn btn-success" style="width:50px; height:30px; padding:2px 2px 2px 2px; float:right;"/>
                    {{ Form::close() }}

            </div>
        </div>
    </div>
</div>