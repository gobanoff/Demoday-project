<header>

    <?php
    $user = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_GET['user']) ? htmlspecialchars($_GET['user']) : '';
    ?>
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) : ?>

        <?php if (isset($_GET['user'])) {
            $user = $_GET['user'];
        } ?>

        <h2>Welcome, <?php echo $user; ?> !</h2>
        <p>Are you done? <a href="?page=logout"><strong>Logout</strong></a> </p>


        <form method="GET" onsubmit="submitForm(event);">
            <input type="text" name="search" class="sch" placeholder="Search">
            <button type="submit" class="butn">
                <img src="https://t3.ftcdn.net/jpg/05/58/77/36/360_F_558773631_30k5dNuPMstknR40YiWytQQsk4NJaE3j.jpg" alt="">
            </button>
        </form>

        <a href="?page=shopcart&user=<?php echo $user; ?>" class="btn btn-danger " id="cart"> Shopping cart </a>
        <a href="?page=usersale&user=<?php echo $user; ?>" class="btn btn-danger " id="list"> Visit your items list</a>
        <a href="?page=inputitem&user=<?php echo $user; ?>" class="btn btn-danger" id="sale"> Upload your item for sale</a>

    <?php endif; ?>

    <div class="nav">


        <a href="?category=Laptops&page=userpage&user=<?php echo $user; ?>">
            <li>Laptops</li>
        </a>
        <a href="?category=Smartphones&page=userpage&user=<?php echo $user; ?>">
            <li>Smartphones</li>
        </a>
        <a href="?category=PC&page=userpage&user=<?php echo $user; ?>">
            <li>PC</li>
        </a>
        <a href="?category=TV_set&page=userpage&user=<?php echo $user; ?>">
            <li>TV set</li>
        </a>
        <a href="?category=Watches&page=userpage&user=<?php echo $user; ?>">
            <li>Smart Watches</li>
        </a>
        <a href="?category=Monitors&page=userpage&user=<?php echo $user; ?>">
            <li>Monitors</li>
        </a>
        <a href="?category=Accessories&page=userpage&user=<?php echo $user; ?>">
            <li>Accessories</li>
        </a>
        <a href="?category=Cameras&page=userpage&user=<?php echo $user; ?>">
            <li>Cameras</li>
        </a>

    </div>
    <div class="drop">

        <button class="nav-btn">&#9776</button>

        <div id="nav1">


            <a href="?category=Laptops&page=userpage&user=<?php echo $user; ?>">
                <li>Laptops</li>
            </a>
            <a href="?category=Smartphones&page=userpage&user=<?php echo $user; ?>">
                <li>Smartphones</li>
            </a>
            <a href="?category=PC&page=userpage&user=<?php echo $user; ?>">
                <li>PC</li>
            </a>
            <a href="?category=TV_set&page=userpage&user=<?php echo $user; ?>">
                <li>TV set</li>
            </a>
            <a href="?category=Watches&page=userpage&user=<?php echo $user; ?>">
                <li>Smart Watches</li>
            </a>
            <a href="?category=Monitors&page=userpage&user=<?php echo $user; ?>">
                <li>Monitors</li>
            </a>
            <a href="?category=Accessories&page=userpage&user=<?php echo $user; ?>">
                <li>Accessories</li>
            </a>

            <a href="?category=Scanners&page=userpage&user=<?php echo $user; ?>">
                <li>Scanners </li>
            </a>
            <a href="?category=Servers&page=userpage&user=<?php echo $user; ?>">
                <li>Servers</li>
            </a>

            <a href="?category=Cameras&page=userpage&user=<?php echo $user; ?>">
                <li>Cameras</li>
            </a>
            <a href="?category=Graphics_cards&page=userpage&user=<?php echo $user; ?>">
                <li>Graphics cards</li>
            </a>
            <a href="?category=Desktops&page=userpage&user=<?php echo $user; ?>">
                <li>Desktops</li>
            </a>
            <a href="?category=Data_Storage&page=userpage&user=<?php echo $user; ?>">
                <li>Data Storage</li>
            </a>
            <a href="?category=Printers&page=userpage&user=<?php echo $user; ?>">
                <li>Printers </li>
            </a>
            <a href="?category=Routers&page=userpage&user=<?php echo $user; ?>">
                <li>Routers </li>
                <a href="?category=Tablets&page=userpage&user=<?php echo $user; ?>">
                    <li>Tablets</li>
                </a>

                <a href="?category=Keyboards&page=userpage&user=<?php echo $user; ?>">
                    <li>Keyboards</li>
                </a>
                <a href="?category=Headphones&page=userpage&user=<?php echo $user; ?>">
                    <li>Headphones</li>
                </a>
                <a href="?category=Mouses&page=userpage&user=<?php echo $user; ?>">
                    <li>Mouses</li>
                </a>
                <a href="?category=Others&page=userpage&user=<?php echo $user; ?>">
                    <li>Others</li>
                </a>
        </div>



    </div>


    <style>
        body {
            position: relative;
        }

        #nav1 a {
            list-style-type: none;
            text-decoration: underline;
        }

        .nav-btn {
            display: none;
        }

        h2 {
            color: rgb(170, 170, 185);
            padding-top: 20px;
        }

        #cart:hover {
            background-color: rgb(10, 201, 218);
        }

        #sale:hover {
            background-color: rgb(10, 201, 218);
        }

        #list:hover {
            background-color: rgb(10, 201, 218);
        }

        .btn-danger:hover {
            background-color: rgb(10, 201, 218);
        }



        .sch {
            margin-left: 100px;
            width: 950px;
            height: 50px;
            margin-top: 20px;
            border-radius: 6px;
            padding-left: 10px;
        }

        .nav {
            display: flex;
            justify-content: center;
            padding-top: 60px;
            gap: 80px;
            font-weight: 800;
            font-size: 20px;
        }

        .nav a:hover {
            color: red;
        }

        #sale {
            background-color: red;
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
            width: 250px;
            height: 35px;
            border: none;
            position: absolute;
            font-size: 16px;
            font-weight: 600;
            right: 310px;
            top: 30px;
        }

        #cart {
            background-color: red;
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
            width: 150px;
            height: 35px;
            border: none;
            position: absolute;
            font-size: 16px;
            font-weight: 600;
            right: 840px;
            top: 30px;
        }

        #list {
            background-color: red;
            border: none;
            width: 200px;
            height: 35px;
            font-weight: 600;
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
            position: absolute;
            top: 30px;
            right: 600px;
            font-size: 16px;
        }

        .butn {
            border: none;
            background-color: white;
        }

        #nav1 {
            position: absolute;
            line-height: 40px;
            top: 350px;
            right: 70px;
            font-weight: 600;
            font-size: 20px;
        }

        #nav1 a:hover {
            color: red;
        }

        .butn img {
            width: 100px;
            height: 55px;
            margin-left: -18px;
            padding-bottom: 5px;
            border-radius: 5px;
        }


        .nav a {
            text-decoration: none;
            color: black;
        }




        @media (max-width: 1030px) {

            #sale {
                background-color: red;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                width: 190px;
                height: 30px;
                border: none;
                position: absolute;
                font-size: 14px;
                font-weight: 600;
                right: 110px;
                top: 30px
            }

            #cart {
                background-color: red;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                width: 120px;
                height: 30px;
                border: none;
                position: absolute;
                font-size: 14px;
                font-weight: 600;
                right: 470px;
                top: 30px
            }

            #list {
                background-color: red;
                border: none;
                width: 150px;
                height: 30px;
                font-weight: 600;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                position: absolute;
                top: 30px;
                right: 310px;
                font-size: 14px;
            }

            strong {
                font-size: 10px;
            }

            h2 {
                padding-left: 120px;
                font-size: 12px;
            }

            p {
                padding-left: 120px;
                font-size: 12px;
            }

            .sch {
                margin-left: 100px;
                width: 600px;
                height: 50px;
                margin-top: 20px;
                border-radius: 6px;
                padding-left: 10px;
            }

            .nav {

                padding-top: 60px;
                gap: 30px;
                font-weight: 800;
                font-size: 16px;
            }

            #nav1 {
                display: none;
            }

            .drop:hover #nav1 {
                width: 200px;
                display: block;
                position: absolute;
                background-color: white;
                left: 110px;
                top: 280px;
            }

            .nav-btn {
                padding-inline: 10px;
                border: none;
                background-color: blue;
                color: white;
                font-size: 2em;
                display: block;
                cursor: pointer;
                border-radius: 10px;
                margin-top: 20px;
            }
        }

        @media (max-width: 820px) {

            #sale {
                background-color: red;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                width: 160px;
                height: 30px;
                border: none;
                position: absolute;
                font-size: 11px;
                font-weight: 600;
                right: 55px;
                top: 30px
            }

            #cart {
                background-color: red;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                width: 100px;
                height: 30px;
                border: none;
                position: absolute;
                font-size: 11px;
                font-weight: 600;
                right: 375px;
                top: 30px
            }

            #list {
                background-color: red;
                border: none;
                width: 120px;
                height: 30px;
                font-weight: 600;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                position: absolute;
                top: 30px;
                right: 235px;
                font-size: 11px;
            }

            strong {
                font-size: 10px;
            }

            h2 {
                padding-left: 120px;
                font-size: 12px;
            }

            p {
                padding-left: 120px;
                font-size: 12px;
            }

            .sch {
                margin-left: 150px;
                width: 450px;
                height: 50px;
                margin-top: 20px;
                border-radius: 6px;
                padding-left: 10px;
            }

            .drop:hover #nav1 {
                width: 100px;
                display: block;
                position: absolute;
                background-color: white;
                left: 70px;
                top: 190px;
                font-size: 16px;
                line-height: 30px;

            }

            #nav1 {
                display: none;
            }



            .nav {
                display: none;

            }

            .nav-btn {
                padding-inline: 10px;
                border: none;
                background-color: blue;
                color: white;
                font-size: 1.5em;
                display: block;
                cursor: pointer;
                border-radius: 10px;
                margin-top: 10px;
                margin-left: 45px;
            }
        }

        @media (max-width: 600px) {
            #sale {
                background-color: red;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                width: 120px;
                height: 25px;
                border: none;
                position: absolute;
                font-size: 6px;
                font-weight: 600;
                right: 30px;
                top: 25px
            }

            #cart {
                background-color: red;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                width: 60px;
                height: 25px;
                border: none;
                position: absolute;
                font-size: 6px;
                font-weight: 600;
                right: 30px;
                top: 85px
            }

            #list {
                background-color: red;
                border: none;
                width: 80px;
                height: 25px;
                font-weight: 600;
                box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
                position: absolute;
                top: 55px;
                right: 30px;
                font-size: 6px;
            }

            strong {
                font-size: 10px;
            }

            h2 {
                padding-left: 120px;
                font-size: 12px;
            }

            p {
                padding-left: 120px;
                font-size: 12px;
            }


            .sch {
                margin-left: 120px;
                width: 200px;
                height: 30px;
                margin-top: 50px;
                border-radius: 6px;
                padding-left: 10px;
            }


            #nav1 {
                display: none;
            }



            .butn img {
                width: 50px;
                height: 35px;
                margin-left: -18px;
                padding-bottom: 5px;
                border-radius: 5px;
            }

            .nav-btn {
                padding-inline: 10px;
                border: none;
                background-color: blue;
                color: white;
                font-size: 1em;
                display: block;
                cursor: pointer;
                border-radius: 10px;
                margin-top: 10px;
                margin-left: 45px;
            }

            .drop:hover #nav1 {
                width: 100px;
                display: block;
                position: absolute;
                background-color: white;
                left: 45px;
                top: 210px;
                font-size: 12px;
                line-height: 20px;

            }

            .nav {
                display: none;

            }
        }

        @media (max-width: 420px) {
            strong {
                font-size: 10px;
            }

            h2 {
                padding-left: 120px;
                font-size: 12px;
            }

            p {
                padding-left: 120px;
                font-size: 12px;
            }

            .sch {
                margin-left: 120px;
                width: 200px;
                height: 30px;
                margin-top: 50px;
                border-radius: 6px;
                padding-left: 10px;
            }

            #nav1 {
                display: none;
            }



            .butn img {
                width: 50px;
                height: 35px;
                margin-left: -18px;
                padding-bottom: 5px;
                border-radius: 5px;
            }

            .nav {
                display: none;

            }
        }
    </style>
</header>

<script>
    function submitForm(event) {
        event.preventDefault();

        var searchValue = encodeURIComponent(document.querySelector('input[name="search"]').value);
        var url = 'index.php?page=userpage&user=<?= $user ?>&search=' + searchValue;
        window.location.href = url;
    }
</script>