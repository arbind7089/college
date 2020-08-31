<?php  
   include_once 'class.php';  
   $user = new User(); 
   $message = ''; 

   if(!isset($_SESSION)){ 
      session_start(); 
   }
   if ($_SERVER["REQUEST_METHOD"] == "POST"){  
      if($_POST["captcha_code"]!==$_SESSION["captcha_code"]){ 
        $msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect.   
      }else{// Captcha verification is Correct. Final Code Execute here!    
        $msg=""; 

      }

      $trn_date = date("Y-m-d H:i:s");  
      if(!$msg){
        $register = $user->register($_REQUEST['name'],$_REQUEST['email'], $_REQUEST['mobile'], $_REQUEST['password']);  
        if($register){  
            header("location:login.php");  
        }
        else
        {  
           $message = "Entered email or mobile already exist!";  
        }
      }else{
        $message = "The Validation code does not match!";
      }
        
   }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('head.php'); ?>
  <style type="text/css">
    .captcha-input {
      background:#FFF url('captcha_code.php') repeat-y;
      padding-left: 85px;
    }
  </style>
</head>

<body id="body">


  <!--==========================
    Header
  ============================-->
  <?php include_once('header.php');?>
  <!-- #header -->

  <!--==========================
    Intro Section
  ============================-->



  <main id="main">

    <!--==========================
      About Section
    ============================-->

    <section id="login" class="wow fadeInUp">      
      <div class="container">
        <?php if($message != ''){ ?>
        <div class="row">
          <div class="row alert alert-danger col-lg-12" role="alert">
            <?php echo $message;?>
          </div>
        </div>
        <?php } ?>
        <div class="row">   
          <div class="col-lg-4"></div>
          <div class="col-lg-4 box wow fadeInLeft" data-wow-delay="0.2s">
             <div class="row">
                <div class="col-md-10" style="margin: 15px 30px">        
                  <div class="contact-form">
                  
                    <form method="post" action="" id="registerform" class="contact">
                     <div class="form-group has-feedback">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        <i class="fa fa-user form-control-feedback"></i>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="email">Email*</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="email">
                        <i class="fa fa-user form-control-feedback"></i>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="mobile">Mobile</label>
                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile">
                        <i class="fa fa-user form-control-feedback"></i>
                      </div>
                      <div class="form-group has-feedback">
                        <label for="password">Password*</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="password">
                        <i class="fa fa-envelope form-control-feedback"></i>
                      </div>

                      <div class="form-group has-feedback">
                        Captcha Code: <div id="error-captcha" class="demo-error"><?php if(isset($msg)) { echo $msg; } ?></div><br/>
                        <input name="captcha_code" type="text" class="demo-input captcha-input">
                      </div>

                      <input type="submit" value="Submit" id="submit" class="submit btn btn-default">
                      OR <a href="login.php">Login here</a>
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





  <!--==========================
    Footer
  ============================-->
  <?php include_once('footer.php'); ?>
<!-- #footer -->


  <script type="text/javascript">
  $(function() {
    $('form').submit(function () {
      var name = $('#name').val();
      var mobile = $('#mobile').val();
      var email = $('#email').val();
      var password = $('#password').val();
      
      $(".error").remove();
 
      if (name.length < 1) {
        $('#name').after('<span class="error"><i>This field is required</i></span>');
         return false;
      }
      if (email.length < 1) {
        $('#email').after('<span class="error"><i>This field is required</i></span>');
         return false;
      }
      if (mobile.length < 1) {
        $('#mobile').after('<span class="error"><i>This field is required</i></span>');
         return false;
      }else if(!mobile.match('[0-9]{10}'))  {
          $('#mobile').after('<span class="error"><i>Please enter valid mobile number</i></span>');
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
