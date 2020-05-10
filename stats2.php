<!doctype html>
<html lang="en">
<?php $debug = FALSE; ?>

<head>
    <title>Hernando County's latest COVID stats</title>
    <link rel="stylesheet" type="text/css" href="">
    
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="hernando, hernando sun, newspaper, COVID">
    <meta name="author" content="happycoffeebean, t137">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
</head>

  <body>
    <h1>Hernando County Daily COVID stats</h1>
    
    <?php
    //exec('wget -O https://raw.githubusercontent.com/nytimes/covid-19-data/master/us-counties.csv',$dump ,$err_code);
    
    exec('git clone https://github.com/nytimes/covid-19-data.git', $dump, $err_code);

    if ($debug == TRUE) {
        if($err_code == '0') {
            echo "Well done";
        }  else {
            echo "You screwed something up. Errorcode: $err_code";
        }
    }

    $delim = ',';
    $fp = fopen('covid-19-data/us-counties.csv', 'r');
    
    echo "Date    |  Cases   |  Deaths" ."<br><br>";  
    while(($row = fgetcsv($fp, 1024, $delim)) !== false) {
        if ($row[1] == 'Hernando'){
            //print_r($row);
            // date,county,state,fips,cases,deaths
            
            echo "$row[0] |  $row[4] |  $row[5]" . "<br>";
        } 
        
    }
    ?>
</body>
</html>