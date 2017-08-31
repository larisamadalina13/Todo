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
		$this->load->view('menu'); 
	?>
	<div class="container">	
	<h3 class="titleResultUsers">Modificare date User:</h3>

	<form method="POST" action="" name="formEdit" enctype="multipart/form-data">
		<div class="form-group">	
			<label for="name">Name:</label>
				<input type="text" name="name" value="<?= $user['name']; ?>" >
				<p style="color: red;font-size: 15"><?php if(isset($errors['name'])) echo $errors['name'];?></p>
		</div>

		<div class="form-group">
			<label for="email">Email:</label>
				<input type="email" name="email" value="<?= $user['email']; ?>">
				<p style="color: red;font-size: 15"><?php if(isset($errors['email'])) echo $errors['email'];?></p>
		</div>

		<div class="form-group">
			<label for="birthday">Birthday:</label>
				<input type="date" name="birthday" value="<?= $user['birthday']; ?>">
		</div>

		<input type="submit" class="btn btn-yellow edit" name='submit' value="Modifică">
		<a href="http://localhost/framework/index.php/users" class="btn btn-yellow anulare">Anulează</a>

	</form>
</div>


<?php
	echo '<br>';
	$this->load->view('footer'); 
?>

</body>
</html>