
	<h3 class="titleResultUsers">Useri existenţi :</h3>
	
	<div id="no-more-tables" class="table-responsive"> 
	<table class="table table-bordered table-hover table-condensed mytable"> 
	<thead><tr><th>ID</th><th>NUME</th><th>E-MAIL</th><th>DATA NAŞTERII</th><th>ACŢIUNI</th></tr></thead>
	
<?php

	foreach($users as $row) {
?>
	<tr>
		<td> <?= $row['id'] ?> </td>
		<td> <?= $row['name'] ?> </td>
		<td> <?= $row['email'] ?> </td>
		<td> <?= $row['birthday'] ?> </td>
		<td> <a class="edit-user" data-toggle="tooltip" data-placement="left" title="Editează" href="/framework/index.php/users/edit/<?= $row['id'] ?>"><img src="/framework/bootstrap/edit.png" width="20" height="20"></a> 


		<!--a href = '/framework/index.php/users/edit/<?= $row['id'] ?>' class="btn btn-primary" role="button" style="padding: 6px 10px;width: 35%;"> Editează </a-->
			 <form class="edit-user" data-toggle="tooltip" data-placement="right" title="Şterge" method="POST" action="" name="formEdit" enctype="multipart/form-data"> <?// form pt delete ?>
			 	
			 	<input type="hidden" name="actiontype" value='delete'>
			 	<input type="hidden" name="userId" value='<?=$row['id']?>'>
			 	<input type="submit" class="delete-user" name="delete" value="">

			 </form>
		</td>
	</tr>

<?php } ?>

	</table>
	</div>

	 <!-- Trigger the modal with a button -->
	<!--div id="formaddUser">
  		<button type="button" class="btn btn-yellow btn-lg" data-toggle="modal" data-target="#myModal">Adaugă user</button>
  	</div-->
  	<!-- Modal -->

