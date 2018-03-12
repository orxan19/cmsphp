              <form action="" method="post">
                         <div class="form-group">
                          <label for="cat_title2">Edit Category</label>
                            <?php 
$message ="";
                            
if(isset($_GET['edit'])){

  $cat_id = ($_GET['edit']);

$query = "SELECT * from category where cat_id = $cat_id ";

$select_categories_id = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc( $select_categories_id  )) {
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

?>
<input value="<?php  if(isset($cat_title)){echo $cat_title;}  ?>" type="text" class="form-control" name="cat_title" id="cat_title2">

<?php }} ?>

<?php 
 if(isset($_POST['update_category'])){
         $the_cat_title = ($_POST['cat_title']);

         $query = "UPDATE category SET cat_title = '{$the_cat_title}' Where cat_id = {$cat_id} ";
         $update_query  = mysqli_query($connection, $query);
         
         if($update_query){
          $message = "Category updated";
         }
       }
?>
                         </div>
                         <div class="form-group">
                             <input class="btn btn-primary" type="submit" name="update_category" value="Update Category">
                             
                         </div>
                         <?php echo $message; ?>
                     </form>