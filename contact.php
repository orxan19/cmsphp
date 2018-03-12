<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

 <!--  WITHOUT HOSTING IT IS NOT WORKING AND GIVE ERRRRRROrSSS-->
<?php 


// if(isset($_POST['submit'])){
// 	$to         =  "baku_orxan17@mail.ru";
// 	$subject    =  wordwrap($_POST['subject'],70);
//     $body       =  $_POST['body'];
//     $headers =  'MIME-Version: 1.0' . "\r\n"; 
//     $headers .= 'From: Your name '. $_POST['email'] . "\r\n";
//     $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

//     mail($to, $subject , $body, $headers);
// }

 ?>
   
    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="" method="post" id="login-form" autocomplete="off">
                    	
                         <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                        </div>
                         <div class="form-group">
                            <label for="body">Body</label>
                           <textarea name="body" id="body" cols="10" rows="8" class="form-control" style="resize: none"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
