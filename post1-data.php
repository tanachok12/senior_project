<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css">
body,td,th {
	font-family: Verdana, Geneva, sans-serif;
	font-size: small;
}
</style>
</head>

<body>
    <h1>Hi  Hi </h1>
<?php
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";
        echo "<br/>";


$servername = "localhost";
$username = "dustdete_user";
$password = "Tanachok01!";
$dbname = "dustdete_test";
// date_default_timezone_set("Asia/Bangkok");
// $cknow=date("Y-m-d H:i:s");
echo "data in test...";
echo "<br/>";
        echo "Test value data ";
        echo "<br/>";   
        echo "<br/>";

               echo "<br/>";
        echo "<br/>";


$conn = mysqli_connect($servername, $username, $password, $dbname);
error_reporting( error_reporting() & ~E_NOTICE );

        echo "Add to SQL ";
        echo "<br/>";
       echo "Test value data value1 = ".$_GET["value1"];
       echo "<br/>";
              echo "Test value data value2 =".$_GET["value2"];
              echo "<br/>";
       echo "Test value data value13 = ".$_GET["value3"];
echo "<br/>";

        if ($_GET["value1"]!="") 
        
	{  
	    echo "if it do";
	    echo "<br/>";
echo "<br/>";
echo "<br/>";


		$sql = "INSERT INTO Sensor (value1, value2, value3)
      	VALUES ('".$_GET["value1"]."', '".$_GET["value2"]."','".$_GET["value3"]."'".")";

		if (mysqli_query($conn, $sql)) {
    	echo "New record created successfully";
		} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

   		
		
	}

// https://dustdetector.net/post1-data.php?value1=12&value2=13&value3=14
?>
</body>