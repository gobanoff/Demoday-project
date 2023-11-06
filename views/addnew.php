<?php

require_once('db.php');

$title = $_POST['title'];
$price = $_POST['price'];
$image = $_POST['image'];
$info = $_POST['info'];
$cat = $_POST['category'];
$user = $_POST['username'];
$quan = $_POST['quantity'];
$disc = $_POST['discount'];

if (empty($title) || empty($price) || empty($image) || empty($info) || empty($cat) || empty($user) || empty($quan)) {
    echo "<h1>Fill in all the fields</h1>";
} else {
    $item_id = uniItemId($conn);

    $sql2 = "INSERT INTO `goods` (title, price, image, info, category, username, item_id, quantity,discount) 
    VALUES ('$title', '$price', '$image', '$info', '$cat', '$user', '$item_id', '$quan','$disc')";

    if ($conn->query($sql2)) {
        echo "<h2>Your item is ready for sale!</h2>";
    }
}

function uniItemId($conn)
{
    $unique = false;
    $item_id = '';

    while (!$unique) {
        $item_id = strval(mt_rand(10000000, 99999999));


        $query = "SELECT COUNT(*) as count FROM goods WHERE item_id = '$item_id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count == 0) {
            $unique = true;
        }
    }

    return $item_id;
}

?>

<?php
$user = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_GET['user']) ? $_GET['user'] : '';
?>
<a href="?page=inputitem&user=<?php echo $user; ?>" class="btn btn-warning">Back to saleform</a>
<style>
    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-bottom: 672px;
    }

    h1 {
        color: red;
    }
</style>