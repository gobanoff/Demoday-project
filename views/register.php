<?php

require_once('db.php');

function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = sanitizeInput($_POST['user']);
    $email = sanitizeInput($_POST['email']);
    $pass = sanitizeInput($_POST['password']);
    $repass = sanitizeInput($_POST['repassword']);

    if (empty($user) || empty($pass) || empty($repass) || empty($email)) {
        echo "<h1>Fill in all the fields</h1>
        <a href='?page=account'class='btn btn-warning' type='submit'>Try to sign up again</a>";
    } else {
        if ($pass !== $repass) {
            echo "<h1>Passwords must be the same</h1><a href='?page=account'class='btn btn-warning' type='submit'>Try to sign up again</a>";
        } elseif (strlen($pass) < 6 || strlen($user) < 6) {
            echo "<h1>Your password is too short, it must be at least 6 characters</h1>
            <a href='?page=account'class='btn btn-warning' type='submit'>Try to sign up again</a>";
        } else {

            $stmt = $conn->prepare("SELECT user FROM usertb WHERE user = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<h1>This username already exists!<br>You can use for free: idiot, monkey,
                doublebeach, sucker, stupidclown and more other beautiful usernames.</h1> 
                <a href='?page=account'class='btn btn-warning' type='submit'>Try to sign up again</a>";
            } else {

                $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO usertb (user, password, email) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $user, $hashed_password, $email);

                if ($stmt->execute()) {
                    echo "<h2>Your registration is complete!</h2>";
                } else {
                    echo "<h2>Try again!</h2>";
                }
            }
        }
    }
}















echo "<a href='?page=login'class='btn btn-primary' type='submit'>LOGIN</a>"

?>

<style>
    h1 {
        color: red;
    }

    h2 {
        color: rgb(0, 255, 4);
    }

    .btn-primary {
        margin-bottom: 672px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);

    }

    .btn-warning {
        margin-bottom: 672px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-right: 50px;
    }
</style>