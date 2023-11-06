<header>

    <a href="?page=login" class="btn btn-primary " type="submit">LOGIN</a>
    <a href="?page=account" class="btn btn-primary">SIGN UP </a>


    <form method="GET" action="index.php">
        <input type="text" name="search" class="sch" placeholder="Search">
        <button type="submit" class="butn">
            <img src="https://t3.ftcdn.net/jpg/05/58/77/36/360_F_558773631_30k5dNuPMstknR40YiWytQQsk4NJaE3j.jpg" alt=""></button>
    </form>

    <div class="nav">

        <a href="?category=Laptops">
            <li>Laptops</li>
        </a>
        <a href="?category=Smartphones">
            <li>Smartphones</li>
        </a>
        <a href="?category=PC">
            <li>PC</li>
        </a>
        <a href="?category=TV_set">
            <li>TV set</li>
        </a>
        <a href="?category=Watches">
            <li>Smart Watches</li>
        </a>
        <a href="?category=Monitors">
            <li>Monitors</li>
        </a>
        <a href="?category=Accessories">
            <li>Accessories</li>
        </a>
        <a href="?category=Cameras">
            <li>Cameras</li>
        </a>

    </div>



    <div class="drop">

        <button class="nav-btn">&#9776</button>

        <div id="nav1">


            <a href="?category=Laptops">
                <li>Laptops</li>
            </a>
            <a href="?category=Smartphones">
                <li>Smartphones</li>
            </a>
            <a href="?category=PC">
                <li>PC</li>
            </a>
            <a href="?category=TV_set">
                <li>TV set</li>
            </a>
            <a href="?category=Watches">
                <li>Smart Watches</li>
            </a>
            <a href="?category=Monitors">
                <li>Monitors</li>
            </a>
            <a href="?category=Accessories">
                <li>Accessories</li>
            </a>

            <a href="?category=Scanners">
                <li>Scanners </li>
            </a>
            <a href="?category=Servers">
                <li>Servers</li>
            </a>

            <a href="?category=Cameras">
                <li>Cameras</li>
            </a>
            <a href="?category=Graphics_cards">
                <li>Graphics cards</li>
            </a>
            <a href="?category=Desktops&user=">
                <li>Desktops</li>
            </a>
            <a href="?category=Data_Storage">
                <li>Data Storage</li>
            </a>
            <a href="?category=Printers">
                <li>Printers </li>
            </a>
            <a href="?category=Routers">
                <li>Routers </li>
                <a href="?category=Tablets">
                    <li>Tablets</li>
                </a>

                <a href="?category=Keyboards">
                    <li>Keyboards</li>
                </a>
                <a href="?category=Headphones">
                    <li>Headphones</li>
                </a>
                <a href="?category=Mouses">
                    <li>Mouses</li>
                </a>
                <a href="?category=Others">
                    <li>Others</li>
                </a>
        </div>



    </div>




    <style>
        body {
            position: relative;
        }

        .nav-btn {
            display: none;
        }

        #nav1 a {
            list-style-type: none;
            text-decoration: underline;
        }

        h2 {
            color: rgb(170, 170, 185);
            padding-top: 20px;
        }

        .btn-primary {
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
            width: 110px;
            height: 35px;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-left: 50px;
        }

        .btn-primary:hover {
            background-color: rgb(230, 255, 0);
            color: black;
        }

        .sch {
            margin-left: 100px;
            width: 900px;
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
            box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
            width: 250px;
            height: 35px;
            border: none;
            position: absolute;
            font-size: 16px;
            font-weight: 600;
            right: 320px;
            top: 30px
        }

        .butn {
            border: none;
            background-color: white;
        }

        #nav1 {
            position: absolute;
            line-height: 40px;
            top: 300px;
            right: 70px;
            font-weight: 600;
            font-size: 20px;
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

            .sch {
                margin-left: 100px;
                width: 500px;
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

            .btn-primary {

                width: 100px;
                height: 35px;
                margin-top: 20px;
                font-size: 14px;
                font-weight: 600;
                margin-left: 150px;
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

            .sch {
                margin-left: 120px;
                width: 200px;
                height: 30px;
                margin-top: 20px;
                border-radius: 6px;
                padding-left: 10px;
            }


            #nav1 {
                display: none;
            }

            .btn-primary {

                width: 55px;
                height: 25px;
                margin-top: 20px;
                font-size: 7px;
                font-weight: 600;
                margin-left: 120px;
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
                top: 150px;
                font-size: 12px;
                line-height: 20px;

            }

            .nav {
                display: none;

            }
        }

        @media (max-width: 420px) {

            .sch {
                margin-left: 120px;
                width: 200px;
                height: 30px;
                margin-top: 20px;
                border-radius: 6px;
                padding-left: 10px;
            }

            #nav1 {
                display: none;
            }

            .btn-primary {

                width: 55px;
                height: 25px;
                margin-top: 20px;
                font-size: 7px;
                font-weight: 600;
                margin-left: 120px;
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