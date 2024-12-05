<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Edit Products</title>
</head>
<body>
<?php
    include 'config.php';
    $ID= $_GET['id'];
    $update = mysqli_query($con, "SELECT * FROM product WHERE ID = $ID");
    $data = mysqli_fetch_array($update);
?>
    <center>
        <div class="main">
            <form action="updated_data.php" method="post" enctype="multipart/form-data">
                   <h1>Edit Products</h1>
                   <input type="text" name="id" value='<?php echo $data['ID']?>'>
                   <br>
                   <input type="text" name="name" value='<?php echo $data['Name']?>' required>
                   <br>
                   <input type="text" name="price" value='<?php echo $data['Price']?>' required>
                   <br>
                   <input type="file" id="file" name="Image" style='display:none;'>
                   
                   <div class="input-group">
                       <label for="file">Update Product's Image</label>
                       <button name='update' type = 'submit'>Edit Product</button>
                   </div>

                   <br><br>
                   <a href="products.php">View Products</a>
                </form>
        </div>
        <p>Developed by AHMED</p>
    </center>
</body>
</html>
