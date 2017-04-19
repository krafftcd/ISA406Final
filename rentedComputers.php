<?php
session_start();

require('dbconnection.php');

$body = "";

?>


<!doctype html>
<HTML>
<HEAD>
    <TITLE>
        ISA 406 - NFC Chip Readers Project Interface
    </TITLE>
    
    <link rel="stylesheet" type="text/css" href="IndexCSS.css">
</HEAD>


<BODY>
    
    <script>
        
    </script>
    
    
    <div id="MainPicture">
        <img src="http://i67.tinypic.com/2edza7s.png" alt="Colored Grid for grading" style="width:256px;height:98px;">
        
        <!-- Header to show user what page they are on - Charlie K -->
        <h1 id="Header">Rented Computers</h1>
    </div>
    
    
    <!-- Navigation bar for changing webpages - Charlie K -->
    <div id="NavBar">
        <ul>
            <li><a href="nfc.php">Check Out</a></li>
            <li><a href="return.php">Return</a></li>
            <li><a href="avaiableComputers.php">Available Computers</a></li>
            <li><a href="rentedComputers.php"  class="active">Computers Rented Out</a></li>
            <li><a href="addComputers.php">Add New Computer</a></li>
            <li><a href="checkoutLog.php">Checkout Log</a></li>
            <li><a href="computerSerial.php">Computer Serial Number Lookup</a></li>
        </ul>
    </div>
    
    
    <!-- Main section to show avaiable computers - Charlie K -->
    <div id="Main">
    <br>   
    <br>
        
        <?php
        
        //Count number of computers with no renter
        $selectCount = "Select COUNT(*) from NFCComputerLog where StudentID IS NOT NULL;";

        $getselectCount = odbc_exec($conn,$selectCount);
								    
				while (odbc_fetch_row($getselectCount))
				{
					echo "Number of Rented out Computers: " .odbc_result($getselectCount, 1)."<Br>";
					
				}

        odbc_close($conn);
        
        ?>
        <br>
        
        <!-- Check if Session from Login has been created -->
        <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") { 
        
        ?>
        
        <?php
        
        $studentEntryInfo = "Select c.NFCID, c.StudentID, a.ComputerSerialNum, b.DeviceType, b.DeviceModel, b.GHZ, b.RAM_GB, c.RentedOut
From NFCComputers a
Join hardware b on a.ComputerSerialNum=b.SerialServiceTag
Join NFCComputerLog c on a.NFCID=c.NFCID
WHERE STUDENTID IS NOT NULL;";

        $getstudentEntryInfo = odbc_exec($conn,$studentEntryInfo);
            echo "<table border='1'>";	
            echo "<tr><th>NFCID</th><th>Renter ID</th><th>Computer Serial Number</th><th>Device Type</th><th>Device Model</th><th>Device GHZ</th><th>Device Ram</th><th>Rented Date</th></tr>";
				while (odbc_fetch_row($getstudentEntryInfo))
				{
                    
					echo "<tr><td>" .odbc_result($getstudentEntryInfo, 1)."</td><td>" .odbc_result($getstudentEntryInfo, 2)."</td><td>".odbc_result($getstudentEntryInfo, 3)."</td><td>".odbc_result($getstudentEntryInfo, 4)."</td><td>".odbc_result($getstudentEntryInfo, 5)."</td><td>".odbc_result($getstudentEntryInfo, 6)."</td><td>".odbc_result($getstudentEntryInfo, 7)."</td><td>".odbc_result($getstudentEntryInfo, 8)."</td></tr>";
                    
					
				}
        echo "</table>";
        odbc_close($conn);
        
        
        
        
        
        
        ?>
        
        
        <!-- If no login session, redirect to login page -->
        <?php
        }
        else {
            echo "Not Logged in";
        ?>
        <br><a href="Index.php">Login Here</a>
        <?php
        }
        ?>
        
    </div>

    
    </BODY>
</HTML>
