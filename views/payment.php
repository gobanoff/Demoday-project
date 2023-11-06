<?php
require_once('db.php');
$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$country = $_POST['country'];
$address = $_POST['address'];
$city = $_POST['city'];
$postcode = $_POST['postcode'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$pay = $_POST['payment'];

if (
    empty($fname) or empty($lname) or empty($country) or empty($address)
    or empty($city) or empty($postcode) or empty($email) or empty($mobile) or empty($pay)
) {
    echo "<h1>Fill in all the fields </h1>";
} else {

    $sql1 = "INSERT INTO `deliveryinfo` (firstname,lastname,country,address,city,postcode,email,mobile,payment_method) 
    VALUES ('$fname', '$lname', '$country','$address', '$city','$postcode','$email','$mobile','$pay')";

    if ($conn->query($sql1)) {
        echo "<h2>You successfully complete delivery form !</h2>";
    }
}

?>

<?php
$user = $_GET['user'];
$image = $_GET['image'];
$title = $_GET['title'];
$itemId = $_GET['item_id'];
$price = $_GET['price'];
$quan = $_GET['quantity'];
$disc = $_GET['discount'];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
$user = $_GET['user'];
?>

<a href="?page=buy&user=<?php echo $user; ?>&title=<?php echo urlencode($title); ?>
        &price=<?php echo urlencode($price); ?>&image=<?php echo urlencode($image); ?> 
        &item_id=<?php echo urlencode($itemId); ?>&discount=<?php echo urlencode($disc); ?>
        &quantity=<?php echo urlencode($quan); ?>" class="btn btn-warning">Back to payment</a>
<style>
    .btn-warning {
        margin-bottom: 672px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
    }

    h1 {
        color: red;
    }
</style>




