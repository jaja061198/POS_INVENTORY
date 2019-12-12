@php
  use App\Helpers\Helper;
@endphp
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document" style="margin-top: 50px; width: 85%;height: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color:red;text-transform: uppercase;font-weight: bold;">Items Below Minimum Level</h5>
        <button id="close_add_modal" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          
          <table class="table table-bordered" id="userTable" style="color:black;">
            <thead>
              <tr style="text-align: center;text-transform: uppercase;font-weight: bold;">
                <td>Item Code</td>
                <td>Item Name</td>
                <td>Stock on hand</td>
                <td>Minimum Level</td>
              </tr>
            </thead>

            <tbody>
              @foreach (Helper::retrieveMinimumItems() as $element)
                  <tr>
                    <td>{{ $element['ITEM_CODE'] }}</td>
                    <td>{{ $element['ITEM_DESC'] }}</td>
                    <td>{{ $element['QUANTITY'] }}</td>
                    <td>{{ $element['MIN_LEVEL'] }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
      </div>

      <div class="modal-footer">
        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" id="add_brnd_btn" class="btn btn-primary">Save</button> --}}
      </div>

    </div>
  </div>
</div>

<script>

function showModal()
{
    $('#exampleModal').modal('toggle');
    $('#exampleModal').modal('show');
}

</script>