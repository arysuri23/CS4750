<?php 
    require "config.php";
    $id = $_SESSION['login_id'];
    $get_google_user = mysqli_query($db_connection, "SELECT * FROM `google_users` WHERE `google_id`='$id'");
    if(mysqli_num_rows($get_google_user) > 0){
        $user = mysqli_fetch_assoc($get_google_user);
    }  
    $email = $user['email'];
    $restaurants_owned = mysqli_query($db_connection, "SELECT * FROM `adds` WHERE `email`='$email'");
    $restaurant = mysqli_fetch_assoc($restaurants_owned);
    $restaurant_id = intval($restaurant['restaurant_id']);
    $questions_asked = mysqli_query($db_connection, "SELECT * FROM `question` WHERE `restaurant_id`='$restaurant_id'");
    $questions = mysqli_fetch_assoc($questions_asked);
    
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Answer</title>
</head>

<body style="background-color:#f7f7ff;">
    <br>
    <div class="container">
    <h1 class="display-4"> Answer Questions </h1>
    <ul>
        <?php foreach ($questions_asked as $q): ?>
        <div>
            <li>
            <h4> <?php echo $q['question_text']; ?>  </h4>
            <form name="answerForm" action="home.php" method="post">
            </div> 
            Answer:
            <input type="text" class="form-control" name="answer" id = "answer" />
            <input type="hidden" class="form-control" name="question_id" id = "question_id" value = "<?php echo $q['question_id']?>" />
            </div> 
            <input type="submit" name="actionBtn" value="Add Answer"  />
            </form>
            </li>
        </div>
        <hr>
        <?php endforeach; ?>
    </ul>
</div>
</body>

</html>
