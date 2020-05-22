<!doctype html>
<html lang="en">
<?php $debug = TRUE; ?>

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
   

    //  exec('curl https://coronavirus-tracker-api.herokuapp.com/v2/locations?source=csbs',$dump ,$err_code);
    //  exec('curl https://coronavirus-tracker-api.herokuapp.com/v2/locations/665?source=nyt&timelines=false',$dump,$err_code);
        
    exec('curl "https://coronavirus-tracker-api.herokuapp.com/v2/locations/665?source=nyt&timelines=false" -H "accept: application/json', $dump, $err_code);
    
    if ($debug == TRUE) {
            if($err_code == '0') {
                echo "Well done. No error in the call. <br><br>";
            }  else {
                echo "You screwed something up. Errorcode: $err_code <br>";
            }
        }

     // unneccessary: doesn't work anyway $stats = json_decode($dump,'TRUE','1024');

      foreach ($dump as $string) {
       // echo 'Decoding: ' . $string;
        $data = json_decode($string);
    
        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                echo ' - No errors';
            break;
            case JSON_ERROR_DEPTH:
                echo ' - Maximum stack depth exceeded';
            break;
            case JSON_ERROR_STATE_MISMATCH:
                echo ' - Underflow or the modes mismatch';
            break;
            case JSON_ERROR_CTRL_CHAR:
                echo ' - Unexpected control character found';
            break;
            case JSON_ERROR_SYNTAX:
                echo ' - Syntax error, malformed JSON';
            break;
            case JSON_ERROR_UTF8:
                echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
            default:
                echo ' - Unknown error';
            break;
        }
    
      print_r($data);


        //echo PHP_EOL;
    }

