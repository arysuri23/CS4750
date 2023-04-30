<?php
require 'config.php';
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

if(mysqli_num_rows($get_user_result) > 0){
    $user = $get_user_result->fetch_assoc();
}
else{
    header('Location: logout.php');
    exit;
}

$email = $user['email'];

$revOrMan="";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Submit")){
        $displayName = $_POST['name'];
        $revOrMan = $_POST['revOrMan'];
        if ($revOrMan == "Restaurant Reviewer"){
            $insert = "INSERT INTO `reviewer`(`email`,`display_name`) VALUES(?, ?)";
        }
        elseif ($revOrMan == "Restaurant Manager"){
            $insert = "INSERT INTO `restaurant_manager`(`email`,`name`) VALUES(?, ?)";
        }
        $insert_statement = $db_connection->prepare($insert);
        $insert_statement->bind_param("ss", $email, $displayName);
        $insert_statement->execute();
    }
    elseif (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add Restaurant")){
        $restaurant_name = $_POST['name'];
        $image = $_POST['image'];
        $address = $_POST['address'];
        $cuisine = $_POST['cuisine'];
        $elevate = $_POST['elevate'];
        if($elevate == "Yes"){
            $elevate = 1;
        }
        else{
            $elevate = 0;
        }
        $open = $_POST['openTime'] . ":00";
        $close = $_POST['closeTime'] . ":00";
        $restaurants = mysqli_query($db_connection, "SELECT * FROM `restaurant`");
        $restaurant_id = mysqli_num_rows($restaurants) + 1;

    
        $insert = mysqli_query($db_connection, "INSERT INTO `restaurant`(`restaurant_id`, `image_url`, `address`, `on_elevate`, `open`, `close`, `name`) VALUES ('$restaurant_id', '$image', '$address', '$elevate','$open', '$close', '$restaurant_name')");
        $insertCusine = mysqli_query($db_connection, "INSERT INTO `restaurant_cuisine`(`restaurant_id`, `cuisine`) VALUES ('$restaurant_id','$cuisine')");
        $insert3 = mysqli_query($db_connection, "INSERT INTO `adds`(`email`, `restaurant_id`) VALUES ('$email','$restaurant_id')");
        
    }
    elseif (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add Review")){
        $restaurant_name = $_POST['name'];
        $overall_rating = intval($_POST['overall_rating']);
        $food_rating = intval($_POST['food_rating']);
        $service_rating = intval($_POST['service_rating']);
        $comment = $_POST['comment'];


        $rev_stmt = $db_connection->prepare("SELECT * FROM `review`");
        $rev_stmt->execute();
        $reviews = $rev_stmt->get_result();
        $review_id =  mysqli_num_rows($reviews) + 1;

        $row_stmt = $db_connection->prepare("SELECT * FROM `restaurant` WHERE `name`='$restaurant_name'");
        $row_stmt->execute();
        $restaurant_row = $row_stmt->get_result();
        $restaurant = $restaurant_row->fetch_assoc();
        $restaurant_id = intval($restaurant['restaurant_id']);
        
        $insert_rev = $db_connection->prepare("INSERT INTO `review`(`review_id`, `overall_rating`, `service_rating`, `food_rating`, `comment`, `restaurant_id`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_rev->bind_param("iiiisis", $review_id, $overall_rating, $service_rating, $food_rating, $comment, $restaurant_id, $email);
        $insert_rev->execute();
        if ($overall_rating > 3){
            $insertLikes = $db_connection->prepare("INSERT INTO `likes`(`reviewer_email`, `restaurant_id`) VALUES (?, ?)");
            $insertLikes->bind_param("si", $email, $restaurant_id);
            $insertLikes->execute();
        }     
       
    } 
    elseif (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add Question")){
        $restaurant_name = $_POST['name'];
        $question = $_POST['question'];



        $questions = mysqli_query($db_connection, "SELECT * FROM `question`");
        $question_id =  mysqli_num_rows($questions) + 1;
        $restaurant_row = mysqli_query($db_connection, "SELECT * FROM `restaurant` WHERE `name`='$restaurant_name'");
        $restaurant = mysqli_fetch_assoc($restaurant_row);
        $restaurant_id = intval($restaurant['restaurant_id']);
        
        $date = date("Y-m-d");


        $insert = mysqli_query($db_connection, "INSERT INTO `question`(`question_id`, `question_text`, `question_date`, `restaurant_id`, `answered`) VALUES ('$question_id', '$question', '$date', '$restaurant_id', '0')");                      
       
    } 
    elseif (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Add Answer")){
        $answer = $_POST['answer'];
        $question_id = $_POST['question_id'];
        $question_id = intval($question_id);
        $answers = mysqli_query($db_connection, "SELECT * FROM `answer`");
        $answer_id =  mysqli_num_rows($answers) + 1;
        
        $date = date("Y-m-d");
        $insert = mysqli_query($db_connection, "INSERT INTO `answer`(`answer_id`, `answer_text`, `answer_date`, `question_id`) VALUES ('$answer_id', '$answer', '$date', '$question_id')");        
        $update = mysqli_query($db_connection, "UPDATE `question` SET `answered`='1' WHERE `question`.`question_id`='$question_id'");           
       
    }
}


$reviewer = mysqli_query($db_connection, "SELECT * FROM `reviewer` WHERE `email` = '$email'");

$manager = mysqli_query($db_connection, "SELECT * FROM `restaurant_manager` WHERE `email` = '$email'");

if (mysqli_num_rows($reviewer) == 0 && mysqli_num_rows($manager) == 0){
    $revOrManChosen = FALSE;
} 
else{
    $revOrManChosen = TRUE;
    if (mysqli_num_rows($reviewer) != 0){
        $revOrMan = "Restaurant Reviewer";
    }
    else{
        $revOrMan = "Restaurant Manager";
    }
}

$has_restaurant = FALSE;
if($revOrMan == "Restaurant Manager"){
    $restaurants_owned = mysqli_query($db_connection, "SELECT * FROM `adds` WHERE `email`='$email'");
    if(mysqli_num_rows($restaurants_owned) > 0){
        $has_restaurant = TRUE;

    }
}
if($has_restaurant){
    $restaurants_owned = mysqli_query($db_connection, "SELECT * FROM `adds` WHERE `email`='$email'");
    $restaurant = mysqli_fetch_assoc($restaurants_owned);
    $restaurant_id = intval($restaurant['restaurant_id']);
    $questions_asked = mysqli_query($db_connection, "SELECT * FROM `question` WHERE `restaurant_id`='$restaurant_id'");
    if(mysqli_num_rows($questions_asked) == 0){
        $no_questions = TRUE;
    }
    else{
        $no_questions = FALSE;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            -webkit-box-sizing: border-box;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f7f7ff;
            padding: 10px;
            margin: 0;
        }
        ._container{
            max-width: 400px;
            background-color: #ffffff;
            padding: 20px;
            margin: 0 auto;
            border: 1px solid #cccccc;
            border-radius: 2px;
        }
        .heading{
            text-align: center;
            color: #4d4d4d;
            text-transform: uppercase;
        }
        ._img{
            overflow: hidden;
            width: 100px;
            height: 100px;
            margin: 0 auto;
            border-radius: 50%;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        ._img > img{
            width: 100px;
            min-height: 100px;
        }
        ._info{
            text-align: center;
        }
        ._info h1{
            margin:10px 0;
            text-transform: capitalize;
        }
        ._info p{
            color: #555555;
        }
        ._info a{
            display: inline-block;
            background-color: #E53E3E;
            color: #fff;
            text-decoration: none;
            padding:5px 10px;
            border-radius: 2px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="_container">
        <h2 class="heading">My Account</h2>
    </div>
    <div class="_container">
        
        <br>
        <?php if (!$revOrManChosen):  ?>
            <div class="_info">
                <form name="revOrManButton" action="revOrManForm.php" method="post">
                    <input type="hidden" value="<?php $email;?>">
                    <input type="submit" value="Sign Up as Manager or Reviewer"/>
                </form>
            </div>
        <?php elseif ($revOrMan=="Restaurant Reviewer"): ?>
            <div class="_info">
            <form name="makeReview" action="restaurantReviewList.php" method="post">
                    <input type="hidden" value="<?php $email;?>">
                    <input type="submit" value="Make a Review!"/>
                </form>
            </div>
        <?php elseif ($revOrMan=="Restaurant Manager"): ?>
            <div class="_info">
            <form name="Add Your Restaurant!" action="addRestaurant.php" method="post">
                    <input type="hidden" value="<?php $email;?>">
                    <input type="submit" value="Add Your Restaurant!"/>
                </form>
            </div>
            <?php if ($has_restaurant AND !$no_questions ): ?>
                <div class="_info">
                <form name="Answer Questions!" action="answerQuestion.php" method="post">
                    <input type="submit" value="Answer Questions!"/>
                </form>
                </div>  
            <?php endif ?>
        <?php endif ?>  
        <div class="_info">
            <h1><?php echo $user['name']; ?></h1>
            <p><?php echo $user['email']; ?></p>
            <a href="restaurants.php">Restaurant List</a>
            <a href="questionList.php">Ask a question</a>
            <a href="logout.php">Logout</a>

        </div>
    </div>
</body>
</html>