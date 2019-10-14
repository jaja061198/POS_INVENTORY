(function(){
	var UsersClass = {
		dataTable : function() {
			var tableElement = $('#example');
			tableElement.removeClass( 'display' ).addClass('table table-striped table-bordered');
			tableElement.DataTable( {
		    	"processing": true,
		    	"serverSide": true, 
		        "ajax": {
		        	'type': 'GET',
		        	'url': "/myproject/admin/tbl_maintenance/item_grp",
		        	'data': {}
		    	},
		    	"drawCallback": function(settings) {
				   console.log(settings.json);
				   UsersClass.deleteUser();
				},
		        "columns": [
		            { "data": "item_code" },
		            { "data": "item_description" },
		            { "data": "um" },
		            { "data": "unit_price" },
		            { "data": "status" },
		            { "data": "action", 
		              "render": function(data,type,row,meta) {
		              	var cell = '';
		              		cell += '<div style="text-align: center;">';
		              			cell += '[<a href="/admin/users/edit/'+ data +'" data-action-id="'+ data +'">Edit</a>, ';
		              			cell += '<a href="javascript:void(0)" class="btn-action-delete" data-action-id="'+ data +'">Delete</a>]';
		              		cell += '</div>';
		              	return cell;
		              }
		        	}
		        ],
		        "aoColumnDefs": [
					{ 'bSortable': false, 'aTargets': [ 4 ] }
		       	]
		    });
		},
		deleteUser: function() {

			$('.btn-action-delete').on('click', function() {

				$('#usersDeleteModal').modal('show');

				var id = $(this).attr('data-action-id');
				$('.btn-modal-delete-yes').on('click', function(){
					$.post('/admin/users/delete', {
						'_token': $('meta[name="csrf-token"]').attr('content'),
						'id': id,
						'is_deleted': '1'
					}, function(response, status){
						if (status) {
							window.location = '/admin/users';	
						}
					});
				});
			});
		}
	}
	$(document).ready(function() {
		UsersClass.dataTable();
	});
})();
