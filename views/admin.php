<?php
require_once('db.php');

$user = $_GET['user'];
$json = file_get_contents('php://input');
$data = json_decode($json, true);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Nepavyko prisijungti: " . $conn->connect_error);
}
if (!is_null($data) && (is_array($data) || is_object($data))) {
    $order_nr = orderNr($conn);

    foreach ($data as $item) {

        $itemId = $item['itemId'];
        $user = $item['user'];
        $price = $item['price'];
        $total = $item['totalsum'];
        $quantity = $item['quantity'];
        $dlv = $item['delivery'];

        $sql = "INSERT INTO paymentinfo (item_id, item_price, quantity,order_nr,user,total_sum,delivery_price) 
                       VALUES ('$itemId',  '$price', '$quantity','$order_nr','$user','$total','$dlv')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Klaida: " . $sql . "<br>" . $conn->error;
        }
    }
}
echo "<h1 style='color: red; font-size: 50px;padding-top:20px;padding-left:50px;'>
        Congratulations, you have successfully<br> purchased this items!</h1>
        <a href='?page=userpage&user=$user' class='btn btn-warning'style='margin-top:30px;margin-left:50px; 
        box-shadow: 5px 5px 20px 1px rgb(194, 194, 205);margin-bottom:550px;';>Back to list</a>";

$conn->close();


function orderNr($conn)
{

    $unique = false;
    $order_nr = '';

    while (!$unique) {
        $order_nr = strval(mt_rand(100000, 999999));

        $query = "SELECT COUNT(*) as count FROM paymentinfo WHERE order_nr = '$order_nr'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $count = $row['count'];

        if ($count == 0) {
            $unique = true;
        }
    }

    return $order_nr;
}
