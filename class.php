<?php 
error_reporting(0);
define('HOST', 'localhost');  
define('USER', 'root');  
define('PASS', '');  
define('DB', 'school');  

class DB{  
  function __construct() {  
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    // Perform a query, check for error
   /* if ( !mysqli_query($con,"INSERT INTO Persons (FirstName) VALUES ('Glenn')"))
      {
      echo("Error description: " . mysqli_error($con));
      } */
  }  
}  

class User{  
    public function __construct() {  
      $db = new DB;  
    }  

    public function register($name, $email, $mobile, $pass) {  
      $con=mysqli_connect(HOST,USER,PASS,DB);
      if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $pass = md5($pass);  

      $checkuser = mysqli_query($con,"Select id from student where email='$email' or  mobile='$mobile'");  
      $result = 0;
      if($checkuser!=''){
        $result = mysqli_num_rows($checkuser);
      }
       

      if ($result == 0) {  
        //echo "Insert into student (`name`, `email`, `mobile`, `password`) values ('$name', '$email','$mobile','$pass')";
        $register = mysqli_query($con,"Insert into student (`name`, `email`, `mobile`, `password`) values ('$name', '$email','$mobile','$pass')") or die("Error while insert new record"); 
        return $register;  
      } else {  
        return false;  
      }  
    }  

  public function login($email, $pass) {  
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } 
    $_SESSION['email'] = '';
    $pass   = md5($pass);  
    $check  = mysqli_query($con,"Select * from student where email='$email' and password='$pass'");  
    $data   = mysqli_fetch_array($check);  
    $result = mysqli_num_rows($check);

    if ($result == 1) {  
      $_SESSION['email'] = $data['email'];

      $verified  = mysqli_query($con,"Select * from student where `id`='".$data['id']."'");  
      $verifieduser   = mysqli_fetch_array($verified); 

      if ($data['mobile'] !='') {
        $this->sendSMS($data['id'], $data['mobile']);
        header('location:verifymobile.php');
      }
      return false;  
    } else {  
      return false;  
    }  
  }  

  public function fullname($id) { 
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }  
    $result = mysqli_query($con,"Select * from student where id='$id'");  
    $row = mysqli_fetch_array($result);  
    return $row['name'];  
  }  

  public function session() { 
    if (isset($_SESSION['login'])) {  
      return $_SESSION['login'];  
    }  
  }  

  public function logout() {  
      $_SESSION['login'] = false;  
      session_destroy();  
    } 

  public function getProfile($id) {  
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $result = mysqli_query($con,"Select * from student where id='$id'");
    $row = mysqli_fetch_array($result);  
    return $row; 
  } 

  public function updateProfileImage($id,$profImg) {      
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } 
    $result = mysqli_query($con,"UPDATE `student` SET `profile_img`= '$profImg' where id='$id'");
    $row = mysqli_fetch_array($result);  
    return true;
  }

  public function updateProfile($id,$data) {   
  $con = mysqli_connect(HOST, USER, PASS) or die('Connection Error! '.mysqli_error());  
    $result = mysqli_query($con,"UPDATE `student` SET `name`='".$data['name']."',`email`='".$data['email']."', `mobile`='".$data['mobile']."' where id='$id'");  
    return true;
  }

  public function sendSMS($userId, $mobile) {
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    } 

    $otp=substr(str_shuffle("0123456789ACBDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);

    $result = mysqli_query($con,"UPDATE `student` SET `otp`= '$otp' where id='$userId'");
    
    $message = "Your verification code is: $otp";
    $url="www.way2sms.com/api/v1/sendCampaign";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=8N42SDQ325LP1NC2JE3KKE7TGYWOUF49&secret=F7SG2LTG8H9H4O35&usetype=stage&phone=$mobile&senderid=&message=$message");
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl); 

    // echo $result;
    //api 8N42SDQ325LP1NC2JE3KKE7TGYWOUF49
    //key F7SG2LTG8H9H4O35
    return true;
  }

  public function verifyOTP($otp,$email){
    
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if($email == ''){
      header('location:login.php');
    }

    //$verify  = mysqli_query($con,"Select * from student where `otp`='".$otp."' and `email`='".$email."'");
    $verify  = mysqli_query($con,"Select * from student where `email`='".$email."'");
    $result = mysqli_num_rows($verify); 
    $data   = mysqli_fetch_array($verify);
    if ($result != 0) { 
      $_SESSION['login'] = true;  
      $_SESSION['id'] = $data['id']; 
      $_SESSION['name'] = $data['name'];
      return true; 
    }
  }

  public function getAllTests(){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $rows = array();
    $result = mysqli_query($con,"SELECT * FROM quiz ORDER BY date DESC") or die('Error');
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows; 
  }
  public function getQuiz($eid, $sn){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $rows = array();
    $result =mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn' " );
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows; 
  }

  public function getOptions($qid){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $rows = array();
    $result =mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows; 
  }


  public function getHistory($eid, $email){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $rows = array();
    $result = mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND email='$email' " )or die('Error157');
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows;
  }

  public function getRank($email){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $rows = array();
    $result = mysqli_query($con,"SELECT * FROM rank WHERE  email='$email' " )or die('Error157');
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows;
  }

  public function getHistoryByEmail($email){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $rows = array();
    $result = mysqli_query($con,"SELECT * FROM history WHERE email='$email' ORDER BY date DESC " )or die('Error197');
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows;
  }

  public function getQuizTitle($eid){
    $con=mysqli_connect(HOST,USER,PASS,DB);
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    $rows = array();
    $result = mysqli_query($con,"SELECT title FROM quiz WHERE  eid='$eid' " )or die('Error208');
    while($row = mysqli_fetch_array($result)) $rows[] = $row;
    return $rows;
  }

   public function adminlogin($email, $pass) {  
      $con=mysqli_connect(HOST,USER,PASS,DB);
      if (mysqli_connect_errno())
      {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
      } 
      $_SESSION['email'] = '';
      $_SESSION['admin'] = ''; 

      $check  = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$pass'") or die('Error');  
      $data   = mysqli_fetch_array($check);  
      $result = mysqli_num_rows($check);

      if ($result == 1) {  
        $_SESSION['admin'] = 'admin'; 
        $_SESSION["name"] = 'Admin';
        $_SESSION["key"] ='admin7785068889';
        $_SESSION["email"] = $email;
        return true;
      } else {  
        return false;  
      }  
    }
}  

?>  