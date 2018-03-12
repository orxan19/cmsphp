<?php 

function redirect($location){
    return header("Location: " . $location); 
}


function users_online(){
global $connection;
$session = session_id();
$time = time();
$time_out_in_seconds = 60;
$time_out = $time - $time_out_in_seconds;

$query = "SELECT * from users_online where session = '$session' ";
$send_query = mysqli_query($connection, $query);
$count = mysqli_num_rows($send_query);

if($count == NULL){
    mysqli_query($connection, "INSERT into users_online(session, times) VALUES('$session', '$time')");
    
    
} 
else{
    mysqli_query($connection, "UPDATE users_online set times = '$time' where session = '$session'");

}
$users_online_query = mysqli_query($connection, "SELECT * from users_online where times > '$time_out'");

return $count_user = mysqli_num_rows($users_online_query);
}


function insert_categories(){
	global	$connection;
	
        if(isset($_POST['submit'])){
            $cat_title = $_POST['cat_title'];

            if($cat_title == "" || empty($cat_title)){
                echo "This field should not be empty";
            } else{
                $query = "INSERT into category(cat_title)  ";
                $query .= "values('{$cat_title}') ";

                $create_category_query = mysqli_query($connection, $query);

                if(!$create_category_query){
                    die("WTF " . mysqli_error());
                }
            }
        }
}

function findAllCategories(){
	global	$connection;
	$query = "SELECT * from category";

	$select_categories = mysqli_query($connection, $query);

	while ($row = mysqli_fetch_assoc( $select_categories )) {
		$cat_id = $row['cat_id'];
		$cat_title = $row['cat_title'];
		echo "<tr>";
		echo "<td>{$cat_id}</td>";
		echo "<td>{$cat_title}</td>";
		echo "<td><a class='btn btn-danger' href='categories.php?delete={$cat_id}'>Delete</a></td>";
		echo "<td><a class='btn btn-info' href='categories.php?edit={$cat_id}'>Edit</a></td>";
		echo "<tr>";
	} 
}








function deleteCategories(){
	global	$connection;
	if(isset($_GET['delete'])){
         $the_cat_id = $_GET['delete'];

         $query = "DELETE from category WHERE cat_id = {$the_cat_id} ";
         $delete_query  = mysqli_query($connection, $query);
         exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");            }

}

function is_admin($username = ''){

    global $connection;
    $query = "SELECT user_role from users where username = '$username' ";
    $result =  mysqli_query($connection, $query);
   $row = mysqli_fetch_array($result);

   if($row['user_role'] == 'admin'){
    return true;
   } else{
    return false;
   }

}


function recordCount($table){
    global $connection;
    $query = "SELECT * from " . $table;
    $select_all_post = mysqli_query($connection, $query);
    $result = mysqli_num_rows($select_all_post);

    return $result;
}


function checkStatus($table, $column, $status){
    global $connection;
    $query = "SELECT * from $table WHERE $column = '$status' ";
    $result = mysqli_query($connection, $query);

    return   mysqli_num_rows($result);
}

function username_exist($username){

     global $connection;

    $query = "SELECT username from users where username = '$username' ";
    $result =  mysqli_query($connection, $query);
   
    if(mysqli_num_rows($result) > 0){
        return true;
    } else{
        return false;
    }
}

function email_exist($email){

     global $connection;

    $query = "SELECT user_email from users where user_email = '$email' ";
    $result =  mysqli_query($connection, $query);
   
    if(mysqli_num_rows($result) > 0){
        return true;
    } else{
        return false;
    }
}

function register_user($username, $email, $password){
    global $connection;

    $username = mysqli_real_escape_string($connection, $username);
    $email    = mysqli_real_escape_string($connection, $email);
    $password = mysqli_real_escape_string($connection, $password);

    $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));     

        $query = "INSERT into users (username, user_email, user_password, user_role) ";
        $query .= "VALUES ('{$username}', '{$email}','{$password}','subscriber' )";

        $register_user_query = mysqli_query($connection, $query);

}

function login_user($username, $password){

global $connection;
$username = trim($username);
$password = trim($password);

$username = mysqli_real_escape_string($connection, $username);
$password = mysqli_real_escape_string($connection, $password);

$query = "SELECT * from users WHERE username = '{$username}'";
$select_user_query = mysqli_query($connection, $query);

if(!$select_user_query){
    die("query failed " . mysqli_error($connection));
}

while($row = mysqli_fetch_array($select_user_query)){

     $db_user_id = $row['user_id'];
     $db_username = $row['username'];
     $db_user_password = $row['user_password'];
     $db_user_firstname = $row['user_firstname'];
     $db_user_lastname = $row['user_lastname'];
     $db_user_role = $row['user_role'];



}

if(password_verify($password,$db_user_password) && $username === $db_username){
    $_SESSION['username'] = $db_username;
    $_SESSION['firstname'] = $db_user_firstname;
    $_SESSION['lastname'] = $db_user_lastname;
    $_SESSION['user_role'] = $db_user_role;

    redirect("/cms/admin");
}
}



?>