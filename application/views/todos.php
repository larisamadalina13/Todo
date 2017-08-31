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
	  				<li><a class="active" href="http://localhost/framework/index.php/todos" alt="link todos"><b>TODOS</b></a></li>
	  				<li><a href="http://localhost/framework/index.php/users" alt="link users"><b>USERS</b></a></li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="container">	

	<?php $this->load->view('resultsTodos'); ?>

	<div>
  		<button type="button" name="add" id="add" class="btn btn-yellow btn-lg" data-toggle="modal" data-target="#addModal">Adaugă to do</button>
  	</div>

	<div id="addModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
    			<div class="modal-header">
    				<button type="button" class="close" data-dismiss="modal">&times;</button>
    				<h3 class="titleInsertUserModal">Introduceţi un nou to do :</h3>
    			</div>
    			<div class="modal-body">
    				<form method="POST" id="insert_form" name="insert_form">
    				
    					<input type="hidden" name="actiontype" value='insert'>

    					<select class="form-control select" id="user_id" name="user_id">
							<option>Alegeţi user</option>
							<?php 
								foreach ($users as $value) {
									echo "<option value=".$value['id'].">".$value['name']."</option>";
								}	
							?>  
						</select><br>

    					<div class="form-group">
		 					<input type="text" class="form-control" id="title" placeholder="Titlu" name="title">
		 					<p style="color: red;font-size: 20" id="errorsTitle"></p>
						</div>

    					<div class="form-group">
							<textarea class="form-control TextAr" id="description" placeholder="Descriere" name="description" rows="9" cols="40"></textarea>
							<p style="color: red;font-size: 20" id="errorsDescription"></p>
						</div>

						<div class="form-group">
							<a class="fake" href="#">
								<input type="file" class="adauga-img" name="image" id="image" accept="image/jpeg" alt="imagine">
							</a>
							<p style="color: red;font-size: 20" id="errorsImage"></p>
						</div>

						<div class="form-group">
							<label for="notification_date">Data notificării :</label>
							<input type="date" class="form-control" id="notification_date" name="notification_date">
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
	<!--div class="row">
		<div class="col-sm-5 col-xs-12">
			<h3 class="titleResultTodos">Introduceţi un nou to do: </h3>

			<form method="POST" action="" class="introducere-todo" name="formTodos"  role="form" enctype="multipart/form-data">

			<input type="hidden" name="actiontype" value='insert'>
					<div class="myselect">
						<select class="form-control select" id="user_id" name="user_id">
							<option>Alegeţi user</option>
						<?php 
							foreach ($users as $value) {
								echo "<option value=".$value['id'].">".$value['name']."</option>";
						}	
						?>  
						</select><br>
					</div>
				<div class="form-group">
		 			<input type="text" class="form-control" id="title" placeholder="Titlu" name="title">
		 			<p style="color: red;font-size: 20"><?php if(isset($errors['title'])) echo $errors['title'];?></p>
				</div>
						
				<div class="form-group">
					<textarea class="form-control TextAr" id="description" placeholder="Descriere" name="description" rows="9" cols="40"></textarea>
					<p style="color: red;font-size: 20"><?php if(isset($errors['description'])) echo $errors['description'];?></p>
				</div>	

				<div class="form-group">
					<a class="fake" href="#">
						<input type="file" class="adauga-img" name="image" accept="image/jpeg" alt="imagine">
					</a>
					<p style="color: red;font-size: 20"><?php if(isset($imageErrors['image'])) echo $imageErrors['image'];?></p>
				</div>	
			
				<div class="form-group">
					<label for="notification_date">Notification Date:</label>
					<input type="date" class="form-control" id="notification_date" name="notification_date">
				</div>
			
					<input type="submit" class="btn btn-yellow mic" value="Trimite">
			</form>
		</div>
	</div-->

	
<script>
	$(document).ready(function(){
		$('#insert_form').on('submit',function(event){
			event.preventDefault();

			// reset errors
			$('#errorsTitle').html('');
			$('#errorsDescription').html('');
			$('#errorsImage').html('');

			$.ajax({
				url:"/framework/index.php/todos/insert",
				method:"POST",
				data:$('#insert_form').serialize (),
				success:function(response)
				{
					response = JSON.parse(response);

					if (response.success === false) {
						if(response.errors.title) { 
							$('#errorsTitle').html(response.errors.title);
						}

						if(response.errors.description) { 
							$("#errorsDescription").html(response.errors.description);
						} 

						if(response.errors.image) {
							$("#errorsImage").html(response.errors.image);
						}
					} else {
						location.reload();
					}
				}
			});
		});
	});
</script>
	<!--div class="row">
		<div class="col-sm-5 col-xs-12">
			<h3 class="titleResultTodos">Introduceţi un nou to do: </h3>

			<form method="POST" action="" class="introducere-todo" id="insert_form_todos" name="insert_form_todos" role="form" enctype="multipart/form-data">
				<select class="form-control select" id="user_id" name="user_id">
					<option>Alegeţi user</option>
					<?php 
						foreach ($users as $value) {
							echo "<option value=".$value['id'].">".$value['name']."</option>";
						}	
					?>  
				</select><br>

				<input type="hidden" name="actiontype" value='insert'>
				<div class="form-group">
		 			<input type="text" class="form-control" id="title" placeholder="Titlu" name="title">
		 			<p style="color: red;font-size: 20"><?php if(isset($errors['title'])) echo $errors['title'];?></p>
				</div>
						
				<div class="form-group">
					<textarea class="form-control TextAr" id="description" placeholder="Descriere" name="description" rows="9" cols="40"></textarea>
					<p style="color: red;font-size: 20"><?php if(isset($errors['description'])) echo $errors['description'];?></p>
				</div>	

				<div class="form-group">
					<a class="fake" href="#">
						<input type="file" class="adauga-img" name="image" id="image" accept="image/jpeg" alt="imagine"> 
					</a>
					<p style="color: red;font-size: 20"><?php if(isset($imageErrors['image'])) echo $imageErrors['image'];?></p>
				</div>	
			
				<div class="form-group">
					<label for="notification_date">Data notificării :</label>
					<input type="date" class="form-control" id="notification_date" name="notification_date">
				</div>
			
					<input type="submit" id="myBtn" class="btn btn-yellow mic" value="Trimite">
			</form>
		</div>
	</div-->
	</div>

	<?php
	echo '<br>';
	$this->load->view('footer'); 
	?>
</body>
</html>