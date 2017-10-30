<!DOCTYPE html>
<html>
<title>Booking</title>
<body>
  <form method="get">
  <h1>Booking a Cab</h1>
  Please fill the fields below to book a taxi </br></br>
    <label>Passenger Name: </br><input type="text" name="Pnfield"></label></br>
    <label>Contact Passenger Phone: </br><input type="text" name="Contactphonefield"></label></br>
    <p>Pick Up Address:</p>
        <label> Unit Number: </br><input type="text" name="UnitNumber"></label></br>
        <label> Street Number: </br><input type="text" name="StreetNumber"></label></br>
        <label> Street Name: </br><input type="text" name="StreetName"></label></br>
        <label> Suburb: </br><input type="text" name="Suburb"></label></br>
<!-- combine the strings os unit / street / -->
        <label>Destination Suburb: </br><input type="text" name="DesSuburb"></label></br>
        <label>Pick Up Date: </br><input type="text" name="PickupDatefield"></label></br>
        <label>Pick Up Time: </br><input type="text" name="PickupTimefield"></label></br>
        <input type="submit" value="Book">

</form>

<!-- This reference was taken from https://tinyurl.com/ycgbafye -->
<!-- This is for the clean up process in the case the user accidently clicks register button twice or refreshes the webpage-->
<script>
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/Booking.php");
    }
</script>
<?php
session_start(); // session start for our session variables
ini_set('error_reporting',0);
ini_set('display_errors',0);
$conn = mysqli_connect('feenix-mariadb.swin.edu.au', 's100579461', '010296', 's100579461_db')
or die('Failed to connect');
// connection string for my sql
if((isset($_GET["Pnfield"]) && !empty($_GET["Pnfield"]))
&&(isset($_GET["Contactphonefield"]) && !empty($_GET["Contactphonefield"]))
&&(isset($_GET["StreetName"]) && !empty($_GET["StreetName"]))
&&(isset($_GET["Suburb"]) && !empty($_GET["Suburb"]))
&&(isset($_GET["DesSuburb"]) && !empty($_GET["DesSuburb"]))
&&(isset($_GET["PickupDatefield"]) && !empty($_GET["PickupDatefield"]))
&&(isset($_GET["PickupTimefield"]) && !empty($_GET["PickupTimefield"])))
{ // currently checking to see if there are empty filleds
  $Passenger = $_GET["Pnfield"];
  $Contact = $_GET["Contactphonefield"];
  $StreetName = $_GET["StreetName"];
  $Suburb = $_GET["Suburb"];
  $DestinationSub = $_GET["DesSuburb"];
  $PDF = $_GET["PickupDatefield"];
  $PTF = $_GET["PickupTimefield"];
  $tName = $_SESSION['Name'];
  $Semail = $_SESSION['Email'];
  // assigning the get variables to normal variables

  $sqlString = "INSERT INTO PassengerBookings (Reference, Email, CustomerName, PassengerName, MessengerContactPhone,
                            PickUpAddress, DestinationSuburb, PickupDate, PickUpTime, Status)
                VALUES ('','$Semail', '$tName', '$Passenger', '$Contact', '$ACombine', '$DestinationSub', '$PDF', '$PTF', 'Unassigned'); ";
  $RefNumber = "SELECT Name FROM PassengerBookings WHERE PassengerName = '$Passenger' AND DestinationSuburb = '$DestinationSub' AND Email = '$Semail';";

  if((isset($_GET["UnitNumber"]) && !empty($_GET["UnitNumber"]) && empty($_GET["StreetNumber"])))
  { // if the stree number does not have a number in it but the unit does the variable is assigned tothe UnitNumber variable
    $UnitNumber = $_GET["UnitNumber"];
    $ACombine = $UnitNumber.' '.$StreetName.' , '.$Suburb; // concatination of the steet
    $sqlQuerry = mysqli_query($conn, $sqlString) or die("This execution task has failed");
    $BookingNumber = mysqli_query($conn, $RefNumber) or die("This execution task has failed");
    if($sqlQuerry)
    {
      echo "Thank You! Your booking reference number is: " .$BookingNumber ."We'll pick you up from: ". $ACombine." We Will pick up the passengers in front of your
      provided address at " .$PTF." on ".$PDF;
    }
  }
  if((isset($_GET["StreetNumber"]) && !empty($_GET["StreetNumber"]) && empty($_GET["UnitNumber"])))
  {
    $StreetNumber = $_GET["StreetNumber"];
    $ACombine = $StreetNumber.' '.$StreetName.' , '.$Suburb;
    $sqlQuerry = mysqli_query($conn, $sqlString) or die("This execution task has failed");

  }
 }
else
{
  echo "**** Please fill in all the blanks before you submit ****"; // warning if the inputs are not done

}



 ?>
 </body>
</html>
