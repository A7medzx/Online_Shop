<?php
include("config.php");

// Retrieve the 'id' from the URL
$ID = $_GET['id']; // Corrected $_GRT to $_GET

// Check if the ID is set and valid
if (isset($ID) && is_numeric($ID)) {
    // Run the DELETE query
    mysqli_query($con, "DELETE FROM `add_to_cart` WHERE `ID`='$ID'");

    // Redirect back to the cart page
    header("Location: cart.php");
    exit(); // Ensure no further code runs
} else {
    // Handle invalid or missing ID
    echo "Invalid product ID.";
}
?>
