<h3 class="titleResultTodos">To do list:</h3>

<div id="no-more-tables" class="table-responsive"> 
	<table class="table table-bordered table-hover table-condensed mytable">
		<thead><tr><th>ID</th><th>TITLU</th><th>DESCRIERE</th><th>DATA NOTIFICĂRII</th><th>IMAGINE</th><th>ACŢIUNI</th></tr></thead>
			<?php
				//$query = $this->db->get('todos'); 
				foreach ($todos as $row) {
			?>
			    <tr>
					<td> <?= $row['user_id'] ?> </td>
					<td> <?= $row['title'] ?> </td>
					<td> <?= $row['description'] ?> </td>
					<td> <?= $row['notification_date'] ?> </td>

					<? if( !empty( $row['image'] )) {?>
						<td><img id = "img" src = "/framework/thumbnails/<?= $row['image']; ?>"></td>

					<td>

						<a class="edit-user" data-toggle="tooltip" data-placement="left" title="Editează" href="/framework/index.php/todos/edit/<?= $row['id'] ?>"><img src="/framework/bootstrap/edit.png" width="20" height="20">
						</a>

						<form class="edit-user" data-toggle="tooltip" data-placement="right" title="Şterge" method="POST" action="" name="formEdit" enctype="multipart/form-data">
	 						<input type="hidden" name="actiontype" value='delete'>
	 						<input type="hidden" name="todoId" value='<?=$row['id']?>'>
	 						<input type="submit" class="delete-user" name="delete" value="">
	 					</form>

					</td>
				</tr>
			<?php } ?>
	</table>
</div>

