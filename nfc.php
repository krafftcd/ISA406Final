<?php

session_start();

require('dbconnection.php');

$body = "";

$date = date("Y-m-d H:i:s");

$scanComputer = $_GET['scanComputerId'];
$scanStudent = $_GET['scanStudentId'];

$selectCount = "Update NFCComputerLog set StudentID ='". $scanStudent."' where NFCID ='". $scanComputer."'";

$secondQuery = "Update NFCComputerLog set RentedOut ='". $date."' where NFCID ='". $scanComputer."'";
//echo $secondQuery;
//exit;

odbc_exec($conn,$selectCount);
odbc_exec($conn,$secondQuery);

if (odbc_error())
        {
             echo odbc_errormsg($conn);
         }


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
        <h1 id="Header">Check Out</h1>
    </div>
    
    
    <!-- Navigation bar for changing webpages - Charlie K -->
    <div id="NavBar">
        <ul>
            <li><a href="nfc.php" class="active">Check Out</a></li>
            <li><a href="return.php">Return</a></li>
            <li><a href="avaiableComputers.php">Available Computers</a></li>
            <li><a href="rentedComputers.php">Computers Rented Out</a></li>
            <li><a href="addComputers.php">Add New Computer</a></li>
            <li><a href="checkoutLog.php">Checkout Log</a></li>
            <li><a href="computerSerial.php">Computer Serial Number Lookup</a></li>
        </ul>
    </div>
    
    
    <!-- Main section for input and submitting - Charlie K -->
    <div id="Main">
        <h2>FSB IT Device Checkout System</h2><br />

        <!-- Check if Session from Login has been created -->
        <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") { 
        
       ?>
        
        <form>
            <table>
                <tr>
                    <td align="right">Scan Computer NFC Chip:</td>
                    <td align="left"><input type="text" name="scanComputerId" autofocus></td>
                </tr>
                <tr>
                    <td align="right">Scan Student ID:</td>
                    <td align="left"><input type="text" name="scanStudentId"></td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td align="right"><input type="submit" value="Submit"></td>
                </tr>
            </table>

        </form>
        
        <!-- Will End Session and Logout-->
        <a href="sessionEnd.php">Logout</a>
        
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
        
        <br>
        <br>
    </div>
    
    <div id="Information">
        <?php
        
        //Count number of computers with no renter
        $selectCount = "Select COUNT(*) from NFCComputerLog where StudentID IS NULL;";

        $getselectCount = odbc_exec($conn,$selectCount);
								    
				while (odbc_fetch_row($getselectCount))
				{
					echo "Number of Computers Available: " .odbc_result($getselectCount, 1)."<Br>";
					
				}

        odbc_close($conn);
        
        ?>
        
        
        <?php
        
            //Count number of computers with no renter
            $selectCount = "Select COUNT(*) from NFCComputerLog where StudentID IS NOT NULL;";

            $getselectCount = odbc_exec($conn,$selectCount);
								    
				while (odbc_fetch_row($getselectCount))
				{
					echo "Number of Rented out Computers: " .odbc_result($getselectCount, 1)."<Br>";
					
				}
        if (odbc_error())
            {
              echo odbc_errormsg($conn);
            }
        
        
        odbc_close($conn);
        
        ?>

    </div>
    
    
    
    </BODY>
</HTML>
