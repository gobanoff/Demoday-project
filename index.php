<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gobazon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
    <style>
        body {
            position: relative;
        }

        .container {
            padding: 0;
        }

        .logo img {
            width: 100px;
            height: 100px;
            border-radius: 50px;
        }

        .logo {
            width: 100px;
            height: 100px;
            position: absolute;
            border-radius: 50px;
            top: 20px;
            left: 180px;
        }

        .logo p {
            color: red;
            font-size: 14px;
            padding-left: 20px;
            font-weight: 800;
        }

        @media (max-width: 1450px) {
            .logo img {
                width: 80px;
                height: 80px;

                border-radius: 50px;
            }

            .logo {
                width: 80px;
                height: 80px;
                position: absolute;
                border-radius: 40px;
                top: 20px;
                left: 50px;
            }

            .logo p {
                color: red;
                font-size: 12px;
                padding-left: 15px;
                font-weight: 800;
            }
        }

        @media (max-width: 1030px) {

            .container {
                width: 800px;
            }

            .logo img {
                width: 80px;
                height: 80px;

                border-radius: 50px;
            }

            .logo {
                width: 80px;
                height: 80px;
                position: absolute;
                border-radius: 40px;
                top: 20px;
                left: 50px;
            }

            .logo p {
                color: red;
                font-size: 12px;
                padding-left: 15px;
                font-weight: 800;
            }
        }

        @media (max-width: 820px) {

            .container {
                width: 800px;
            }

            .logo img {
                width: 80px;
                height: 80px;

                border-radius: 50px;
            }

            .logo {
                width: 80px;
                height: 80px;
                position: absolute;
                border-radius: 40px;
                top: 20px;
                left: 50px;
            }

            .logo p {
                color: red;
                font-size: 12px;
                padding-left: 15px;
                font-weight: 800;
            }

        }

        @media (max-width: 600px) {

            .container {
                width: 600px;
                padding: 0;
            }

            .logo img {
                width: 60px;
                height: 60px;

                border-radius: 50px;
            }

            .logo {
                width: 60px;
                height: 60px;
                position: absolute;
                border-radius: 40px;
                top: 20px;
                left: 50px;
            }

            .logo p {
                color: red;
                font-size: 10px;
                padding-left: 10px;
                font-weight: 800;
            }

        }
    </style>

    <div class="logo">
        <img src="https://c8.alamy.com/comp/HY1G0F/colorful-star-symbol-vector-illustration-design-abstract-concept-HY1G0F.jpg" alt="logo">
        <p>gobazon</p>
    </div>

    <div class="container">
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : false;

        switch ($page) {
            case 'userpage':
                include './views/userpage.php';
                break;
            case 'login':
                include './views/login.php';
                break;
            case 'delete_carditem':
                include './views/delete_carditem.php';
                break;
            case 'edit':
                include './views/edit.php';
                break;
            case 'userheader':
                include './views/userheader.php';
                break;
            case 'homeheader':
                include './views/homeheader.php';
                break;
            case 'admin':
                include './views/admin.php';
                break;
            case 'shopcart':
                include './views/shopcart.php';
                break;
            case 'confirmpayment':
                include './views/confirmpayment.php';
                break;
            case 'register':
                include './views/register.php';
                break;
            case 'usersale':
                include './views/usersale.php';
                break;
            case 'buy':
                include './views/buy.php';
                break;
            case 'footdocums':
                include './views/footdocums.php';
                break;
            case 'account':
                include './views/account.php';
                break;
            case 'delete':
                include './views/delete.php';
                break;
            case 'inputitem':
                include './views/inputitem.php';
                break;
            case 'item':
                include './views/item.php';
                break;
            case 'addnew':
                include './views/addnew.php';
                break;
            case 'logout':
                session_destroy();
                header('Location: ?page=homepage');
                break;
            default:
                include './views/homepage.php';
        }
        ?>


    </div>


    <?php include './views/include/footer.php' ?>
</body>

</html>