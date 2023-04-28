
<?php 
    require "config.php";
    if(!isset($_SESSION['login_id'])){
        header('Location: login.php');
        exit;
    }
    $id = $_SESSION['login_id'];
    $get_google_user = mysqli_query($db_connection, "SELECT * FROM `google_users` WHERE `google_id`='$id'");
    if(mysqli_num_rows($get_google_user) > 0){
        $user = mysqli_fetch_assoc($get_google_user);
    }
    else{
        header('Location: logout.php');
        exit;
    }
    
    $email = $user['email'];
    $restaurants = mysqli_query($db_connection, "SELECT * FROM `restaurant`;");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add a Question</title>
</head>
<style>
tr {
    border-bottom: 2px solid #ddd;
}
th {
  color: white;
}
tr:nth-child(even) {
  background-color: #e6e6e6;
}
tr:hover {background-color: #D6EEEE;}
table {
  border: 1px solid black;
  padding: 1px;
}
</style>
<body style="background-color:#f7f7ff;">
    <br>
    <div class="container">
    <form action="home.php">
        <center><button action="submit" class="btn btn-info" style="background-color:#E53E3E">Return to Home</button></center>
    </form>
    </div>
<div class="container">
<h1 class="display-4"> Select a Restaurant</h1>
<form name="restaurantSearch" action="restaurantQuestion.php" method="post">
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
         <td><a href = "restaurantQuestion.php?name=<?php echo $row['name']; ?>"  ><?php echo $row['name']; ?></td>
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
