<?php
require_once('db.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user = $_GET['user'];
    $user = $_POST['user'];
    $itemId = $_POST['item_id'];
    $totalPrice = $_POST['total_price'];
    $quan = $_POST['quantity'];
    $iprice = $_POST['iprice'];
    $dlv = $_POST['delivery'];

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $order_nr = orderNr($pdo);

        $stmt = $pdo->prepare("INSERT INTO paymentinfo (total_sum, item_id, user,quantity,item_price,delivery_price, order_nr ) VALUES (?,?, ?,?,?, ?,?)");
        $stmt->execute([$totalPrice, $itemId, $user, $quan, $iprice, $dlv, $order_nr]);


        echo "<h1 style='color: red; font-size: 50px;padding-top:20px;padding-left:50px;'>Congratulations, you have successfully<br> purchased this item!</h1>
        <a href='?page=userpage&user=$user' class='btn btn-warning'style='margin-top:30px;margin-left:50px; 
        box-shadow: 5px 5px 20px 1px rgb(194, 194, 205)';>Back to list</a>";

        exit();
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
} else {
    echo "<h2>Invalid request method</h2>";
}

function orderNr($pdo)
{
    $unique = false;
    $order_nr = '';

    while (!$unique) {
        $order_nr = strval(mt_rand(100000, 999999));


        $query = "SELECT COUNT(*) as count FROM paymentinfo WHERE order_nr = :order_nr";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':order_nr', $order_nr);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            $unique = true;
        }
    }

    return $order_nr;
}
