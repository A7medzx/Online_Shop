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
    <title>Online Shop</title>
</head>
<body>
    <center>
        <div class="main">
            <form action="insert.php" method="post" enctype="multipart/form-data">
                   <h1>Online shopping</h1>
                   <img src="img\img\متجر.png" alt="logo" width="500">
                   <input type="text" name="name" placeholder="Enter the Product name" required>
                   <br>
                   <input type="text" name="price" placeholder="Enter the Product price" required>
                   <br>
                   <input type="file" id="file" name="Image" style='display:none;' required>
                   
                   <div class="input-group">
                       <label for="file">Upload Product Image</label>
                       <button name='upload'>Upload Product's ✅</button>
                   </div>

                   <br><br>
                   <a href="products.php">View Products</a>
                </form>
        </div>
        <p>Developed by AHMED</p>
    </center>
</body>
</html>
