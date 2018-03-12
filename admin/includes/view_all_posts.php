<?php 

if(isset($_POST['checkBoxArray'])){


  foreach ($_POST['checkBoxArray'] as $post_value_id) {
    $bulk_options = ($_POST['bulk_options']);

    switch ($bulk_options) {
      case 'published':
 $query = "UPDATE posts Set post_status = '{$bulk_options}' where post_id = {$post_value_id} ";
 $update_to_published_status = mysqli_query($connection, $query);
        break;

        case 'draft':
 $query = "UPDATE posts Set post_status = '{$bulk_options}' where post_id = {$post_value_id} ";
 $update_to_draft_status = mysqli_query($connection, $query);
        break;

        case 'delete':
 $query = "DELETE from posts where post_id = {$post_value_id} ";
 $update_to_delete_status = mysqli_query($connection, $query);
        break;
      
      case 'clone':
      $query = "SELECT * from posts where post_id = '{$post_value_id}' ";
      $select_post_query = mysqli_query($connection, $query);
      while($row = mysqli_fetch_array($select_post_query)){
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_date = $row['post_date'];
        $post_author = $row['post_author'];
        $post_user = $row['post_user'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_content = $row['post_content'];

        if(empty($post_tags) || $post_tags == '') {
          $post_tags = "Generic";
        }
      }
      $query = "INSERT INTO `posts`(`post_category_id`, `post_title`, `post_author`,`post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_status`) ";

  $query .= " VALUES ('{$post_category_id}','{$post_title}','{$post_author}','{$post_user}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}') ";

  $create_post_query = mysqli_query($connection, $query);
      if(!$create_post_query){
        die(mysqli_error($connection));
      } 
      break;
      default:
        
        break;
    }
  }
}


 ?>


<form action="" method="post">
                  <table class="table table-bordered table-hover">
                    <div id="bulkOptionsContainer" class="col-xs-4">
                      
                      <select name="bulk_options" id="" class="form-control">
                        <option value="">Select Options</option>
                        <option value="published">Publish</option>
                        <option value="draft">Draft</option>
                        <option value="delete">Delete</option>
                        <option value="clone">Clone</option>
                      </select>

                    </div>
                    <div class="col-xs-4">
                      <input type="submit" class="btn btn-success" value="Apply">
                      <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
                    </div>
                    <thead>
                      <tr>
                        <th><input id="selectAllBoxes" type="checkbox"></th>
                        <th>Id</th>
                        <th>User</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Tags</th>
                        <th>Comments</th>
                        <th>Date</th>
                        <th>View Post</th>
                        <th>Editing</th>
                        <th>Deleting</th>
                        <th>Views count</th>
                        <th>Reseting</th>
                      </tr>
                    </thead>
                    <tbody>
             
              <?php 

              // $query = "SELECT * from posts ORDER BY post_id DESC ";
             
 $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title,posts.post_category_id, posts.post_status, posts.post_image, ";

 $query .= "posts.post_tags , posts.post_comment_count , posts.post_date , posts.post_views_count , category.cat_id , category.cat_title ";

 $query .= " FROM posts ";
 $query .= "LEFT JOIN category ON posts.post_category_id = category.cat_id order by posts.post_id desc";

  $select_posts = mysqli_query($connection, $query);

  while ($row = mysqli_fetch_assoc( $select_posts )) {
    $post_id            = $row['post_id'];
    $post_author        = $row['post_author'];
    $post_user          = $row['post_user'];
    $post_title         = $row['post_title'];
    $post_category_id   = $row['post_category_id'];
    $post_status        = $row['post_status'];
    $post_image         = $row['post_image'];
    $post_tags          = $row['post_tags'];
    $post_comment_count = $row['post_comment_count'];
    $post_date          = $row['post_date'];
    $post_views_count   = $row['post_views_count'];
    $category_title   = $row['cat_title'];
    $category_id   = $row['cat_id'];

    echo "<tr>";
    ?>
    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>
    <?php  
    
    echo "<td>{$post_id}</td>";

    if(!empty($post_author)){

    echo "<td>{$post_author}</td>";

} elseif(!empty($post_user)) {

  echo "<td>{$post_user}</td>";

}


    echo "<td>{$post_title}</td>";

    echo "<td>{$category_title}</td>";

    echo "<td>{$post_status}</td>";

    echo "<td><img src='../images/$post_image' class='img img-responsive' width='100px'></td>";

    echo "<td>{$post_tags}</td>";

    $query = "SELECT * from comments where comment_post_id = $post_id";
    $send_comment_query = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($send_comment_query);
    $comment_id = $row['comment_id'];
    $count_comments = mysqli_num_rows($send_comment_query);

    echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";



    echo "<td>{$post_date}</td>";
    echo "<td><a href='../post.php?p_id={$post_id}' class='btn btn-primary'>View Post</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}' class='btn btn-warning'>Edit</a></td>";

    ?>

    <form method="post" action="posts.php?post_id<?php $post_id?>&delete=Delete">
      <input type="hidden" name="post_id" value="<?php echo $post_id;?>"> 
      <?php  
      echo '<td><input type="submit" class="btn btn-danger" name="delete" value="Delete"</td>';
      ?>
    </form>


    <?php  

    // echo "<td><a onClick=\"javascript: return confirm('Are you sure?')\" href='posts.php?delete={$post_id}'>Delete</a></td>";


    echo "<td><a href='#' class='btn btn-info'>{$post_views_count}</a></td>";
    echo "<td><a href='posts.php?reset={$post_id}' class='btn' style='background-color: #444; color: #fff; '>Reset Views</a></td>";
    echo "</tr>";
}
                    ?>


                    </tbody>
                  </table>
                  </form>

<?php
if(isset($_POST['delete'])){

   $the_post_id = $_POST['post_id'];
   $query = "DELETE From posts where post_id = {$the_post_id}";

   $delete_query = mysqli_query($connection, $query);
 exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
   
}

if(isset($_GET['reset'])){

   $the_post_id = ($_GET['reset']);
   $query = "UPDATE posts SET post_views_count = 0 where post_id = $the_post_id";

   $reset_query = mysqli_query($connection, $query);
 exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
   
}
 ?>
