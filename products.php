<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:wght@100;400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Products</title>
    <style>
        .card {
            float: right;
            margin-top: 20px;
            margin-left: 20px;
            margin-right: 20px;
            width: 25rem; 
            height: 400px; 
            display: flex;
            flex-direction: column; 
            justify-content: space-between; 
        }
        .card img {
            width: 100%;
            height: 200px; 
            object-fit: contain; 
        }
        .card-body {
            display: flex;
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            flex-grow: 1; 
            padding: 10px; 
        }
        .card-title, .card-text {
            margin: 0; 
            text-align: center; 
        }
        .btn-container {
            display: flex;
            justify-content: center; 
            gap: 10px; 
            margin-bottom: 10px; 
        }
    </style>
</head>

<body>
    <center>
        <h1>All Available Products</h1>
    </center>
    <?php
        include("config.php");
        $result = mysqli_query($con, "SELECT * FROM product");
        while ($row = mysqli_fetch_array($result)) {
            echo "
            <main>
                <div class='card'>
                    <div style='display: flex; justify-content: center;'>
                        <img src='$row[Image]' class='card-img-top'>
                    </div>    
                    <div class='card-body'>
                        <h5 class='card-title'>$row[Name]</h5>
                        <p class='card-text'>$row[Price]</p>
                    </div>
                    <div class='btn-container'> <!-- Container for buttons -->
                        <a href='update.php? id=$row[ID]' class='btn btn-primary'>Edit the product</a>
                        <a href='delete.php? id=$row[ID]' class='btn btn-danger'>Delete the product</a>
                    </div>
                </div>
            </main>
            ";
        }
    ?>
</body>

</html> 