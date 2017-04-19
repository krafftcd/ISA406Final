<?php
session_start();

require('dbconnection.php');

$body = "";

$date = date("Y-m-d H:i:s");

$returnComputer = $_GET['returnComputerId'];
$returnStudent = $_GET['returnStudentId'];

$selectCount = "Update NFCComputerLog set StudentID = NULL where NFCID ='". $returnComputer."'";

$checkoutLog = "INSERT INTO NFCRentedLog VALUES (id_count.nextval, '". $returnComputer."','". $returnStudent."','". $date."')";

//echo $checkoutLog;
//exit;
odbc_exec($conn,$selectCount);
odbc_exec($conn,$checkoutLog);


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
        <h1 id="Header">Computer Return</h1>
    </div>
    
    
    <!-- Navigation bar for changing webpages - Charlie K -->
    <div id="NavBar">
        <ul>
            <li><a href="nfc.php">Check Out</a></li>
            <li><a href="return.php" class="active">Return</a></li>
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
                    <td align="left"><input type="text" name="returnComputerId" autofocus></td>
                </tr>
                <tr>
                    <td align="right">Scan Student ID:</td>
                    <td align="left"><input type="text" name="returnStudentId"></td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td align="right"><input type="submit" value="Submit"></td>
                </tr>
            </table>

        </form>
        <br>
        <br>
        
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
    <br>
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

        odbc_close($conn);
        
        ?>
    
    </div>
    
    
    
    </BODY>
</HTML>
