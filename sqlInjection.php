// login.php

<?php 
    $query = "SELECT google_id FROM google_users WHERE google_id=?";
    $get_user_statement = $db_connection->prepare($query);
    $get_user_statement->bind_param("s", $id);
    $get_user_statement->execute();
    $get_user_result = $get_user_statement->get_result();
?>

<?php
    $insert = $db_connection->prepare("INSERT INTO `google_users`(`google_id`, `name`, `email`, `profile_image`) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $id, $full_name, $email, $profile_pic);
    $insert->execute();
?>

// home.php

<?php 
    $id = $_SESSION['login_id'];
    $query = "SELECT google_id FROM google_users WHERE google_id=?";
    $get_user_statement = $db_connection->prepare($query);
    $get_user_statement->bind_param("s", $id);
    $get_user_statement->execute();
    $get_user_result = $get_user_statement->get_result();
?>

<?php
    if (!empty($_POST['actionBtn']) && ($_POST['actionBtn'] == "Submit")){
        $displayName = $_POST['name'];
        $revOrMan = $_POST['revOrMan'];
        if ($revOrMan == "Restaurant Reviewer"){
            $query = "INSERT INTO `reviewer`(`email`,`display_name`) VALUES(?,?)";
        }
        elseif ($revOrMan == "Restaurant Manager"){
            $query = "INSERT INTO `restaurant_manager`(`email`,`name`) VALUES(?,?)";
        }
        $insert_statement = $db_connection->prepare($query);
        $insert_statement->bind_param("ss", $email, $displayName);
        $insert_statement->execute();
    }
?>

<?php
    $insert = $db_connection->prepare("INSERT INTO `restaurant`(`restaurant_id`, `image_url`, `address`, `on_elevate`, `open`, `close`, `name`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $insertCusine = $db_connection->prepare("INSERT INTO `restaurant_cuisine`(`restaurant_id`, `cuisine`) VALUES (?, ?)");
    $insert3 = $db_connection->prepare("INSERT INTO `adds`(`email`, `restaurant_id`) VALUES (?, ?)");

    $insert->bind_param("ississs", $restaurant_id, $image, $address, $elevate, $open, $close, $restaurant_name);
    $insertCusine->bind_param("is", $restaurant_id, $cuisine);
    $insert3->bind_param("si", $email, $restaurant_id);

    $insert->execute();
    $insertCusine->execute();
    $insert3->execute();
?>