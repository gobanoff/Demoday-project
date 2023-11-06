<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=amazbay", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}


if (isset($_GET['username']) && isset($_GET['item_id'])) {
    $user = $_GET['username'];
    $item_id = $_GET['item_id'];

    $sql = "DELETE FROM goods WHERE username = :username AND id = :item_id";
    $query = $db->prepare($sql);
    $query->bindParam(':username', $user);
    $query->bindParam(':item_id', $item_id, PDO::PARAM_INT);

    if ($query->execute()) {

        header("Location: ?page=usersale&user=$user");
    } else {
        echo "Item deletion failed.";
    }
} else {
    echo "Invalid request.";
}
