<?php 

include 'config.php'; // Ensure the DB connection
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
    exit();
}

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
    exit();
}

if (isset($_POST['add_to_cart'])) {
    $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES, 'UTF-8');
    $product_price = htmlspecialchars($_POST['product_price'], ENT_QUOTES, 'UTF-8');
    $product_image = htmlspecialchars($_POST['product_image'], ENT_QUOTES, 'UTF-8');
    $product_quantity = htmlspecialchars($_POST['product_quantity'], ENT_QUOTES, 'UTF-8');

    $product_price = filter_var($product_price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    $stmt = $con->prepare("SELECT * FROM `add_to_cart` WHERE Name = ? AND user_id = ?");
    $stmt->bind_param("si", $product_name, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $message[] = 'The product is already in the cart!';
    } else {
        $stmt = $con->prepare("INSERT INTO `add_to_cart` (user_id, Name, Price, Image, quantity) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isssi", $user_id, $product_name, $product_price, $product_image, $product_quantity);
        $stmt->execute();
        $message[] = 'The product was added to the cart successfully!';
    }
}

if (isset($_POST['update_cart'])) {
    $update_quantity = htmlspecialchars($_POST['cart_quantity'], ENT_QUOTES, 'UTF-8');
    $update_id = htmlspecialchars($_POST['cart_id'], ENT_QUOTES, 'UTF-8');

    $stmt = $con->prepare("UPDATE `add_to_cart` SET quantity = ? WHERE ID = ?");
    $stmt->bind_param("ii", $update_quantity, $update_id);
    $stmt->execute();
    $message[] = 'The quantity has been updated successfully!';
}

if (isset($_GET['remove'])) {
    $remove_id = htmlspecialchars($_GET['remove'], ENT_QUOTES, 'UTF-8');

    $stmt = $con->prepare("DELETE FROM `add_to_cart` WHERE ID = ?");
    $stmt->bind_param("i", $remove_id);
    $stmt->execute();
    header('location:index2.php');
    exit();
}

if (isset($_GET['delete_all'])) {
    $stmt = $con->prepare("DELETE FROM `add_to_cart` WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    header('location:index2.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <link rel="stylesheet" href="css2/style.css">
    <style>
        .message {
            background-color: #f4f4f4;
            color: #333;
            padding: 10px;
            margin: 10px 0;
            border-left: 5px solid #28a745;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }
        thead {
            background-color: #f4f4f4;
        }
        img {
            max-width: 100%;
            height: auto;
        }
        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }
    </style>
</head>
<body>

<?php
if (isset($message)) {
    foreach ($message as $msg) {
        echo '<div class="message" onclick="this.remove();">' . $msg . '</div>';
    }
}
?>

<div class="container">

    <div class="user-profile">
        <?php
        $stmt = $con->prepare("SELECT * FROM `user` WHERE ID = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $fetch_user = $result->fetch_assoc();
        }
        ?>

        <p> Current User: <span><?php echo htmlspecialchars($fetch_user['Name'], ENT_QUOTES, 'UTF-8'); ?></span></p>
        <div class="flex">
            <a href="index2.php?logout=<?php echo $user_id; ?>" onclick="return confirm('Are you sure you want to log out?');" class="delete-btn">Log Out</a>
        </div>
    </div>

    <div class="products">
        <h1 class="heading">Newest Products</h1>
        <div class="box-container">
            <?php
            $result = $con->query("SELECT * FROM product");
            while ($row = $result->fetch_assoc()) {
            ?>
                <form method="post" class="box" action="">
                <img src="/Online_Shop/<?php echo htmlspecialchars($row['Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Product Image" style="max-width: 200px; width: 100%; height: auto;">
                    <div class="name"><?php echo htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8'); ?></div>
                    <div class="price"><?php echo $row['Price']; ?></div>
                    <input type="number" min="1" name="product_quantity" value="1">
                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($row['Image'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['Name'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['Price'], ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="submit" value="Add to Cart" name="add_to_cart" class="btn">
                </form>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="shopping-cart">
        <h1 class="heading">Shopping Cart</h1>
        <table>
            <thead>
                <th>Picture</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </thead>
            <tbody>
            <?php
            $stmt = $con->prepare("SELECT * FROM `add_to_cart` WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $grand_total = 0;

            if ($result->num_rows > 0) {
                while ($fetch_cart = $result->fetch_assoc()) {
                    $product_price = filter_var($fetch_cart['Price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $sub_total = $product_price * $fetch_cart['quantity'];
            ?>
                <tr>
                    <td>
                        <img src="img/<?php echo htmlspecialchars($fetch_cart['Image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Cart Image" style="max-width: 100px; width: auto; height: auto;">
                    </td>
                    <td><?php echo htmlspecialchars($fetch_cart['Name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo $product_price; ?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['ID']; ?>">
                            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
                            <input type="submit" name="update_cart" value="Update" class="btn">
                        </form>
                    </td>
                    <td><?php echo number_format($sub_total, 2); ?></td>
                    <td><a href="index2.php?remove=<?php echo $fetch_cart['ID']; ?>" class="delete-btn">Remove</a></td>
                </tr>
                <?php
                    $grand_total += $sub_total;
                }
            } else {
                echo '<tr><td colspan="6" class="empty">Your shopping cart is empty!</td></tr>';
            }
            ?>
            <tr class="table-bottom">
                <td colspan="4">Total Price: </td>
                <td><?php echo number_format($grand_total, 2); ?></td>
                <td><a href="index2.php?delete_all" onclick="return confirm('Are you sure you want to clear the cart?');" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Clear All</a></td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
