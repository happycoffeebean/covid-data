<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "username";
$password   = "password";
$dbname     = "hs";
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
?>
