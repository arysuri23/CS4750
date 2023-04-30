<?php 
require ('config.php');
$exists = TRUE;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $name_value = $_POST['name'];
  $restaurant_row = mysqli_query($db_connection, "SELECT * FROM `restaurant` WHERE `name`='$name_value'");
  if(mysqli_num_rows($restaurant_row) == 0){
    $exists = FALSE;
  }
}
else {
  $name_value = $_GET['name'];
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Question</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
input, textarea {
  background-color: #f7f7ff;
}
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
    <form action="questionList.php">
        <center><button action="submit" class="btn btn-info" style="background-color:#E53E3E">Select a Different Restaurant</button></center>
    </form>
    </div>
  <div class="container">
  <?php if(!$exists): ?>
    <h1>This restaurant does not exist, please try again</h1>
    <a href = "restrauntReviewList.php"> back
  <?php else: ?>
  <h1 class="display-4">Ask a Question!</h1>
    <div class="row mb-3 mx-3">
    Restaurant Name:
    <form name="questionForm" action="home.php" method="post">
     <input id="name" name = "name"  value= "<?php echo $name_value; ?>" readonly="readonly"/>
    </div> 
    <h6>Question:</h6>
  
    <input type="text" class="form-control" name="question" id = "question" /><br>
    <center><button value = "Add Question" type="submit" name="actionBtn" class="btn btn-info" style="background-color:#E53E3E">Post Question</button></center>
    </div> 

    
</form>
<?php endif ?>  
<hr/>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
