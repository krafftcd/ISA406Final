<?php
session_start();

require('dbconnection.php');

$body = "";

$test = $_GET['scanNFCID'];


$query = "Select * from NFCComputers where NFCID = '". $test."'";

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
        <h1 id="Header">Computer Serial Number Lookup</h1>
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
    <br><br>
        
        <!-- Check if Session from Login has been created -->
    <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == "true") { 
        
    ?>
    <br>   
    <br>
        
        <form>
            <table>
                <tr>
                    <td align="right">Scan NFC ID: </td>
                    <td align="left"><input type="text" name="scanNFCID"</td>
                </tr>
                <tr>
                    <td align="right"></td>
                    <td align="right"><input type="submit" value="Submit"></td>
                </tr>
            </table>
        </form>
        
        <br>
        
        <?php
        
        $studentEntryInfo = $query;
        
        $getstudentEntryInfo = odbc_exec($conn,$studentEntryInfo);
        
        echo "NFC ID: ". odbc_result($getstudentEntryInfo, 1). "<br>";
        echo "Serial Number: ". odbc_result($getstudentEntryInfo, 2);

        odbc_close($conn);
        
        
        
        
        
        
        ?>
        
        
        
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
