<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=amazbay", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['item_id']) && isset($_POST['new_title']) && isset($_POST['new_price']) && isset($_POST['new_image'])) {
        $username = $_POST['username'];
        $item_id = $_POST['item_id'];
        $new_title = $_POST['new_title'];
        $new_price = $_POST['new_price'];
        $new_image = $_POST['new_image'];


        $sql = "UPDATE goods SET title = :new_title, price = :new_price, image = :new_image WHERE username = :username AND item_id = :item_id";
        $query = $db->prepare($sql);
        $query->bindParam(':username', $username);
        $query->bindParam(':item_id', $item_id, PDO::PARAM_INT);
        $query->bindParam(':new_title', $new_title);
        $query->bindParam(':new_price', $new_price);
        $query->bindParam(':new_image', $new_image);

        if ($query->execute()) {
            header("Location: ?page=usersale&user=$username");
        } else {
            echo "Item update failed.";
        }
    } else {
        echo "Invalid request.";
    }
} elseif (isset($_GET['username']) && isset($_GET['item_id'])) {
    $username = $_GET['username'];
    $item_id = $_GET['item_id'];

    $sql = "SELECT title,price,image FROM goods WHERE username = :username AND item_id = :item_id";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $username);
    $query->bindParam(':item_id', $item_id, PDO::PARAM_INT);

    if ($query->execute()) {
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $title = $result['title'];
            $price = $result['price'];
            $image = $result['image'];

            echo "<form method='POST'style='padding-left:40px;' action=''>";
            echo "<h3 style='color: grey;padding-top:40px;'>Edit title:</h3>
            <input type='text'class='form-control' name='new_title' value='$title'id='floatingInput'><br>";
            echo "<h3 style='color: grey;'>Edit price:</h3> 
            <input type='text'class='form-control' name='new_price' value='$price'id='floatingInput'><br>";
            echo "<h3 style='color: grey;'>Edit image:</h3>
             <input type='text'class='form-control' name='new_image' value='$image'id='floatingInput'><br>";
            echo "<input type='hidden' name='username' value='$username'>";
            echo "<input type='hidden' name='item_id' value='$item_id'>";
            echo "<input type='submit'class='btn btn-primary' value='Confirm changes'>";
            echo "</form>";
        } else {
            echo "Item not found.";
        }
    } else {
        echo "Item retrieval failed.";
    }
} else {
    echo "Invalid request.";
}
?>

<style>
    .btn-primary {
        margin-bottom: 377px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
    }
</style>


<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_POST['item_id']) &&
        isset($_POST['new_price'])
    ) {
        $item_id = $_POST['item_id'];
        $new_price = $_POST['new_price'];

        try {
            $db->beginTransaction();

            $sql_update_usercard = "UPDATE usercard SET price = :new_price WHERE  item_id = :item_id";
            $stmt_usercard = $db->prepare($sql_update_usercard);
            $stmt_usercard->bindParam(':new_price', $new_price);
            $stmt_usercard->bindParam(':item_id', $item_id, PDO::PARAM_INT);
            $stmt_usercard->execute();

            $db->commit();
            echo "Kaina atnaujinta sėkmingai.";
        } catch (PDOException $e) {
            $db->rollback();
            echo "Klaida: " . $e->getMessage();
        }
    } else {
        echo "Neteisingas užklausos formatas.";
    }
} else {
    echo "";
}
?>