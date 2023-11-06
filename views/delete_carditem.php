<?php
require_once('db.php');

if (isset($_POST['user'], $_POST['item_id'])) {
    $user = $_POST['user'];
    $item_id = $_POST['item_id'];

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("DELETE FROM usercard WHERE user = ? AND item_id = ?");
        $stmt->execute([$user, $item_id]);

        $pdo = null;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
