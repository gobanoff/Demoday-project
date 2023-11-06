<?php
require_once('db.php');

$usr = $_GET['username'];
$image = $_GET['image'];
$title = $_GET['title'];
$cat = $_GET['cat'];
$info = $_GET['info'];
$itemId = $_GET['item_id'];
$price = $_GET['price'];
$cnt = $_GET['cnt'];
$quan = $_GET['quantity'];
$disc = $_GET['discount'];

 if (isset($_SESSION['loggedin']) and $_SESSION['loggedin']) {
    $user = $_GET['user'];}

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}



if (isset($itemId)) {

    $update = "UPDATE goods SET counter = counter + 1 WHERE item_id = :item_id";
    $st = $pdo->prepare($update);
    $st->bindParam(':item_id', $itemId, PDO::PARAM_INT);
    $st->execute();


    $query = "SELECT counter FROM goods WHERE item_id = :item_id";
    $st = $pdo->prepare($query);
    $st->bindParam(':item_id', $itemId, PDO::PARAM_INT);
    $st->execute();
    $result = $st->fetch(PDO::FETCH_ASSOC);
    $cnt = ($result) ? $result['counter'] : 0;
}

?>


<body>
    <style>
        body {

            position: relative;
        }

        .btn-primary {
            font-weight: 700;
            position: absolute;
            top: 320px;
            right: 710px;
            width: 150px;
            height: 40px;
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        }

        img {
            width: fit-content;
            height: 300px;
        }

        .play {
            padding-top: 50px;
        }

        .btn-warning {
            width: 120px;
            height: 35px;
            margin-top: 20px;
            font-size: 16px;
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        }

        h1 {
            font-weight: 700;
            padding-top: 20px;
            color: rgb(214, 145, 18);
        }

        .play1 {
            display: flex;
            justify-content: space-between;
        }

        .sch {
            margin-left: 200px;
            width: 900px;
            height: 50px;
            margin-top: 50px;
            border-radius: 6px;
            padding-left: 10px;
        }

        h3 {
            color: black;
        }

        h2 {
            font-weight: 900;
            margin-top: 50px;
            color: black;
        }

        .butn {
            border: none;
            background-color: white;
        }

        textarea {
            border: none;
            padding: 50px;
            font-size: 22px;
            border-radius: 16px;
            background-color: rgba(246, 247, 247, 0.826);
            margin-top: 40px;
            color: black;
        }

        .butn img {
            width: 100px;
            height: 55px;
            margin-left: -18px;
            padding-bottom: 5px;
            border-radius: 5px;
        }

        .btn-secondary {
            font-weight: 700;
            position: absolute;
            top: 410px;
            right: 710px;
            width: 150px;
            height: 40px;
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        }

        h4 {
            color: black;
        }

        .cnt {
            color: black;

            font-size: 25px;
        }

        .prc1 {
            background: red;
            position: absolute;
            top: 180px;
            right: 950px;
            font-size: 35px;
            color: white;
            font-weight: 700;
            border-radius: 30px;
            border: none;
        }

        .prc {
            position: absolute;
            top: 200px;
            right: 600px;
            font-size: 50px;
            color: red;
            font-weight: 700;
        }

        .sp {
            color: black;
            font-size: 24px;
        }

        span {
            color: blue;
        }
    </style>

    <div class="play1">

        <form method="GET" action="javascript:void(0);" onsubmit="submitForm();">
            <input type="text" name="search" class="sch" placeholder="Search">
            <button type="submit" class="butn">
                <img src="https://t3.ftcdn.net/jpg/05/58/77/36/360_F_558773631_30k5dNuPMstknR40YiWytQQsk4NJaE3j.jpg" alt=""></button>
        </form>
    </div>

    

    <?php
    if (isset($_SESSION['loggedin']) and $_SESSION['loggedin']) : ?>
        <a href="?page=shopcart&user=<?php echo urlencode($user); ?>&item_id=<?php echo urlencode($itemId); ?>
         &title=<?php echo urlencode($title); ?>&price=<?php echo urlencode($price); ?>
         &image=<?php echo urlencode($image); ?>&discount=<?php echo urlencode($disc); ?>
         &quantity=<?php echo urlencode($quan); ?>" class= "btn btn-secondary">Add to cart</a>

        <a href="?page=buy&user=<?php echo urlencode($user); ?> &title=<?php echo urlencode($title); ?>
        &price=<?php echo urlencode($price); ?>&image=<?php echo urlencode($image); ?> 
        &item_id=<?php echo urlencode($itemId); ?>&discount=<?php echo urlencode($disc); ?>
        &quantity=<?php echo urlencode($quan); ?>" class="btn btn-primary "> Buy now</a>
    <?php endif; ?>


    <div class="play">
        <img src="<?php echo $image; ?>" alt="foto">
    </div>
    <h1><?php echo $title; ?></h1>
    <h3>Seller information :<span> <?php echo $usr; ?></span></h3>
    <p class="prc"><span class="sp">Price:</span> €<?php echo $price ?> </p>

    <?php if ($disc > 0) : ?>
        <button class="prc1"> -<?php echo $disc; ?>% </button>
    <?php endif; ?>

    <h4>Item ID :<span> <?php echo $itemId; ?></span></h4>
    <h4>Category :<span> <?php echo $cat; ?></span></h4>
    <h4>Quantity :<span> <?php echo $quan; ?></span></h4>
    <h5 class="cnt"> This item has been watched :
        <span id="viewCount"><?php echo $cnt; ?> </span>
    </h5>

    <h2>Technical Details : </h2>

    <textarea name="myTextarea" placeholder="Item info :" cols="116" rows="20" minlength="10" maxlength="500" required><?php echo $info; ?> 
    </textarea>
    <?php if (isset($_SESSION['loggedin']) and $_SESSION['loggedin']) : ?>
    <a href="?page=userpage&user=<?php echo urlencode($user); ?>" class="btn btn-warning">Back to list</a>
    <?php else : ?>
        <a href="?page=homepage" class="btn btn-warning">Back to list</a>
        <?php endif; ?>


</body>

</html>

<script>
function submitForm() {
   
    var searchValue = document.querySelector('input[name="search"]').value;
    var url = '?page=userpage&user=<?php echo $user; ?>&search=' + encodeURIComponent(searchValue);
    window.location.href = url;
}
</script>