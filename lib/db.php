<?php

$conn = mysqli_connect("localhost","root","","billing_new");
if(mysqli_connect_errno()){
    echo mysqli_connect_errno();
}