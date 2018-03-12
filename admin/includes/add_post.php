<?php 


if(isset($_POST['create_post'])){
	$post_title = $_POST['title'];
	$post_user = $_POST['post_user'];
	$post_category_id = $_POST['post_category_id'];
	$post_status = $_POST['post_status'];

	$post_image = $_FILES['image']['name'];
	$post_image_temp = $_FILES['image']['tmp_name'];

	$post_tags = $_POST['post_tags'];
	$post_content = $_POST['post_content'];
	$post_date = date('d-m-y');
	
if(empty($post_tags) || $post_tags == '') {
          $post_tags = "Generic";
        }
        
	move_uploaded_file($post_image_temp, "../images/$post_image");

	$query = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) ";

	$query .= " VALUES ({$post_category_id},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

	$create_post_query = mysqli_query($connection, $query);

	$the_post_id = mysqli_insert_id($connection);
	
	echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$the_post_id}'> View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";


	
}

?>


<form action="" method="POST" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">
	</div>

	<div class="form-group">
		<label for="d">Category</label>
		<select name="post_category_id" id="">
			<?php 
$query = "SELECT * from category";

$select_categories = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc( $select_categories  )) {
  $cat_title = $row['cat_title'];
  $cat_id = $row['cat_id'];

echo "<option value='$cat_id'>{$cat_title}</option>";

}
			?>

		</select>

	</div>


<!-- <div class="form-group">
		<label for="post_category_id">Post Author</label>
		<input type="text" class="form-control" name="author">
	</div> -->

		<div class="form-group">
		<label for="users">Users</label>
		<select name="post_user" id="">
			<?php 
	$users_query = "SELECT * from users";

	$select_users = mysqli_query($connection, $users_query);

	while ($row = mysqli_fetch_assoc( $select_users  )) {
	  $user_id = $row['user_id'];
	  $username = $row['username'];

		echo "<option value='$username'>{$username}</option>";

			}
			?>

		</select>

	</div>

	<div class="form-group">
		

		<select name="post_status" id="">
			<option value="draft">Post Status</option>
			<option value="published">published</option>
			<option value="draft">draft</option>
		</select>
	</div>

		<div class="form-group">
		<label for="post_status">Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_status">Post Tags</label>
		<input type="text" name="post_tags" class="form-control" >
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control"  name="post_content" id="" cols="30" rows="10"></textarea>

		<input type="submit" style="margin-top: 20px" class="btn btn-primary" value="Add Post" name="create_post">
	</div>

</form>