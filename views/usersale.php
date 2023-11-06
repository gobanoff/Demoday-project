<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=amazbay", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

$itemsPerPage = 10;

$page = isset($_GET['pg']) ? intval($_GET['pg']) : 1;

$sale = [];
//$user = isset($_GET['user']) ? $_GET['user'] : '';
$user = isset($_GET['user']) ? filter_var($_GET['user']) : '';

if (!empty($user)) {

    $offset = ($page - 1) * $itemsPerPage;


    if ($offset < 0) {
        $offset = 0;
    }

    $sql = "SELECT * FROM goods WHERE username = :username LIMIT :limit OFFSET :offset";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $user, PDO::PARAM_STR);
    $query->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
    $query->bindParam(':offset', $offset, PDO::PARAM_INT);

    if ($query->execute()) {
        $sale = $query->fetchAll(PDO::FETCH_ASSOC);
    } else {
        print_r($query->errorInfo());
    }
} else {
    echo "Please provide a username to retrieve data.";
}

$sqlCount = "SELECT COUNT(*) FROM goods WHERE username = :username";
$queryCount = $db->prepare($sqlCount);
$queryCount->bindParam(':username', $user);
$queryCount->execute();
$totalItems = $queryCount->fetchColumn();

$totalPages = ceil($totalItems / $itemsPerPage);

?>

<header>
    <?php if (isset($_SESSION['loggedin']) and $_SESSION['loggedin']) : ?>

        <h2>Check your items list, <?php echo $user; ?> !</h2>
        <p>Are you done? <a href="?page=logout"><strong>Logout</strong></a> </p>
    <?php endif; ?> <a href="?page=userpage&user=<?php echo $user; ?>" class="btn btn-warning">Back to list</a>
</header>
<section>

    <?php foreach ($sale as $dat) : ?>
        <div class="line"> </div>
        <div class="items">

            <img src="<?php echo $dat['image']; ?>" alt="foto">

            <div class="cart">
                <h3><?php echo $dat['title']; ?></h3>
                <h4><?php echo $dat['price']; ?> €</h4>

                <?php if ($dat['discount'] > 0) : ?>
                    <h5>Discount: <span>-<?php echo $dat['discount']; ?>%</span></h5>
                <?php endif; ?>


                <h5>Quantity :<span> <?php echo $dat['quantity']; ?></span></h5>
                <h5>Item id :<span> <?php echo $dat['item_id']; ?></span></h5>
            </div>
            <div class="buttons"> <a href="?page=edit&username=<?php echo $user; ?>&item_id=<?php echo $dat['item_id']; ?>" class="btn btn-primary" onclick="return confirm('Are you sure you want to edit this item info?');">Edit item info</a>

                <a href="?page=delete&username=<?php echo $user; ?>&item_id=<?php echo $dat['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Remove item</a>
            </div>
        </div>


    <?php endforeach; ?>

    <div class="pagin">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=usersale&user=<?php echo $user; ?>&pg=<?php echo $i; ?>" class="<?php echo $i === $page ? 'current' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>

</section>
<style>
    .pagin {
        display: flex;
        justify-content: center;
        padding-top: 50px;
        gap: 20px;
        font-size: 18px;
        font-weight: 700;
        list-style-type: none;
    }

    .pagin a.current {
        text-decoration: underline;
    }

    .pagin a {
        text-decoration: none;
    }

    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
    }

    .buttons {
        padding-left: 150px;
    }

    .btn-danger {
        width: 120px;
        height: 40px;
        margin-top: 50px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        font-size: 15px;
        font-weight: 600;
    }

    .btn-primary {
        width: 120px;
        height: 40px;
        margin-top: 50px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        font-size: 15px;
        font-weight: 600;
    }

    .items {
        display: flex;
        justify-content: start;
        padding-top: 50px;
    }

    img {
        width: 300px;
    }

    span {
        font-weight: 700;
        color: black;
    }

    h2 {
        color: rgb(170, 170, 185);
        padding-top: 20px;
    }

    h4 {
        padding-top: 20px;
        color: rgb(249, 34, 34);
    }

    h5 {
        color: rgb(170, 170, 185);
        padding-top: 10px;
    }

    h3 {
        color: rgb(170, 170, 185);
    }

    .cart {
        width: 900px;
        padding-left: 50px;
    }

    .line {
        width: 1300px;
        height: 2px;
        background-color: rgb(233, 222, 222);
        margin-top: 40px;
    }
</style>