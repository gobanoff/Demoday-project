<a href="?page=homepage" class="btn btn-warning">Back to list</a>

<section class="form-signin w-100 m-auto">
    <form action="?page=register" id="form" method="post">
        <h1 class="h3 mb-3 fw-normal">Registration form</h1>
        <div class="form-floating">
            <input type="text" class="form-control" name="user" id="floatingPassword" placeholder="Username">
            <label for="floatingPassword">username</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput"> e-mail</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword"> password</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="repassword" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">repeat password</label>
        </div>
        <button class="btn btn-primary  py-2" type="submit">Create account</button>
    </form>
</section>
<style>
    .form-signin input {
        width: 800px;
        margin-bottom: 10px;
    }

    #form {
        margin-left: 200px;
    }

    .h3 {
        margin-top: 40px;
    }

    section {
        padding-bottom: 290px;
    }

    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-top: 15px;
    }

    .form-signin button {
        width: 800px;
        height: 60px;
        font-size: 25px;
        font-weight: 600;
    }

    label {
        color: #CCC;
    }

    @media (max-width: 1030px) {

        .form-signin input {
            width: 500px;
            margin-bottom: 10px;
        }

        .form-signin button {
            width: 500px;
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

        .form-signin button {
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

        .form-signin button {
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