<?php

$user = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] && isset($_GET['user']) ? $_GET['user'] : '';


?>
<section class="form-signin w-100 m-auto"> <a href="?page=userpage&user=<?php echo $user; ?>" class="btn btn-warning">Back to list</a>
    <form action="?page=addnew&user=<?php echo $user; ?>" method="post">
        <h1 class="h3 mb-3 mt-3"> Sale form </h1>

        <div class="form-floating">
            <input type="text" class="form-control" name="title" id="floatingInput">
            <label for="floatingInput"> title</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="price" id="floatingInput">
            <label for="floatingInput"> price</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="image" id="floatingInput">
            <label for="floatingInput"> image</label>
        </div>
        <div class="form-floating">
            <select class="form-select" name="category" id="floatingInput">
                <option value=""></option>
                <option value="laptops">Laptops</option>
                <option value="smartphones">Smartphones</option>
                <option value="pc">PC</option>
                <option value="tv_set">TV set</option>
                <option value="watches">Smart Watches</option>
                <option value="monitors">Monitors</option>
                <option value="accessories">Accessories</option>
                <option value="scanners">Scanners</option>
                <option value="servers">Servers</option>
                <option value="cameras">Cameras</option>
                <option value="graphic_cards">Graphic cards</option>
                <option value="desktops">Desktops</option>
                <option value="data_storage">Data Storage</option>
                <option value="printers">Printers</option>
                <option value="routers">Routers</option>
                <option value="tablets">Tablets</option>
                <option value="keyboards">Keyboards</option>
                <option value="headphones">Headphones</option>
                <option value="mouses">Mouses</option>
                <option value="others">Others</option>

            </select>
            <label for="floatingInput">category</label>
        </div>

        <div class="form-floating">
            <input type="text" class="form-control" name="info" id="floatingInput">
            <label for="floatingInput"> info</label>
        </div>

        <div class="form-floating">
            <input type="text" class="form-control" name="username" id="floatingInput">
            <label for="floatingInput"> username</label>
        </div>

        <div class="form-floating">
            <input type="number" class="form-control" name="quantity" min="0" value="1">
            <label for="floatingInput"> quantity</label>
        </div>
        <div class="form-floating">
            <input type="number" class="form-control" name="discount" min="0" value="0">
            <label for="floatingInput"> discount</label>
        </div>



        <button class="btn btn-danger " type="submit">Confirm</button>
    </form>
</section>
<style>
    #floatingInput {
        width: 700px;
        margin: 10px;
    }

    section {
        padding-bottom: 50px;
    }

    h1 {
        padding-top: 20px;
    }

    .btn-warning {
        margin-top: 10px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
    }

    .btn-danger {

        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        width: 100px;
        margin-left: 10px;
    }

    .form-floating input[type="number"] {
        margin: 10px;
        width: 300px;
    }
</style>