<?php
include("config.php");
 $ID = $_GET['id'];
 mysqli_query($con,"delete from product where ID=$ID");
 header("location:products.php");
?>