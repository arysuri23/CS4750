<?php
session_start();
session_regenerate_id(true);
// change the information according to your database
/** S23, PHP (on GCP, local XAMPP, or CS server) connect to MySQL (on local XAMPP) **/
$username = 'nkoix';
$password = 'Cesttresf1n@le';
$host = 'localhost:3307';           // default phpMyAdmin port = 3306
$dbname = 'restaurant_review';
$dsn = "mysql:host=$host;dbname=$dbname";  
////////////////////////////////////////////

try
{
    $db_connection = new PDO($dsn, $username, $password);
    echo "Success";
}
catch (PDOException $e)     // handle a PDO exception (errors thrown by the PDO library)
{
   // Call a method from any object, use the object's name followed by -> and then method's name
   // All exception objects provide a getMessage() method that returns the error message 
   $error_message = $e->getMessage();        
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
}
catch (Exception $e)       // handle any type of exception
{
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}


?>