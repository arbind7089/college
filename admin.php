<?php
/*$ref=@$_GET['q'];
$email = $_POST['uname'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
session_start();
if(isset($_SESSION['email'])){
session_unset();}
$_SESSION["name"] = 'Admin';
$_SESSION["key"] ='sunny7785068889';
$_SESSION["email"] = $email;
header("location:dash.php?q=0");
}
else header("location:$ref?w=Warning : Access denied");*/
?>

<?php  

   session_start();  
   $globalError = '';
   include_once 'class.php';  
   $user = new User();  
   if ($user->session() && $_SESSION["admin"] =='admin')  
   {  
       header("location:dashboard.php?admin=0");  
   }  
   $user = new User();  
   if ($_SERVER["REQUEST_METHOD"] == "POST"){  
      $login = $user->adminlogin($_REQUEST['email'],$_REQUEST['password']); 
      if($login){  
         header("location:dashboard.php?admin=0");  
      }
      else
      {  
         $globalError = "Invalid user credentials!!";  
      }  
   }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('head.php'); ?>
</head>

<body id="body">
  <?php include_once('header.php');?>
  <main id="main">
    <section id="login" class="wow fadeInUp">
      <div class="container">
        <div class="row">   
          <div class="col-lg-4"></div>
          <div class="col-lg-4 box wow fadeInLeft" data-wow-delay="0.2s">
             <div class="row">
                <div class="col-md-10" style="margin: 15px 30px">        
                  <div class="contact-form">
                  <?php echo $globalError;?>
                    <form method="post" action="" id="contactform" class="contact">
                      <div class="form-group has-feedback">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email">
                        <i class="fa fa-user form-control-feedback"></i>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="password">Password*</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password">
                        <i class="fa fa-envelope form-control-feedback"></i>
                      </div>
                      <input type="submit" value="Submit" id="submit" class="submit btn btn-default">
                    </form>
                  </div>
                </div>
              </div>
          </div>
        <div class="col-lg-4"></div>
        </div>

        <br>
        <br>
        <br>
        

      </div>
    </section>

  </main>

  <?php include_once('footer.php'); ?>


 <script type="text/javascript">
  $(function() {
    $('form').submit(function () {
      var email = $('#email').val();
      var password = $('#password').val();
      
      $(".error").remove(); 
      
      if (email.length < 1) {
        $('#email').after('<span class="error"><i>This field is required</i></span>');
         return false;
      }     
      if (password.length < 4 || password.length > 15) {
        $('#password').after('<span class="error"><i>Minimum character should be 4 and maximum 15</i></span>');
         return false;
      }

      return true;
    });
  });

  </script>

</body>
</html>
