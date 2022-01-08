<?php

if(isset($_POST['login'])){
    $username  = $_POST['username'];
    $password  = $_POST['username'];

    $res = mysqli_query($conn, "SELECT * FROM ");
}



function getUsercount()
{
    return mysqli_num_rows(mysqli_query());
}