<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Hernando County's latest COVID stats</title>
</head>
<body>

<?php
require "config.php"; 

// existing code to fetch numbers here

try {
  $connection = new PDO($dsn, $username, $password, $options);
}
  catch(PDOException $error) {
    echo "Cannot connect to database. Fix that." . "<br>" . $error->getMessage();
    logfile($error->getMessage());
  }
  

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://coronavirus-tracker-api.herokuapp.com/v2/locations/665?source=nyt&timelines=false');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


$headers = array();
$headers[] = 'Accept: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$json = json_decode($result, true);

$table = "hernando";

$confirmed = $json['confirmed'];  

echo $confirmed; exit;  

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
	//  This is simplified

$sql = sprintf(
  "INSERT INTO %s (%s) values (%s)", 
  $table, "confirmed", $confirmed
  );

try { 
  $statement = $connection->prepare($sql);
  $statement->execute($ret);
}
 
   catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
    logfile($error->getMessage());
  } 

}
curl_close($ch);
?>

</body>
</html>
