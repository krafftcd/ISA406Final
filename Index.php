<?php
 
session_start();

   
?>


<HTML>
<HEAD>
<TITLE>
ISA 406 - NFC Chip Readers Project Interface
</TITLE>
</HEAD>
<link rel="stylesheet" type="text/css" href="IndexCSS.css">

<BODY>
   <div id="MainPicture">
       <img src="http://i67.tinypic.com/2edza7s.png" alt="Colored Grid for grading" style="width:256px;height:98px;"></div>
<center>
<h2>FSB IT Device Checkout System - Database Login</h2></br>

<form>
    Username: <input type="text" name="username" autofocus><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" value="Submit">
</form><br>
<?php
    
     $Username=$_GET['username'];
    $Username=strtolower($Username);
    $Password=$_GET['password'];


    $ldapserver = "directory.miamioh.edu";
    $ldapport = "636";
    $context = "ou=People,dc=muohio,dc=edu";
    
    $ds=ldap_connect($ldapserver);

    $r=@ldap_bind($ds);
    if ($r == 0) 
    {
       print "<h3> We are having technical problems. Couldn't connect to LDAP SERVER </h3>"; 
     }
     else 
     {
       $st_search="uid=$Username";
       $sr=ldap_search($ds,$context, "$st_search");
       $info = ldap_get_entries($ds, $sr);
   
       if ($info["count"] == 0) {
           //print "User not found";
       }
       else 
       {
            //print "User FOUND<br>";
            for ($i=0; $i<$info["count"]; $i++) {
            $dn=$info[$i]["dn"];
              }
            If ($Password != "") {
                $r = @ldap_bind($ds, $dn, $Password);
               }
            else {
               $r = 0;
                }  
            
            // verify binding
             if ($r) 
             {
                $_SESSION['loggedin'] = "true";
                $_SESSION['username'] = $Username;
                header('Location: nfc.php');
                 exit;
              }
              else
              {
                print("<h3>Password was not valid!</h3>");
        		    print("<h3>Please try again!</h3>");
                echo "Please contact FSB IT help with the above error message.<br> Or try <a href='index.php' >logging in</a>  again.<br><a href='mailto:&#102;&#115;&#098;&#105;&#116;&#104;&#101;&#108;&#112;&#064;&#109;&#105;&#097;&#109;&#105;&#111;&#104;&#046;&#101;&#100;&#117;'>&#102;&#115;&#098;&#105;&#116;&#104;&#101;&#108;&#112;&#064;&#109;&#105;&#097;&#109;&#105;&#111;&#104;&#046;&#101;&#100;&#117;</a>";
              }
        }
    }
    
    ?>
    </BODY>
    
</HTML>