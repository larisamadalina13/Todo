<div class="container">	
	<h3 class="titleResultUsers">Introduceţi User: </h3>

	<form method = "POST" action = "" name = "formUsers" role="form" enctype="multipart/form-data">
		<div class="form-group">
			<input type="hidden" name="actiontype" value='insert'>
		</div>

		<div class="form-group">
			<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Numele dvs.">
				<p style="color: red;font-size: 15"><?php if(isset($errors['name'])) echo $errors['name'];?></p>
		</div>
		
		<div class="form-group">
			<label for="email">Email:</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="E-mailul dvs.">
			<p style="color: red;font-size: 15"><?php if(isset($errors['email'])) echo $errors['email'];?></p>
		</div>	

		<div class="form-group">
			<label for="birthday">Birthday:</label>
			<input type="date" class="form-control" id="birthday" name="birthday" >
		</div>		

		
			<input type="submit" class="btn btn-success" value="Submit">   <!-- SPATIU intre butoane ... -->
			<input type="reset" class="btn btn-primary">
			
	</form>
</div>