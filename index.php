<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php ob_start(); ?>
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">
                
                <?php 
                $per_page = 3; 

                if(isset($_GET['page'])){


                  $page = $_GET['page'];

                } else{

                    $page = 1;
                }
                if($page == "" || $page == 1){

                    $page_1 = 0;
                }else{

                    $page_1 = ($page * $per_page) - $per_page;
                }

                $post_query_count = "SELECT * from posts where post_status = 'published'";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);

                if($count < 1){
                    echo "<h1 class='text-center'>NO POSTS</h1>";
                } else{

                $count = ceil($count / $per_page);
                $query = "SELECT * from posts where post_status = 'published' ORDER BY post_id DESC limit $page_1, $per_page ";
                $select_all_posts_query = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc( $select_all_posts_query )) {
                    $post_title = $row['post_title'];
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = substr($row['post_content'], 0,100);
                    $post_status = $row['post_status'];

                    if($post_status == 'draft') continue;

                    if($post_status == 'published'){
                       
                        if(isset($post_author) && !empty($post_author)){
                        $real_user = $post_author;

                    } else if(isset($post_user) && !empty($post_user)){
                        $real_user = $post_user;
                    } else{
                        $real_user = "UNKNOWN";
                    }
                    // проверяем есть ли $post_user или $post_author чтобы вывести соответвующее
                   ?> 

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                

                <h2>
                    <a href="post/<?php echo $post_id?>"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $real_user; ?>&p_id=<?php echo $post_id; ?>"><?php 
                    echo $real_user;
                    
                     ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date ?></p>
                <hr>

                <a href="post.php?p_id=<?php echo $post_id?>">
                    <img class="img-responsive" width="500px" src="images/<?php echo $post_image; ?>" alt="a">
                </a>
                
                <hr>
                <p><?php echo $post_content ?></p>
                <a href="post.php?p_id=<?php echo $post_id?>" class="btn btn-primary">Read more</a>

                <hr>
            <?php }}} ?>  <?php ?> 
                
                
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        
    <ul class="pager">
        <?php 

        for($i = 1; $i <= $count; $i++){

            if($i == $page){
            echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
            
        } 
        else{
           echo "<li><a href='index.php?page={$i}'>{$i}</a></li>"; 
         }
        }

         ?>

    </ul>
    
<?php include "includes/footer.php"; ?>