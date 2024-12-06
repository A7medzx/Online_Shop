<?php
include("config.php");
$ID = $_GET['id'];
$up = mysqli_query($con, "select * from product where id='$ID'");
$data = mysqli_fetch_array($up);
?>
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
    <title>Confirm Buying</title>
    <style>
        input {
            display: none;
        }

        .main {
            width: 30%;
            padding: 20px;
            box-shadow: 1px 1px 10px silver;
            margin: 50px auto;
        }

        .custom-button {
            width: auto;
            font-family: 'Lato', sans-serif;
            font-weight: bold;
            font-size: 25px;
        }

        .glow-button {
            color: white;
            border: none;
            cursor: pointer;
            transition: box-shadow 0.3s;
        }

        .glow-button:hover {
            box-shadow: 0 0 20px red;
        }

        .glow-button:active {
            box-shadow: 0 0 10px red;
        }
    </style>
</head>

<body>
    <center>
        <div class="main">
            <form action="insert_cart.php" method="post">
                <h2 name=head2>Do you want to buy that Product</h2>
                <input type="text" name="id" value="<?php echo $data["ID"] ?>">
                <input type="text" name="name" value="<?php echo $data['Name'] ?>">
                <input type="text" name="price" value="<?php echo $data['Price'] ?>">
                <button name="add" type="submit" class="btn btn-danger custom-button glow-button">Confirm your
                    Purchase</button>
                <br>
                <a href="shop.php">Back to Products</a>
                <br>
            </form>
        </div>
    </center>
</body>

</html>