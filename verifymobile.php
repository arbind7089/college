<?php  

   session_start();  
   $globalError = '';
   include_once 'class.php';  

   $user = new User();  
   if ($user->session())  
   {  
      header("location:index.php");  
   }  
  
   $user = new User();  
   if ($_SERVER["REQUEST_METHOD"] == "POST"){  
      $verified = $user->verifyOTP($_REQUEST['otp'], $_SESSION['email']);  
      if($verified){  
         header("location:index.php");  
      }
      else
      {  
         $globalError = "The OTP you have entered is invalid";  
      }  
   }  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <?php include_once('head.php'); ?>
</head>

<body id="body">


  <!--==========================
    Header
  ============================-->
  <?php include_once('header.php');?>
  <!-- #header -->



  <main id="main">

    <!--==========================
      About Section
    ============================-->
    <section id="login" class="wow fadeInUp">
      <div class="container">

        <?php if($globalError != ''){ ?>
        <div class="row">
          <div class="row alert alert-danger col-lg-12" role="alert">
            <?php echo $globalError;?>
          </div>
        </div>
        <?php } ?>

        <div class="row">   
          <div class="col-lg-4"></div>
          <div class="col-lg-4 box wow fadeInLeft" data-wow-delay="0.2s">
             <div class="row">
                <div class="col-md-10" style="margin: 15px 30px">        
                  <div class="contact-form">
                    <form method="post" action="" id="contactform" class="contact">
                      <div class="form-group has-feedback">
                        <label for="mobile">OTP*</label>
                        <input type="text" class="form-control" name="otp" id="otp" placeholder="Please enter otp sent to your mobile">
                      </div>
                      <input type="submit" value="Verify" id="submit" class="submit btn btn-default">
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

  <!--==== Footer =========-->
  <?php include_once('footer.php'); ?>
  <!-- #footer -->
   <script type="text/javascript">
    $(function() {
      $('form').submit(function () {
        var otp = $('#otp').val();
        
        $(".error").remove(); 
        
        if (otp.length < 1) {
          $('#otp').after('<span class="error"><i>This field is required</i></span>');
           return false;
        }

        return true;
      });
    });
  </script>

</body>
</html>
