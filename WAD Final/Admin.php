<!DOCTYPE html>
<html>
<title>Administration Page</title>
<body>
<h1>Admin Page of CabsOnline</h1>
<h3>1. Click below button to search for all unassigned booking request with a pick-up time within 2 hours.<h3>
<form method="post" action="">
<input type="submit" name="ListAll" value="ListAll">
<!-- This reference was taken from https://tinyurl.com/ycgbafye -->
<!-- This is for the clean up process in the case the user accidently clicks register button twice or refreshes the webpage-->
<script>
    if(typeof window.history.pushState == 'function') {
        window.history.pushState({}, "Hide", "https://mercury.swin.edu.au/cos30020/s100579461/Assignment1/admin.php");
    }
</script>
<?php
  $conn = mysqli_connect('feenix-mariadb.swin.edu.au', 's100579461', '010296', 's100579461_db')
  or die('Failed to connect');
  // sql string that will call the table
  $sqlResult = mysqli_query($conn, "SELECT * FROM PassengerBookings;") or die("This execution task has failed");
  // sql query statement


  if(isset($_POST['ListAll']))
  {
    // this will print the the table on the admin page
    echo "<table width='100%' border='1'>";
    // This sets the length of the table and allows it to display
    echo "<tr><th>Reference#</th><th>Customer Name</th><th>Passenger Name</th><th>MessengerContactPhone</th><th>Pick-up address</th>
          <th>Destination Suburb</th><th>Pickup Time</th></tr>";
          //the headers titles of each column

        while($row = mysqli_fetch_array($sqlResult))
        {
          echo "<tr><td>{$row['Reference']}</td>";
          echo "<td>{$row['CustomerName']}</td>";
          echo "<td>{$row['PassengerName']}</td>";
          echo "<td>{$row['MessengerContactPhone']}</td>";
          echo "<td>{$row['PickUpAddress']}</td>";
          echo "<td>{$row['DestinationSuburb']}</td>";
          echo "<td>{$row['PickUpTime']}</td></tr>";
          // displays the table of people requesting a taxi
        }
          echo "</table>"; // closing the table
  }
  if(isset($_POST['update']) && isset($_POST["RefSearch"]))
  {
    $RefSearch = $_POST["RefSearch"];
    $sqlUpdate = mysqli_query($conn, "UPDATE PassengerBookings SET Status = 'Assigned' WHERE Reference = '$RefSearch'; ");
    if($sqlUpdate)
    {
      echo "The booking request ".$RefSearch." has been properly assigned"; // notifiation that the table has been assigned
    }
  }

?>
    <h4>Input a reference Number below and click "update" button to assign a taxi to that request</h4></br>
    Reference number: <input type="text" name="RefSearch"><input type="submit" name="update" value="update">

</form>

</body>
</html>
