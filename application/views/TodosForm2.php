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
</head>
<body>

<?php 
		$this->load->view('menuTodos'); 
?>
<div class="container">	
<h3 class="titleResultTodos">Modificare to do: </h3>

<form method="POST" action="" class="introducere-todo" name="formTodosEdit" role="form" enctype="multipart/form-data">
		<div class="myselect form-group">
			<select class="form-control select" id="user_id" name="user_id">
				<option>Alegeţi user</option>
			<?php 
				foreach ($users as $value) {
					echo "<option value=".$value['id'].">".$value['name']."</option>";
			}	
			?>  
			</select><br>
		</div>
	
	<!--input type="hidden" name="actiontype" value='insert'-->
	<div class="form-group">
		<label for="name">Titlu :</label>
		<input type="text" class="form-control" id="title" value="<?= $todo['title']; ?>" name="title">
		<p style="color: red;font-size: 20"><?php if(isset($errors['title'])) echo $errors['title'];?></p>

	</div>
			
	<div class="form-group">
		<label for="description">Description :</label>
		<textarea class="form-control TextAr" id="description" name="description" value="<?= $todo['description']; ?>" rows="9" cols="40"></textarea>
		<p style="color: red;font-size: 20"><?php if(isset($errors['description'])) echo $errors['description'];?></p>
	</div>	

	<div class="form-group">
		<a class="fake" href="#">
			<input type="file" class="adauga-img" name="image" id="image" accept="image/jpeg" alt="imagine"> <!--a -->
		</a>
		<p style="color: red;font-size: 20"><?php if(isset($imageErrors['image'])) echo $imageErrors['image'];?></p>
	</div>	

	<div class="form-group">
		<label for="notification_date">Data notificării :</label>
		<input type="date" class="form-control" id="notification_date" value="<?= $todo['notification_date']; ?>" name="notification_date">
	</div>

		<input type="submit" class="btn btn-yellow edit" name='submit' value="Modifică">
		<a href="http://localhost/framework/index.php/todos" class="btn btn-yellow anulare">Anulează</a>
</form>

</div>


<?php
	echo '<br>';
	$this->load->view('footer'); 
?>


</body>
</html>