<?php

 //db variables
 $host = "localhost";
 $dbname = "ESP8266watering";
 $user = "root";
 $password = "";


// Create connection
$con=mysqli_connect($host,$user,$password,$dbname);

// Check connection
if (!$con)
{
	echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
echo "Éxito: Se realizó una conexión apropiada a MySQL\n" . PHP_EOL;




// This SQL statement selects ALL from the table 'Locations'
$sql = "SELECT * FROM proyecto";
 
// Check if there are results
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 
	// Finally, encode the array to JSON and output the results
	echo json_encode($resultArray);
}
 
// Close connections
mysqli_close($con);
?>