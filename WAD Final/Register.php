<!DOCTYPE html>
<html>
<body>
<title>Register</title>
<h1>Register to CabsOnline</h1>
Please fill the fields below to complete your registration</br>
  <form method="get">
      <label>Name: </br><input type="text" name="namefield"></label></br>
      <label>Password: </br> <input type="text" name="Passwordfield"></label></br>
      <label>Comfirm Password: </br><input type="text" name="PasswordComfirmfield"></label></br>
      <label>Email: </br> <input type="text" name="emailfield"></label></br>
      <label>Phone: </br> <input type="text" name="phonefield"></label></br>
      <input type="submit" value="Register"></br>
      <p>Already a Member?</p><p><a href="https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Login.php">Login Here</a></p> <!--TODO Add link address here -->
  </form>
</body>
<!-- This reference was taken from https://tinyurl.com/ycgbafye -->
<!-- This is for the clean up process in the case the user accidently clicks register button twice or refreshes the webpage-->
<script>
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Register.php");
    }
</script>
<?php
session_start();
ini_set('error_reporting',0);
ini_set('display_errors',0);

$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 'user', 'password', 'db')
or die('Failed to connect');

if((isset($_GET["namefield"]) && !empty($_GET["namefield"]))
  && (isset($_GET["Passwordfield"]) && !empty($_GET["Passwordfield"]))
  && (isset($_GET["PasswordComfirmfield"]) && !empty($_GET["PasswordComfirmfield"]))
  && (isset($_GET["emailfield"]) && !empty($_GET["emailfield"]))
  && (isset($_GET["phonefield"]) && !empty($_GET["phonefield"]))) // TODO add the is empty parts
    {
      $Name = $_GET['namefield'];
      $Password = $_GET['Passwordfield'];
      $ComPass = $_GET['PasswordComfirmfield'];
      $Email = $_GET['emailfield'];
      $Phone = $_GET['phonefield'];
      //assigning variables
      $tableString = mysqli_query($conn, "SELECT * FROM LoginDetails WHERE Email = '$Email';");
      if(mysqli_num_rows($tableString) === 1)
      { // if we get a match on one of the tables
        sleep(3);
        header("Location: https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Login.php") or exit();
      }
        if((($Password === $ComPass) && (!empty($Password))))
        {// sql statement query
          $sqlString = "INSERT INTO LoginDetails (Email, Password, Name, Phone) VALUES ('$Email', '$Password', '$Name', '$Phone'); ";
          $sqlQuerry = mysqli_query($conn, $sqlString) or die("This execution task has failed");
          echo "Your details have been saved";
          echo "Redirecting you to the Booking Page";
          sleep(4);
          $_SESSION['Name'] = $Name;
          $_SESSION['Email'] = $Email;
          header("Location: https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Booking.php") or exit();
        } // assinging the session variables to a local variables
        else
        {
          echo "***** Your passwords do not match *****";
        }
    }
    else
    {
      echo  $_SESSION["NoRecord"];
      echo"****** Please fill in all the fields ******"; // warning if all the fields are not filled out
    }

 ?>
</html>
