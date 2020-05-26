<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Hernando County's latest COVID stats</title>
</head>
<body>

<?php

require "../../config.php";  // You may have to change this according to your dir structure

try {
  $connection = new PDO($dsn, $username, $password, $options);
}
  catch(PDOException $error) {
    echo "Cannot connect to database. Fix that." . "<br>" . $error->getMessage();
    logfile($error->getMessage());
  }

$sql = $connection->query("SELECT * FROM covid.hernando")->fetchAll();

foreach ($sql as $row) {
    //echo $row['confirmed']."<br>";
    //echo $row['deaths']."<br>";
    
}

?>

</body>
</html>    
