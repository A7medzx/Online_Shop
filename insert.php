<?php

include("config.php");

if(isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
        $Image = $_FILES['Image'];
        $Image_location = $Image['tmp_name'];
        $Image_name = $Image['name'];
        $Image_up = "img/" . $Image_name;

        $insert = "INSERT INTO `product`(`Name`, `Price`, `Image`) VALUES ('$name','$price','$Image_up')";
        if (mysqli_query($con, $insert)) {
            if (move_uploaded_file($Image_location, $Image_up)) 
            {
                echo "<script>
                      alert('Product Image is Uploaded Successfully');
                      window.location.href = 'index.php';
                      </script>";
            } else {
                echo "<script>
                      alert('Product Image is not Uploaded');
                      window.location.href = 'index.php';
                      </script>";
            }
}
}

?>