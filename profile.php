<?php  
	session_start();  
	include_once 'class.php';  
	$user = new User;  
	$id = isset($_SESSION['id']) ? $_SESSION['id'] : '';

	if (!$id){   
	    header("location:login.php");  
	 }

	$details = $user->getProfile($id);
	$profileImg = 'profile/';

	if ($_SERVER["REQUEST_METHOD"] == "POST"){ 
			$user->updateProfile($id,$_POST);
	} 
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include_once('head.php');?>
</head>
<body>
<div id="wrapper">

	<!-- start header -->
	<?php include_once('header.php');?>
	<!-- end header -->
		<section id="profile">
			<div class="container" style="padding-top: 60px;">
			  <h1 class="page-header">Edit Profile</h1>
			  <div class="row">
			    <!-- left column -->
			    <div class="col-md-4 col-sm-6 col-xs-12 personal-info">
			    	<img src="<?php echo $profileImg ?>" class="img-circle" alt="Cinque Terre" width="304" height="236">

			    	<form action="upload_file.php" method="post"
					enctype="multipart/form-data">
					<label for="file">Filename:</label>
					<input type="file" name="file" id="file"><br>
					<input type="submit" name="submit" value="Submit">
					</form>

			  	</div>
			    <!-- edit form column -->
			    <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
			      <form class="form-horizontal" role="form" method="POST">
			        <div class="form-group">
			          <label class="col-lg-3 control-label">Name</label>
			          <div class="col-lg-8">
			            <input class="form-control" value="<?php echo $details['name'] ?>" type="text" name="name">
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-lg-3 control-label">Email:</label>
			          <div class="col-lg-8">
			            <input class="form-control" value="<?php echo $details['email'] ?>" type="text" name="email">
			            <i class="ion-android-checkmark-circle verified"></i>
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-md-3 control-label">Mobile:</label>
			          <div class="col-md-8">
			            <input class="form-control" value="<?php echo $details['mobile'] ?>" type="text" name="mobile"  disabled>
			            <i class="ion-android-checkmark-circle"></i>
			          </div>
			        </div>
			        <div class="form-group">
			          <label class="col-md-3 control-label"></label>
			          <div class="col-md-8">
			            <input class="btn btn-primary" value="Save Changes" type="submit">
			            <span></span>
			            <input class="btn btn-default" value="Cancel" type="reset">
			          </div>
			        </div>
			      </form>
			    </div>			    
			  </div>
			</div>

		</section>
	<!--start footer-->	
	<?php include_once('footer.php');?>
	<!--end footer-->
</body>
</html>