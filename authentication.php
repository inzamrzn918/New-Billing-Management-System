<?php
require_once "lib/db.php";
require_once "lib/auto_redirect.php";

if(isset($_POST['login'])){
    $username  = $_POST['username'];
    $password  = md5($_POST['username']);
    // print_r(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `employe` WHERE `username`='$username' AND `password`='$password'")));

    $sql = "SELECT * FROM `employe` WHERE `username`='$username' AND `password`='$password'";
    if(getCount($conn,$sql)>0){
        $_SESSION['user'] = getAllData($conn,$sql);
    }else{
        echo "Invalid Credentials";
    }
}

if(isset($_POST['signup'])){
    $username  = $_POST['username'];
    $name  = $_POST['name'];
    $mobile  = $_POST['mobile'];
    $email  = $_POST['email'];
    $address = $_POST['address'];
    $password  = md5($_POST['password']);
    // print_r(mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `employe` WHERE `username`='$username' AND `password`='$password'")));

    $sql = "SELECT * FROM `employe` JOIN `user` WHERE `employe`.`user_id`=`user`.`id` AND `employe`.`username`='$username' OR `user`.`email`='$email'";
    if(getCount($conn,$sql)<=0){
        $sql_ins = "INSERT INTO `user` (`name`,`mobile`,`email`) VALUES ('$name','$mobile','$email')";
        if(executeQuery($conn, $sql_ins)){
            $uid = mysqli_insert_id($conn);
            echo $uid;
            $sql_inst = "INSERT INTO `employe` (`username`,`password`,`address`,`user_id`) VALUES ('$username','$password','$address','$uid')";
            if(executeQuery($conn, $sql_inst)){
                echo "Sign Up Success";
            }else{
                executeQuery($conn,"DELETE FROM `user` WHERE `id` = $userid");
                echo mysqli_error($conn);
            }
        }else{
            echo mysqli_error($conn);
        }
    }else{
        echo "ALready HAving account";
    }
}





function getCount($conn,$sql)
{  
    return mysqli_num_rows(mysqli_query($conn, $sql));
}

function getAllData($conn, $sql)
{
    return mysqli_fetch_assoc(mysqli_query($conn, $sql));
}

function executeQuery($conn, $sql){
    return mysqli_query($conn, $sql);
}