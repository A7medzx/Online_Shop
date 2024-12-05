<?php
include("config.php");

if (isset($_POST['update'])) {
    $ID = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Fetch existing product data to retain the image if no new file is uploaded
    $query = mysqli_query($con, "SELECT `Image` FROM `product` WHERE `ID`='$ID'");
    $result = mysqli_fetch_assoc($query);
    $existingImage = $result['Image'];

    // Handle file upload if a new image is provided
    if (!empty($_FILES['Image']['tmp_name'])) {
        $Image = $_FILES['Image'];
        $Image_location = $Image['tmp_name'];
        $Image_name = $Image['name'];
        $Image_up = "img/" . $Image_name;

        // Upload the new image
        if (move_uploaded_file($Image_location, $Image_up)) {
            $newImage = $Image_up;
            echo "<script>
            alert('Image uploaded successfully.');
            window.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                  alert('Image upload failed.');
                  window.location.href = 'index.php';
                  </script>";
            exit;
        }
    } else {
        // Use existing image if no new file is uploaded
        $newImage = $existingImage;
    }

    // Update the database
    $update = "UPDATE `product` SET `Name`='$name', `Price`='$price', `Image`='$newImage' WHERE `ID`='$ID'";
    if (mysqli_query($con, $update)) {
        echo "<script>
              alert('Product updated successfully.');
              window.location.href = 'index.php';
              </script>";
    } else {
        echo "<script>
              alert('Product update failed.');
              window.location.href = 'index.php';
              </script>";
    }
}
?>
