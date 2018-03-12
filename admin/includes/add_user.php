<?php 


if(isset($_POST['create_user'])){
	
	
	$user_firstname = ($_POST['user_firstname']);
	$user_lastname = ($_POST['user_lastname']);
	$user_role = ($_POST['user_role']);



	$username = ($_POST['username']);
	$user_email = ($_POST['user_email']);
	$user_password = ($_POST['user_password']);
	
	$user_password = (password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10)));


	$query = "INSERT INTO users(`user_firstname`, `user_lastname`, `user_role`, `username`, `user_email`, `user_password`) ";

	$query .= " VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}','{$user_password}') ";

	$create_user_query = mysqli_query($connection, $query);

		if(!$create_user_query){
			die(mysqli_error($connection));
		}

		echo "User Created: " . " " . "<a href='users.php'>View Users</a>";
	
}

?>


<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
		<label for="post_category_id">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="post_status">Lastname</label>
		<input type="text" class="form-control" name="user_lastname">
	</div>




	<div class="form-group">

		<select name="user_role" id="">

			<option value="subscriber">select options</option>
			<option value="admin">admin</option>
			<option value="subscriber">subscriber</option>

		</select>

	</div>



		<!-- <div class="form-group">
		<label for="post_status">Post Image</label>
		<input type="file" name="image">
	</div> -->

	<div class="form-group">
		<label for="post_status">Username</label>
		<input type="text" name="username" class="form-control" >
	</div>

	<div class="form-group">
		<label for="post_content">Email</label>
		<input type="email" class="form-control" name="user_email">
</div>

<div class="form-group">
		<label for="post_content">Password</label>
		<input type="password" class="form-control" name="user_password">
</div>

	<div class="form-group">
		<input type="submit" style="margin-top: 20px" class="btn btn-primary" value="Add user" name="create_user">
	</div>

</form>