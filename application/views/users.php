
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">	
	<link rel="stylesheet" href="/framework/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="/framework/bootstrap/css/style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
		<script>
		$(document).ready(function(){
    		$('[data-toggle="tooltip"]').tooltip();   
	});
	</script>

</head>
<body>

	<nav class="navbar navbar-default bg-menu" role="navigation">
		<div class="container">
	<!-- logo menu -->
			<div class="navbar-header">		
				
				<img src="/framework/bootstrap/logo-to-do.png" width="150" height="50" />
				<!--a class="navbar-brand" href="#">Todo List App</a-->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#mycollapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="mycollapse">
				<!--menu items-->
				<ul class="nav navbar-nav">
	  				<li><a href="http://localhost/framework/index.php/todos" alt="link todos"><b>TODOS</b></a></li>
	  				<li><a class="active" href="http://localhost/framework/index.php/users" alt="link users"><b>USERS</b></a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">	
	<?php $this->load->view('resultsUsers'); ?>

	<div>
  		<button type="button" name="add" id="add" class="btn btn-yellow btn-lg" data-toggle="modal" data-target="#addModal">Adaugă user</button>
  	</div>

	<div id="addModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">&times;</button>
    				<h3 class="titleInsertUserModal">Introduceţi User :</h3>
    			</div>
    			<div class="modal-body">
    				<form method="POST" id="insert_form" name="insert_form">
    				
    					<input type="hidden" name="actiontype" value='insert'>
    					<div class="form-group">
    						<input type="text" class="form-control" id="name" name="name" placeholder="Numele dvs.">
    						<p style="color: red;font-size: 15" id="errorsName"></p>
    					</div>
    					<div class="form-group">
    						<input type="email" class="form-control" id="email" name="email" placeholder="E-mailul dvs.">
							<p style="color: red;font-size: 15" id="errorsEmail"></p>
						</div>
						<div class="form-group">
							<input type="date" class="form-control" placeholder="birthday" id="birthday" name="birthday">
						</div>

						<input type="submit" class="btn btn-yellow mic" name="insert" id="insert" value="Trimite">
    				</form>
    			</div>	
    			<div class="modal-footer">
       			 	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      			</div>
    		</div>
    	</div>
	</div>
<script>
	$(document).ready(function(){
		$('#insert_form').on('submit',function(event){
			event.preventDefault();

			// reset errors
			$('#errorsName').html('');
			$('#errorsEmail').html('');

			$.ajax({
				url:"/framework/index.php/users/insert",
				method:"POST",
				data:$('#insert_form').serialize (),
				success:function(response)
				{
					response = JSON.parse(response);

					if (response.success === false) {
						if(response.errors.name) { 
							$('#errorsName').html(response.errors.name);
						}

						if(response.errors.email) { 
							$("#errorsEmail").html(response.errors.email);
						} 
					} else {
						location.reload();
					}
				}
			});
		});
	});
</script>



	<!--h3 class="titleResultUsers introducere-user">Introduceţi User: </h3-->

	<!--form method = "POST" action="" class="adauga-user" name="formUsers" role="form" enctype="multipart/form-data">
		<div class="form-group">
			<input type="hidden" name="actiontype" value='insert'>
		</div>

		<div class="form-group">
			<input type="text" class="form-control" id="name" name="name" placeholder="Numele dvs.">
			<p style="color: red;font-size: 15"><?php if(isset($errors['name'])) echo $errors['name'];?></p>
		</div>
		
		<div class="form-group">
			<input type="email" class="form-control" id="email" name="email" placeholder="E-mailul dvs.">
			<p style="color: red;font-size: 15"><?php if(isset($errors['email'])) echo $errors['email'];?></p>
		</div>	

		<div class="form-group">
			<input type="date" class="form-control" id="birthday" name="birthday" >
		</div>		

		
			<input type="submit" class="btn btn-yellow mic" value="Trimite">   
	</form-->
	</div>

<?php
	echo '<br>';
	$this->load->view('footer'); 
?>

</body>
</html>