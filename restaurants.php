<?php 
    require("config.php");

    function getRestaurants()
    {
      global $db_connection;
      $query = "SELECT * FROM 'restaurant'";
      $result = mysqli_fetch_assoc($query);
      return $result;
    }
    try
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST')
        {
          if (!empty($_POST['actionBtn']))
          {
            if ($_POST['actionBtn'] == "GoTo")
            {
              echo "Go to restaurant";
            }
          }
        }
        $restaurants = getRestaurants();
    }
    catch (Exception $e)
    {
       $error_message = $e->getMessage();        
       echo "Error: $error_message";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>F</title>
</head>

<body>
    <div class="row justify-content-center">  
    <table class="w3-table w3-bordered w3-card-4 center" style="width:50%">
      <thead>
      <tr style="background-color:#B0B0B0">
        <th width="20%">Name        
        <th width="20%">Address        
        <th width="5%">Open 
          <th width="5%">Close
      </tr>
      </thead>
    <?php foreach ($restaurants as $row): ?>
      <tr>
         <td><?php echo $row['name']; ?></td>
         <td><?php echo $row['address']; ?></td>
         <td><?php echo $row['open']; ?></td>        
         <td><?php echo $row['close']; ?></td>  
      </tr>
    <?php endforeach; ?>
    </table>
    </div>
</body>

</html>