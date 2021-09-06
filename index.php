<!DOCTYPE html>
<html>
	<head>
		<title>PHP Mysql REST API CRUD</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">PHP Mysql REST API CRUD 2</h3>
			<br />
			<div align="right" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
						<th>ID</th>
							<th>Name</th>
							<th>Mobile</th>
							<th>Message</th>
							<th>Status</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
				
				<hr />
				<div align="left">
				    <h3>SEND SMS</h3>
				    <?php 
				        echo "<code>https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "gsm_api.php?action=insert&name=NAME&mobile=+9XXXXXXXXXX&message=ANY_MESSAGE&status=0</code>";
				    ?>
				    
				    <h3>UPDATE SMS STATUS</h3>
				    <?php 
					echo "<code>https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "gsm_api.php?action=update&id=1&status=1</code>";
				    ?> 
				    <hr />
					
				    <h3>Fetch All Records</h3>
				    <?php 
					echo "<code>https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "gsm_api.php?action=fetch_all</code>";
				    ?> 

				    <h3>Fetch New Data</h3>
				    <?php 
					echo "<code>https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "gsm_api.php?action=fetch_new</code>";
				    ?> 

				    <h3>Delete Message / Del Record from DB</h3>
				    <?php 
					echo "<code>https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "gsm_api.php?action=delete&id=2</code>";
				    ?> 
				    <br /><br /><br /><br />
				</div>
				
			</div>
		</div>
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Data</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Name</label>
			        	<input type="text" name="name" id="name" class="form-control" />
			        </div>
			        <div class="form-group">
			        	<label>Mobile</label>
			        	<input type="number" name="mobile" id="mobile" class="form-control" />
			        </div>
					<div class="form-group">
			        	<label>Message</label>
			        	<textarea type="text" name="message" id="message" class="form-control" /></textarea>
			        </div>
					<div class="form-group">
			        	<label>Status</label>
			        	<select name="status" id="status" class="form-control">
						<option value="1">Send</option>
						<option value="0">Pending</option>
						</select>
			        </div>
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
    // alert("Hello page loaded");

	fetch_data();
// fetch.php gsm_api.php?action=fetch_all
	function fetch_data()
	{
		$.ajax({ 
			url: "fetch.php",
			success:function(data)
			{
			    console.log("inside success"); 
			    console.log("-----------");
			    //console.log(data1.users.name[0]);
				//$('tbody').html(data1.users[0].name);
				$('tbody').html(data);
			},
			
            error: function (jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                console.log(msg);
            }
			
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('Add Data');
		$('#apicrudModal').modal('show');
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#name').val() == '')
		{
			alert("Enter Name");
		}
		else if($('#mobile').val() == '')
		{
			alert("Enter Mobile");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url: "action.php",
				method: "POST",
				data: form_data,
				success: function(data)
				{
					console.log("Logs here: ");
					console.log(data);
					//fetch_data();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted using PHP API");
					}
					if(data == 'update')
					{
						alert("Data Updated using PHP API");
					}
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				console.log("Data is here: ");
				console.log(data);

				$('#hidden_id').val(id);
				$('#name').val(data.name);
				$('#mobile').val(data.mobile);
				$('#message').val(data.message);
				$('#status').val(data.status);
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Edit Data');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Are you sure you want to remove this data using PHP API?"))
		{
			$.ajax({
				url:"action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					alert("Data Deleted using PHP API");
				}
			});
		}
	});

});
</script>
