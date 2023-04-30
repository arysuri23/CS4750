
<?php 
    require "config.php";
    if(!isset($_SESSION['login_id'])){
        header('Location: login.php');
        exit;
    }
    $id = $_SESSION['login_id'];
    $query = "SELECT * FROM `google_users` WHERE `google_id`=?";
    $get_user_statement = $db_connection->prepare($query);
    $get_user_statement->bind_param("i", $id);
    $get_user_statement->execute();
    $get_user_result = $get_user_statement->get_result();
    //$get_google_user = mysqli_query($db_connection, "SELECT * FROM `google_users` WHERE `google_id`='$id'");
    if(mysqli_num_rows($get_user_result) > 0){
        //$user = mysqli_fetch_assoc($get_google_user);
        $user = $get_user_result->fetch_assoc();
    }
    else{
        header('Location: logout.php');
        exit;
    }
    
    $email = $user['email'];
    //$restaurants = mysqli_query($db_connection, "SELECT * FROM `restaurant`;");
    $q = "SELECT * FROM `restaurant`";
    $stmt = $db_connection->prepare($q);
    $stmt->execute();
    $restaurants = $stmt->get_result();

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

<body style="background-color:#f7f7ff;">
    <br>
    <div class="container">
    <form action="home.php">
        <center><button action="submit" class="btn btn-info" style="background-color:#E53E3E">Return to Home</button></center>
    </form>
    </div>
    <div class="container">
    <h1> Click or search the restraunt you want to review! </h1>
    <form name="restaurantSearch" action="makeReview.php" method="post">
    <div class="input-group rounded">
    <input id = "name" name = "name" type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
    <span class="input-group-text border-0" id="search-addon">
    <i class="fas fa-search"></i>
    </span>
    </div>
    </form>
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
         <td><a href = "makeReview.php?name=<?php echo $row['name']; ?>"  > <?php echo $row['name']; ?></td>
         <td><?php echo $row['address']; ?></td>
         <td><?php echo $row['open']; ?></td>        
         <td><?php echo $row['close']; ?></td>  
      </tr>
    <?php endforeach; ?>
    </table>
    </div>
</div>
</body>

</html>
