<?php  
if(!isset($_SESSION)){ 
  session_start(); 
}  
   include_once 'class.php';  
   $user = new User;  
  $id = isset($_SESSION['id']) ? $_SESSION['id'] :( isset($_SESSION['admin'])? $_SESSION['admin'] : '');
 $name = isset($_SESSION['name']) ? $_SESSION['name'] : '';
 if (isset($_REQUEST['q'])){ 
    $user->logout();  
    header("location:login.php");  
 }
 if(!empty($id)){
    $profileImg = 'profile/'; 
    if (file_exists( $profileImg . $id.'.png')){
      $profileImg .= $id.'.png';
    } elseif (file_exists( $profileImg . $id.'.gif')) {
      $profileImg .= $id.'.gif';
    } elseif (file_exists( $profileImg . $id.'.jpeg')) {
      $profileImg .= $id.'.jpeg';
    } elseif (file_exists( $profileImg . $id.'.jpg')) {
      $profileImg .= $id.'.jpg';
    } elseif (file_exists( $profileImg . $id.'.pjpeg')) {
      $profileImg .= $id.'.pjpeg';
    } else{
      $profileImg .= 'default.jpeg';
    } 
  } 
?>

<?php if(!empty($id)){?>
<div class="container">
  <div class="row">
    <div style="text-align: right;width: 100%;height: 5px">
      <h5>Welcome <?php echo $name; ?> <img src="<?php echo $profileImg ?>" style="border-radius: 10px;" width="30" height="30"></h5>

    </div>
  </div>
</div>
<?php } ?>

<header id="header">
    
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="index.php"><img src="img/logo.png" alt="" title="" /></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <?php if($id == 'admin'){?>
            <li class="menu-active"><a href="dashboard.php?admin=0">Home</a></li>
            <?php } else{ ?>
            <li class="menu-active"><a href="index.php">Home</a></li>
          <?php }?>
          <li><a href="aboutus.php">About Us</a></li>
          <li><a href="admission.php">Admission</a></li>
          <li><a href="campuslife.php">Campus Life</a></li>
          <li><a href="contactus.php">Contact</a></li>
          <?php if(empty($id)){?>
          <li class="menu-has-children"><a href="" class="not-active">Register/Login</a>
            <ul>
              <li><a href="login.php">Login</a></li>
              <li><a href="register.php">Register</a></li>
            </ul>
          </li>
          <?php } else {?>

          <li><a href="tests.php?testId=1">Tests</a></li>
          <li class="menu-has-children"><a href="" class="not-active">Profile</a>
            <ul>
               <?php if($id != 'admin'){?>
              <li><a href="profile.php">Edit Profile</a></li>
              <?php } ?>
              <li><a href="?q=logout">Logout</a></li>
            </ul>
          </li>
          <?php }?>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header>