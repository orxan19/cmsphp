<?php

if(isset($_GET['edit_user'])){
	$the_user_id = $_GET['edit_user'];

$query = "SELECT * from users where user_id = '$the_user_id'";
$select_users_query = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc( $select_users_query )) {
    $user_id             = $row['user_id'];
   	$username            = $row['username'];
    $user_password       = $row['user_password'];
    $user_firstname      = $row['user_firstname'];
    $user_lastname       = $row['user_lastname'];
    $user_email          = $row['user_email'];
    $user_image          = $row['user_image'];
    $user_role           = $row['user_role'];

	}
}



if(isset($_POST['edit_user'])){
	
	
	$user_firstname = ($_POST['user_firstname']);
	$user_lastname = ($_POST['user_lastname']);
	$user_role = ($_POST['user_role']);

	// $post_image = $_FILES['image']['name'];
	// $post_image_temp = $_FILES['image']['tmp_name'];

	$username = ($_POST['username']);
	$user_email = ($_POST['user_email']);
	$user_password = ($_POST['user_password']);
	$post_date = date('d-m-y');
	

	if(!empty($user_password))
	{

$query_password = "SELECT user_password from users where user_id = $the_user_id";
$get_user_query = mysqli_query($connection, $query);

$row = mysqli_fetch_array($get_user_query);

$db_user_password = $row['user_password'];
	}

if($db_user_password != $user_password){
	$hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));
}
$query = "UPDATE users set ";
   	$query .= "user_firstname = '{$user_firstname}', ";
   	$query .= "user_lastname = '{$user_lastname}', ";
   	$query .= "user_role = '{$user_role}', ";
   	$query .= "username ='{$username}', ";
   	$query .= "user_email ='{$user_email}', ";
   	$query .= "user_password ='{$hashed_password}' ";
    $query .= "WHERE user_id = {$the_user_id}";

    $edit_user_query = mysqli_query($connection, $query);

    echo "USER updated" . "<a href='users.php'>View users</a>";
}
?>


<form action="" method="POST" enctype="multipart/form-data">

<div class="form-group">
		<label for="post_category_id">Firstname</label>
		<input type="text" class="form-control" value="<?php echo $user_firstname;?>" name="user_firstname">
	</div>

	<div class="form-group">
		<label for="post_status">Lastname</label>
		<input type="text" class="form-control" value="<?php echo $user_lastname;?>" name="user_lastname">
	</div>




	<div class="form-group">

		<select name="user_role" id="">
			<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
<?php 

if($user_role == 'admin'){
	echo "<option value='subscriber'>subscriber</option>";
} else{
	echo "<option value='admin'>admin</option>";
}



 ?>
			
			

		</select>

	</div>



		<!-- <div class="form-group">
		<label for="post_status">Post Image</label>
		<input type="file" name="image">
	</div> -->

	<div class="form-group">
		<label for="post_status">Username</label>
		<input type="text" value="<?php echo $username;?>" name="username" class="form-control" >
	</div>

	<div class="form-group">
		<label for="post_content">Email</label>
		<input type="email" value="<?php echo $user_email;?>" class="form-control" name="user_email">
</div>

<div class="form-group">
		<label for="post_content">Password</label>
		<input type="password" value="" class="form-control" name="user_password">
</div>

	<div class="form-group">
		<input type="submit" style="margin-top: 20px" class="btn btn-primary" value="Edit user" name="edit_user">
	</div>

</form>