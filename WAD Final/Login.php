<!DOCTYPE html>
<html>
<title>Login</title>
<body>
  <h1>Login to CabsOnline </h1>
  <form method="get">
    <label>Email: </br><input type="text" name="Emailfield"></label></br>
    <label>Password: </br><input type="text" name="Pwdfield"></label></br>
    <input type="submit" value="Log In"></br>
    <p>New Member?</p><p><a href="https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Register.php">Register</a></p> <!-- redirect-->
</form>
</body>
<!-- This reference was taken from https://tinyurl.com/ycgbafye -->
<!-- This is for the clean up process in the case the user accidently clicks register button twice or refreshes the webpage-->
<script>
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Login.php");
    }
</script>
<?php
session_start();
// user password db
$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 'user', 'password', 'db')
or die('Failed to connect');
if((isset($_GET["Emailfield"]) && !empty($_GET["Emailfield"])&&(isset($_GET["Pwdfield"]) && !empty($_GET["Pwdfield"]))))
   {
     $Email = $_GET['Emailfield'];
     $Pwd = $_GET['Pwdfield'];

     // look up statments where email and password match an entry in the database
     $LoginLookup = mysqli_query($conn, "SELECT * FROM LoginDetails WHERE Email = '$Email' AND Password = '$Pwd';");
     $PassengerName = mysqli_query($conn, "SELECT Name FROM LoginDetails WHERE Email = '$Email' AND Password = '$Pwd';");
     $Result = mysqli_fetch_object($PassengerName);
     if(mysqli_num_rows($LoginLookup) === 1)
      {// if we get one row that matches that it will assign the session variabals

       $_SESSION['Email'] = $Email;
       $_SESSION['Name'] = $Result->Name;
       sleep(3);
       header("Location: https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Booking.php") or exit();
      }
      else
      {
       echo "*** Combination of email and password is incorrect ***";
      }
   }
?>










</html>
