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

// curl_setopt($ch, CURLOPT_URL, 'https://coronavirus-tracker-api.herokuapp.com/v2/locations/665?source=nyt&timelines=false');
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_URL, 'https://services1.arcgis.com/CY1LXxl9zlJeBuRZ/arcgis/rest/services/Florida_COVID19_Cases/FeatureServer/0/query?where=COUNTYNAME%20%3D%20%27HERNANDO%27&outFields=COUNTY,COUNTYNAME,T_positive,Deaths&returnGeometry=false&outSR=4326&f=json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');



$headers = array();
$headers[] = 'Accept: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$json = json_decode($result, true);
$table = "hernando";

// echo "<pre>";
// print_r($json);
// echo "</pre>";

//exit;

$confirmed = $json['features'][0]['attributes']['T_positive'];
$deaths = $json['features'][0]['attributes']['Deaths'];

if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    //  This is simplified
    
$sql = sprintf(
  "INSERT INTO %s (%s) values (%d, %d)", 
  $table, "confirmed , deaths", $confirmed, $deaths
  );

  echo $sql; exit; 
try { 
  $statement = $connection->prepare($sql);
  $statement->execute();
}
 
   catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
    logfile($error->getMessage());
  } 

}
curl_close($ch);
?>
