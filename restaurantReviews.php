<?php 
require 'config.php';

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


$restaurant_row = mysqli_query($db_connection, "SELECT * FROM `restaurant` WHERE `name`='$name_value'");
$restaurant = mysqli_fetch_assoc($restaurant_row);
$restaurant_id = intval($restaurant['restaurant_id']);

$reviews = mysqli_query($db_connection, "SELECT * FROM `review` WHERE `restaurant_id`='$restaurant_id'");
$review_list = mysqli_fetch_assoc($reviews);

$num_reviews = mysqli_num_rows($reviews);

$num_overall_5 = 0;
$num_overall_4 = 0;
$num_overall_3 = 0;
$num_overall_2 = 0;
$num_overall_1 = 0;

$num_food_5 = 0;
$num_food_4 = 0;
$num_food_3 = 0;
$num_food_2 = 0;
$num_food_1 = 0;

$num_service_5 = 0;
$num_service_4 = 0;
$num_service_3 = 0;
$num_service_2 = 0;
$num_service_1 = 0;

foreach ($reviews as $review):
    if ($review['overall_rating'] == 5):
        $num_overall_5++;
    endif;
    if ($review['overall_rating'] == 4):
        $num_overall_4++;
    endif;
    if ($review['overall_rating'] == 3):
        $num_overall_3++;
    endif;
    if ($review['overall_rating'] == 2):
        $num_overall_2++;
    endif;
    if ($review['overall_rating'] == 1):
        $num_overall_1++;
    endif;

    if ($review['food_rating'] == 5):
        $num_food_5++;
    endif;
    if ($review['food_rating'] == 4):
        $num_food_4++;
    endif;
    if ($review['food_rating'] == 3):
        $num_food_3++;
    endif;
    if ($review['food_rating'] == 2):
        $num_food_1++;
    endif;
    if ($review['food_rating'] == 1):
        $num_food_1++;
    endif;

    if ($review['service_rating'] == 5):
        $num_service_5++;
    endif;
    if ($review['service_rating'] == 4):
        $num_service_4++;
    endif;
    if ($review['service_rating'] == 3):
        $num_service_3++;
    endif;
    if ($review['service_rating'] == 2):
        $num_service_2++;
    endif;
    if ($review['service_rating'] == 1):
        $num_service_1++;
    endif;
    
    
endforeach;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Review</title>
    <style>
        body{margin-top:20px;
background:#eee;
}
.review-list ul li .left span {
     width: 32px;
     height: 32px;
     display: inline-block;
}
 .review-list ul li .left {
     flex: none;
     max-width: none;
     margin: 0 10px 0 0;
}
 .review-list ul li .left span img {
     border-radius: 50%;
}
 .review-list ul li .right h4 {
     font-size: 16px;
     margin: 0;
     display: flex;
}
 .review-list ul li .right h4 .gig-rating {
     display: flex;
     align-items: center;
     margin-left: 10px;
     color: #ffbf00;
}
 .review-list ul li .right h4 .gig-rating svg {
     margin: 0 4px 0 0px;
}
 .country .country-flag {
     width: 16px;
     height: 16px;
     vertical-align: text-bottom;
     margin: 0 7px 0 0px;
     border: 1px solid #fff;
     border-radius: 50px;
     box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}
 .country .country-name {
     color: #95979d;
     font-size: 13px;
     font-weight: 600;
}
 .review-list ul li {
     border-bottom: 1px solid #dadbdd;
     padding: 0 0 30px;
     margin: 0 0 30px;
}
 .review-list ul li .right {
     flex: auto;
}
 .review-list ul li .review-description {
     margin: 20px 0 0;
}
 .review-list ul li .review-description p {
     font-size: 14px;
     margin: 0;
}
 .review-list ul li .publish {
     font-size: 13px;
     color: #95979d;
}

.review-section h4 {
     font-size: 20px;
     color: #222325;
     font-weight: 700;
}
 .review-section .stars-counters tr .stars-filter.fit-button {
     padding: 6px;
     border: none;
     color: #4a73e8;
     text-align: left;
}
 .review-section .fit-progressbar-bar .fit-progressbar-background {
     position: relative;
     height: 8px;
     background: #efeff0;
     -webkit-box-flex: 1;
     -ms-flex-positive: 1;
     flex-grow: 1;
     box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
     background-color: #ffffff;
    ;
     border-radius: 999px;
}
 .review-section .stars-counters tr .star-progress-bar .progress-fill {
     background-color: #ffb33e;
}
 .review-section .fit-progressbar-bar .progress-fill {
     background: #2cdd9b;
     background-color: rgb(29, 191, 115);
     height: 100%;
     position: absolute;
     left: 0;
     z-index: 1;
     border-radius: 999px;
}
 .review-section .fit-progressbar-bar {
     display: flex;
     align-items: center;
}
 .review-section .stars-counters td {
     white-space: nowrap;
}
 .review-section .stars-counters tr .progress-bar-container {
     width: 100%;
     padding: 0 10px 0 6px;
     margin: auto;
}
 .ranking h6 {
     font-weight: 600;
     padding-bottom: 16px;
}
 .ranking li {
     display: flex;
     justify-content: space-between;
     color: #95979d;
     padding-bottom: 8px;
}
 .review-section .stars-counters td.star-num {
     color: #4a73e8;
}
 .ranking li>span {
     color: #62646a;
     white-space: nowrap;
     margin-left: 12px;
}
 .review-section {
     border-bottom: 1px solid #dadbdd;
     padding-bottom: 24px;
     margin-bottom: 34px;
     padding-top: 64px;
}
 .review-section select, .review-section .select2-container {
     width: 188px !important;
     border-radius: 3px;
}
ul, ul li {
    list-style: none;
    margin: 0px;
}
.helpful-thumbs, .helpful-thumb {
    display: flex;
    align-items: center;
    font-weight: 700;
}
    </style>
</head>

<body style="background-color:#f7f7ff;">
    <br>
    <div class="container">
    <form action="restaurants.php">
        <center><button action="submit" class="btn btn-info" style="background-color:#E53E3E">Return to Restaurants</button></center>
    </form>
    </div>
<div class="container">
    <div id="reviews" class="review-section">
        <?php if(!$exists): ?>
    <h1> This restaurant does not exist, please try again </h1>
        <?php else: ?>
    <h1 class="display-4"> Reviews for <?php echo $name_value ?>: </h1>
    <?php if ($num_reviews == 0):  ?>       
        <h2> No reviews for this restaurant yet! <h2>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h4 class="m-0"><?php echo $num_reviews ;?> Reviews</h4>
        </div>
        <?php endif ?>  
        <br>
        <h2 class="lead"> Overall Review </h2> 
        <div class="row">
            
            <div class="col-md-6">
                <table class="stars-counters">
                    <tbody>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">5 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style='width: <?php echo $num_overall_5/$num_reviews * 100?>%'></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_overall_5 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">4 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_overall_4/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_overall_4 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">3 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_overall_3/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_overall_3 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">2 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_overall_2/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_overall_2 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">1 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_overall_1/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_overall_1 ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <h2 class="lead"> Food Review </h2> 
        <div class="row">
            <div class="col-md-6">
                <table class="stars-counters">
                    <tbody>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">5 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_food_5/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_food_5 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">4 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_food_4/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_food_4 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">3 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_food_3/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_food_3 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">2 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_food_2/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_food_2 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">1 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_food_1/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_food_1 ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <h2 class="lead"> Service Review </h2> 
        <div class="row">
            <div class="col-md-6">
                <table class="stars-counters">
                    <tbody>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">5 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_service_5/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_service_5 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">4 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_service_4/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_service_4 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">3 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_service_3/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_service_3 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">2 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_service_2/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_service_2 ?></td>
                        </tr>
                        <tr class="">
                            <td>
                                <span>
                                    <button class="fit-button fit-button-color-blue fit-button-fill-ghost fit-button-size-medium stars-filter">1 Stars</button>
                                </span>
                            </td>
                            <td class="progress-bar-container">
                                <div class="fit-progressbar fit-progressbar-bar star-progress-bar">
                                    <div class="fit-progressbar-background">
                                        <span class="progress-fill" style="width: <?php echo $num_service_1/$num_reviews * 100?>%;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="star-num"><?php echo $num_service_1 ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="review-list">
        <h2 class="display-4"> Comments: </h2> <br>
        <ul>
            <?php foreach($reviews as $review): ?>
                
            <li>
                <p> <?php echo $review['comment']; ?> </p>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
</body>
<?php endif ?>  
</html>
