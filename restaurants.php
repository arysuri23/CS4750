<?php 
    require("config.php");

    function getRestaurants()
    {
      global $db_connection;
      $query = "select * from restaurants";
      $statement = $db_connection->prepare($query);
      $statement->execute();
      $result = $statement->fetchAll();
      $statement->closeCursor();
      return $result;
    }

    $restaurants = getRestaurants();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>F</title>
</head>

<body>
    <h1>Restaurants</h1>
</body>

</html>