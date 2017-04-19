<?php
session_start();
require('dbconnection.php');

if (!$conn) {
    echo "Connection Failed";
}



$body = "";

$scanComputer = $_GET['scanComputerId'];

$selectCount = "Delete From NFCComputerLog Where NFCID = '".$scanComputer ."';";

$secondQuery = "Delete From NFCComputers Where NFCID = '".$scanComputer ."';";
//echo $selectCount;
//exit;
odbc_exec($conn,$selectCount);
odbc_exec($conn,$secondQuery);

if (odbc_error())
        {
             echo odbc_errormsg($conn);
         }

odbc_close($conn);
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
        <h1 id="Header">Delete Computer</h1>
    </div>
    
    
    <!-- Navigation bar for changing webpages - Charlie K -->
    <div id="NavBar">
        <ul>
            <li><a href="nfc.php">Check Out</a></li>
            <li><a href="return.php">Return</a></li>
            <li><a href="avaiableComputers.php">Available Computers</a></li>
            <li><a href="rentedComputers.php">Computers Rented Out</a></li>
            <li><a href="addComputers.php" class="active">Add New Computer</a></li>
            <li><a href="checkoutLog.php">Checkout Log</a></li>
            <li><a href="computerSerial.php">Computer Serial Number Lookup</a></li>
            <li><a href="computerSerial.php">Delete Computer</a></li>
        </ul>
    </div>
    
    
    <!-- Main section for input and submitting - Charlie K -->
    <div id="Main">
        <br><br>
        
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
                    <td align="right"></td>
                    <td align="right"><input type="submit" value="Submit"></td>
                </tr>
            </table>

        </form>
        <br>
        <br>
    </div>
    
    <div id="Information">

    </div>

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
    </BODY>
</HTML>
