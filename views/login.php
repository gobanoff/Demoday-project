<?php
require_once('db.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['email'], $_POST['password'], $_POST['user'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $user = $_POST['user'];

        $email = htmlspecialchars($email);
        $pass = htmlspecialchars($pass);
        $user = htmlspecialchars($user);


        $stmt = $conn->prepare("SELECT user, password FROM usertb WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($pass, $row['password']) && $row['user'] === $user) {
                $_SESSION['loggedin'] = true;
                header('Location: ?page=userpage&user=' . urlencode($user));
                exit;
            } else {
                echo "<h2>Incorrect username, email or password</h2><a href='?page=homepage' class='btn btn-warning'>Back to list</a>";
            }
        } else {
            echo "<h2>Incorrect username, email or password</h2><a href='?page=homepage' class='btn btn-warning'>Back to list</a>";
        }
    }
}
?>


<section class="form-signin w-100 m-auto" id="sect">
    <form method="POST">
        <h1 class="h3 mb-3 fw-normal"> LOGIN </h1>
        <div class="form-floating">
            <input type="text" class="form-control" name="user" id="floatingInput" placeholder="username">
            <label for="floatingInput"> username</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput"> email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword"> password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit">LOGIN</button>
    </form>
</section>
<style>
    #sect {
        padding-bottom: 425px;

    }

    .h3 {
        font-size: 35px;
        color: #CCC;
    }

    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-top: -70px;
    }

    .form-signin {
        max-width: 330px;
        padding: 1rem;
    }

    label {
        color: #CCC;
    }

    .btn-primary {
        height: 60px;
        font-size: 25px;
    }

    h2 {
        color: red;
        padding-top: 10px;
        padding-left: 375px;
    }

    .form-signin input[type="email"] {

        margin-bottom: 10px;
        border-radius: 10px;
    }

    .form-signin input[type="text"] {
        margin-bottom: 10px;
        border-radius: 10px;

    }

    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-radius: 10px;

    }

    @media (max-width: 1030px) {

        .form-signin input {
            width: 500px;
            margin-bottom: 10px;
        }

        .btn-primary {
            width: 600px;
            height: 60px;
            font-size: 20px;
            font-weight: 600;
        }

        .btn-warning {
            margin-left: 40px;
            margin-top: 5px;
        }

    }

    @media (max-width: 820px) {

        .form-signin input {
            width: 400px;
            margin-bottom: 10px;
        }

        .btn-primary {
            width: 400px;
            height: 50px;
            font-size: 20px;
            font-weight: 600;
        }


        .btn-warning {
            margin-left: 150px;
            margin-top: 10px;
        }
    }

    @media (max-width: 420px) {


        .form-signin input {
            width: 300px;
            margin-bottom: 10px;
        }

        .btn-primary {
            width: 300px;
            height: 50px;
            font-size: 20px;
            font-weight: 600;
        }

        .btn-warning {
            width: 90px;
            height: 30px;
            font-size: 12px;
            margin-left: 150px;
            margin-top: 10px;
        }
    }
</style>