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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>My Cart</title>
    <style>
         .main {
            width: 60%;
            margin: 30px auto;
            box-shadow: 1px 1px 10px silver;
        }
        thead {
            background-color: #3498DB;
            color: white;
            text-align: center;
        }
        tbody {
            text-align: center;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        a {
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Shopping Cart</h1>
    <div class="main">
    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope='col'>Product Name</th>
                    <th scope='col'>Product Price</th>
                    <th scope='col'>Delete Product</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include("config.php");
                $result = mysqli_query($con, "SELECT * FROM add_to_cart");
                while ($row = mysqli_fetch_array($result)) {
                    echo "
                    <tr>
                        <td>{$row['Name']}</td>
                        <td>{$row['Price']}</td>
                        <td><a href='delete_cart.php?id={$row['ID']}' class='btn btn-danger'>Delete Product</a></td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
            </div>

<center>
    <a href = "shop.php" class="btn btn-primary"> Back to Available Products</a>
</center>
</body>
</html>