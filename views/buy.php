<?php
require_once('db.php');

if (isset($_GET['user'], $_GET['image'], $_GET['title'], $_GET['item_id'], $_GET['price'], $_GET['quantity'], $_GET['discount'])) {

    $user = $_GET['user'];
    $image = $_GET['image'];
    $title = $_GET['title'];
    $itemId = $_GET['item_id'];
    $price = $_GET['price'];
    $quan = $_GET['quantity'];
    $disc = $_GET['discount'];

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>

<?php


if (isset($_GET['user'])) {
    $user = $_GET['user'];

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT * FROM usercard WHERE user = ?");
        $stmt->execute([$user]);
        $userItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}

$userItemsJSON = json_encode($userItems);
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $country = $_POST['country'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $pay = $_POST['payment'];

    if (
        empty($fname) or empty($lname) or empty($country) or empty($address)
        or empty($city) or empty($postcode) or empty($email) or empty($mobile) or empty($pay)
    ) {
        echo "<h1 style='color: red;'>Fill in all the fields </h1>";
    } else {

        $sql1 = "INSERT INTO `deliveryinfo` (firstname,lastname,country,address,city,postcode,email,mobile,payment_method) 
    VALUES ('$fname', '$lname', '$country','$address', '$city','$postcode','$email','$mobile','$pay')";

        if ($conn->query($sql1)) {
            echo "<h3 style='color: rgb(71, 220, 34);margin-left:15px;'>You successfully complete delivery form !</br>Proceed with payment now</h3>";
        }
    }
}
?>

<section class="form-signin w-100 m-auto">
    <a href="?page=userpage&user=<?php echo urlencode($user); ?>" class="btn btn-warning">Back to list</a>

    <form method="post">

        <h1 class="h3 mb-3 mt-3 "> Delivery form </h1>

        <div id="inp1">
            <div class="form-floating">
                <input type="text" class="form-control" name="firstname" id="floatingInput">
                <label for="floatingInput"> firstname</label>
            </div>
            <div class="form-floating">
                <input type="text" class="form-control" name="lastname" id="floatingInput">
                <label for="floatingInput"> lastname</label>
            </div>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" name="country" id="floatingInput">
            <label for="floatingInput"> country</label>
            <div class="form-floating">
                <input type="text" class="form-control" name="address" id="floatingInput">
                <label for="floatingInput"> address</label>
            </div>

            <div id="inp3">
                <div class="form-floating">
                    <input type="text" class="form-control" name="city" id="floatingInput">
                    <label for="floatingInput"> city</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="postcode" id="floatingInput">
                    <label for="floatingInput"> postcode</label>
                </div>
            </div>
            <div id="inp2">
                <div class="form-floating">
                    <input type="email" class="form-control" name="email" id="floatingInput">
                    <label for="floatingInput"> email</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" name="mobile" id="floatingInput">
                    <label for="floatingInput"> mobile</label>
                </div>

            </div>

            <div class="form-floating">
                <select class="form-select" name="payment" id="floatingInput">
                    <option value=""></option>
                    <option value="credit_card">Credit or Debit Cards</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfers</option>
                    <option value="cash_on_delivery ">Cash on Delivery</option>
                </select>
                <label for="floatingInput">Payment Methods</label>
            </div>

            <button id="done" class="btn btn-danger" type="submit" onclick="return confirm('Submit delivery form?');">Done</button>
    </form>
</section>
<style>
    #floatingInput {
        width: 500px;
        margin: 10px;
    }

    .h3 {
        margin-left: 10px;
    }

    section {
        padding-bottom: 40px;
    }

    #inp1 {
        display: flex;
    }

    #inp2 {
        display: flex;
    }

    #inp3 {
        display: flex;
    }

    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-top: 10px;
        margin-left: 10px;
    }

    .btn-danger {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        width: 100px;
        margin-left: 10px;
    }

    strong {
        text-decoration: underline;
        color: red;
        font-size: 16px;
        padding-left: 15px;
    }
</style>
<strong>IMPORTANT !!! You must fill out this delivery form first.</strong>
<section>
    <div class="rez">
        <div class="cart1"> </div>
        <div class="cart2"></div>
    </div>

</section>


<script>
    const item1 = document.querySelector(".cart1");
    const cart = document.querySelector("#cart");
    const goods = document.querySelector(".prek");

    item1.innerHTML += `<div class="pr"></div><div class="prek"></div>`;

    let totalPrice = 0.00;

    function showList() {
        let html = "";


        for (let i = 0; i < 1; i++) {

            <?php if ($disc > 0) : ?>
                let price = <?php echo round($price - ($disc / 100 * $price)); ?>;
            <?php else : ?>
                let price = <?php echo round($price) ?>;
            <?php endif; ?>
            totalPrice += price;
            html += `
     <div id="prek1">
      <img src="<?php echo $image; ?>"  alt="">
      <div id="name"><p id="title">Id:<?php echo $itemId; ?></p><p id="title5"><?php echo $title; ?></p></div>
      <div class="page">

      <?php if ($disc > 0) : ?>
      <button id="minus${i}" onclick="itemQuantityM(${i}, <?php echo round($price - ($disc / 100 * $price)); ?>)">-</button> 
      <button id="qt" class="qty">1</button> 
      <button id="plus${i}" onclick="itemQuantityP(${i},<?php echo round($price - ($disc / 100 * $price)); ?>)">+</button></div>
      <?php else : ?>
      <button id="minus${i}" onclick="itemQuantityM(${i},<?php echo round($price) ?>)">-</button> 
      <button id="qt" class="qty">1</button> 
      <button id="plus${i}" onclick="itemQuantityP(${i},<?php echo round($price) ?>)">+</button></div>
      <?php endif; ?>
      <div id="price1"><p id="price">€<?php echo $price; ?> </p><p id="price2">Price per item</p></div>
      
      <?php if ($disc > 0) : ?>
      <div id="title4">-<?php echo $disc; ?>%</div>
      <?php endif; ?>
     
      <button id="p1">
      <img src="https://c8.alamy.com/comp/HY1G0F/colorful-star-symbol-vector-illustration-design-abstract-concept-HY1G0F.jpg"id="img" alt="logo">
      </button>
      
     </div><hr>`;

            document.querySelector(".prek").innerHTML = html;
        }
    }
    showList();


    const d = [" ", 5, 8, 0];
    const item2 = document.querySelector(".cart2");

    item2.innerHTML += `<div class="forms">
<div class="sp1"><h2>Summary :</h2> <p id="total">€0.00</p> </div>
<h4 class="ship">Delivery </h4><div class="input-group" ><label id="d">Required field</label>
<select class="form-select" id="inputGroupSelect04" onchange="updateTotalPrice()">

  <option value="1">${d[0]} </option>
  <option value="2">DPD express - €${d[1]}.00 </option>
  <option value="3">Parcel pickup - €${d[2]}.00 </option>
  <option value="4">Standart Delivery - €${d[3]}.00 </option>
</select>

</div>
<h4 class="giv">Promocode -15%</h4>
<input id="code2"type="text" placeholder="Enter your promocode" onchange="updateTotalPrice()">
<div class="sp"><p id="ice">SUBTOTAL :</p><p id="total1">€0.00</p></div> </div>`;


    const cd = document.querySelector(".code2");

    let pq = 1;

    function itemQuantityP(index, price) {
        let q = document.querySelector(`.qty`);
        let prev = document.querySelector(`#minus${index}`);

        pq++;
        q.innerText = pq;

        if (pq > 0) {
            prev.removeAttribute("disabled");
        }

        totalPrice += price;
        updateTotalPrice();
    }

    function itemQuantityM(index, price) {
        let q = document.querySelector(`.qty`);
        let prev = document.querySelector(`#minus${index}`);

        if (pq > 0) {
            pq--;
            q.innerText = pq;
        }
        if (pq === 0) {
            prev.setAttribute("disabled", true);
        }

        totalPrice -= price;
        updateTotalPrice();
    }

    function calcTotalPrice(q) {
        const delivCost = d[q];
        const totalWithDlv = totalPrice + delivCost;
        return totalWithDlv;
    }


    function updateTotalPrice() {
        const ind = document.getElementById("inputGroupSelect04").selectedIndex;
        const totalWithDlv = calcTotalPrice(ind);
        const total1 = document.getElementById("total1");
        const totalPriceInput = document.getElementById("total_price");
        document.getElementById("total").textContent = `€${totalPrice}`;
        const quantityValue = document.querySelector(".qty").textContent;

        total1.textContent = `€${totalWithDlv}`;
        totalPriceInput.value = totalWithDlv;
        document.getElementById("quantity").value = quantityValue;
        const discountInput = document.querySelector("#code2").value;
        document.getElementById("delivery").value = d[ind];

        if (discountInput === 'goba') {
            const totalWithDsc = Math.round((totalWithDlv / 100) * 85);
            document.querySelector("#total1").textContent = `€${totalWithDsc}`;
            totalPriceInput.value = totalWithDsc;
        }
    }

    updateTotalPrice();
</script>

<style>
    .rez {
        margin-top: 70px;
        display: flex;
        width: 1020px;
        height: 440px;
        border: none;
        background-color: rgba(240, 240, 240, 0.826);
        border-radius: 20px;
        margin-left: 20px;
    }

    #p {
        background-color: rgba(246, 247, 247, 0.826);
        height: 15px;
        width: 30px;
        margin-right: -30px;
        border: none;
        margin-top: 15px;
    }

    #p img {
        border-radius: 20px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        width: 26px;
    }

    #p1 {
        background-color: rgba(246, 247, 247, 0.826);

        width: 30px;
        margin-right: -30px;
        border: none;
        ;
    }

    #p1 #img {
        border-radius: 20px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        width: 30px;
        height: 30px;
    }

    #d {
        font-size: 10px;
        color: rgba(140, 140, 140, 0.826);
    }

    .btn-danger {
        margin-top: 10px;
    }

    #title4 {
        font-weight: 900;
        font-size: 12px;
        color: red;
        padding-top: 15px;


    }

    #price1 {
        margin: 0;
        padding-left: 50px;
        display: block;
        height: 0px;
        padding-bottom: 12px;
    }

    #price {
        font-weight: 800;
        font-size: 18px;
        padding: 0;
        margin: 0;
    }

    #price2 {
        margin: 0;
        font-size: 12px;
        padding: 0;
        font-weight: 700;
    }

    #title5 {
        width: 180px;
        font-weight: 600;
        height: 20px;
    }



    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-top: 10px;
    }

    .cart1 {
        width: 70%;
        background-color: rgba(246, 247, 247, 0.826);
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }



    #prek1 {
        display: flex;
        justify-content: space-around;
        gap: 15px;
        height: 60px;
        margin-left: 30px;
        margin-right: 30px;
        align-items: center;
    }

    #prek2 {
        padding-bottom: 10px;
        display: flex;
        justify-content: space-around;
        gap: 15px;
        height: 45px;
        margin-left: 30px;
        margin-right: 30px;
        align-items: center;
    }

    #prek1 img {
        padding-top: 5px;
        margin-top: 18px;
        width: 70px;
        height: 50px;
    }


    .prek {


        margin-left: 40px;
        margin-right: 40px;
    }

    .pr {
        padding-top: 70px;
        display: flex;
        justify-content: space-between;
    }

    .pr1 {
        padding-top: 40px;
        display: flex;
        justify-content: space-between;
    }

    span {
        padding-right: 45px;
        padding-top: 40px;
        font-size: 18px;
        font-weight: 900;
        letter-spacing: 1px;
    }

    #back {
        padding-left: 46px;
        padding-top: 10px;
        gap: 5px;
        font-size: 18px;
        font-weight: 700;

        color: grey;
    }


    a {
        display: flex;
        text-decoration: none;
    }

    #btn {
        display: flex;
    }

    #i {
        margin-top: 10px;
        padding-top: 10px;
        width: 60px;
        height: 50px;
    }

    .page {
        display: flex;
        width: 20px;
        height: 20px;
    }

    .page button {
        background-color: rgba(246, 247, 247, 0.826);
        color: black;
        font-size: 20px;
        border: none;
    }

    #price5 {
        font-size: 18px;
        padding-top: 52px;
        margin-left: 20px;
    }

    #name p {
        margin: 0;
        padding: 0;
        font-size: 12px;

    }

    #title {
        font-weight: 900;
        color: blue;
        width: 150px;
        height: 20px;
    }

    #category {
        color: #888383;
    }

    #qt {

        font-weight: 700;
    }

    #plus {
        padding-top: 2px;
        font-weight: 600;
    }

    #minus {
        font-weight: 600;
    }

    ***************************************** .cart2 {
        display: block;
    }

    .forms {
        width: 260px;
        padding-left: 30px;
        padding-top: 60px;
    }

    .forms h2 {
        padding-bottom: 15px;
        font-size: 24px;
    }

    #total {
        padding-top: 3px;
        color: red;
        padding-left: 15px;
    }

    .forms span {
        padding: 0;
    }

    #total1 {
        margin-bottom: 2px;
        color: red;
        padding-left: 10px;
    }

    #cout {
        margin-top: 25px;
        width: 310px;
        border: none;
        background-color: black;
        color: white;
        height: 35px;
        border-radius: 2px;
    }

    #inputGroupSelect04 {
        width: 310px;
        height: 40px;
        font-size: 16px;
        font-weight: 700;
        padding-left: 10px;
        border: 1px solid #d7d0d0;
    }

    #code2 {
        border-radius: 5px;
        margin-top: 10px;
        width: 205px;
        height: 40px;
        border: none;
    }

    #ice {
        font-size: 18px;
        width: 120px;
        color: grey;
    }

    .sp {
        display: flex;
        padding-top: 40px;
        padding-left: 5px;
        font-weight: 700;
        font-size: 18px;
    }

    #code2::placeholder {
        padding-left: 10px;
        font-weight: 600;
        color: #c1b8b8;
    }

    .sp1 {
        display: flex;
        color: grey;
        font-weight: 700;
        font-size: 19px;
    }

    .ship {
        color: grey;
        margin: 0;
        padding-bottom: 1px;
        padding-top: 5px;
    }

    .giv {
        color: grey;
        padding-top: 20px;
    }

    .btn-secondary {
        width: 202px;
        margin-left: 5px;
        height: 35px;
    }

    .btn-success {
        width: 150px;
        height: 40px;
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-left: 880px;
        margin-bottom: 20px;
    }

    .btn-success:hover {
        background-color: blue;
        color: white;
    }
</style>


<form action="?page=confirmpayment&user=<?php echo urlencode($user); ?>" method="post" id="final">
    <input type="hidden" name="quantity" id="quantity" value="">
    <input type="hidden" name="total_price" id="total_price" value="">
    <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
    <input type="hidden" name="user" value="<?php echo $user; ?>">
    <input type="hidden" name="iprice" value="<?php echo $price ?> ">
    <input type="hidden" name="delivery" id="delivery" value="">
    <button type="submit" id="hide1" class="btn btn-success">Submit payment</button>
</form>
<a href="?page=admin&user=<?php echo $user; ?>" class="btn btn-success" onclick="onSubmit(event)" id="hide8">Submit payment</a>




<script>
    const urlParams = new URLSearchParams(window.location.search);
    const executeScript = urlParams.get('executeScript');

    var subbtn1 = document.getElementById('hide8');
    if (subbtn1) {
        subbtn1.style.display = 'none';
    }


    if (executeScript === 'true') {


        const item1 = document.querySelector(".cart1");
        const cart = document.querySelector("#cart");
        const goods = document.querySelector(".prek");

        item1.innerHTML += `<div class="pr1"></div><div class="prek"></div>`;


        let totalPrice = 0.00;
        const userItems = <?php echo $userItemsJSON; ?>;

        let quantities = [];

        function showList() {

            let html = "";


            const maxItems = 5;
            const itemsCount = userItems.length > maxItems ? maxItems : userItems.length;

            for (let i = 0; i < itemsCount; i++) {

                const currentItem = userItems[i];

                const title = currentItem.title;
                const image = currentItem.image;
                const itemId = currentItem.item_id;
                let pric = currentItem.price;
                const disc = currentItem.discount;
                let quantity = quantities[i] ? quantities[i] : 1;
                const discDisplayStyle = disc === 0 ? 'opacity:0;' : '';

                if (disc > 0) {
                    pric = Math.round(pric - (disc / 100 * pric));
                } else {
                    pric = Math.round(pric);
                }

                totalPrice += pric;
                html += `<div id="prek2">

      <img src="${image}" alt="item"id="i">
      <div id="name"><p id="title">Id:${itemId} </p><p id="title5"> ${title} </p></div>
      <div class="page">

      <button id="minus${i}" onclick="itemQuantityM(${i},${pric})">-</button> 
      <button id="qt" class="qty${i}">${quantity}</button> 
      <button id="plus${i}" onclick="itemQuantityP(${i},${pric})">+</button></div>
    
      <div id="price1"><p id="price">€ ${pric}</p><p id="price2">Price per item</p></div>
     
      <div id="title4"style=" ${discDisplayStyle}">-${disc}%</div>
     
      <button id="p">
      <img src="https://c8.alamy.com/comp/HY1G0F/colorful-star-symbol-vector-illustration-design-abstract-concept-HY1G0F.jpg" alt="logo">
      </button>
      
      </div><hr> `;

            };

            document.querySelector(".prek").innerHTML = html;
        }

        showList();

        const d = [" ", 5, 8, 0];

        const item2 = document.querySelector(".cart2");

        item2.innerHTML += `<div class="forms">
      <div class="sp1"><h2>Summary :</h2> <p id="total">€0.00</p> </div>
      <h4 class="ship">Delivery </h4><div class="input-group"><label id="d">Required field</label>
      <select class="form-select" id="inputGroupSelect04" onchange="updateTotalPrice()">

        <option value="1">${d[0]} </option>
        <option value="2">DPD express - €${d[1]}.00 </option>
        <option value="3">Parcel pickup - €${d[2]}.00 </option>
        <option value="4">Standart Delivery - €${d[3]}.00 </option>
      </select>

      </div><h4 class="giv">Promocode -15%</h4>
      <input id="code2"type="text" placeholder="Enter your promocode" onchange="updateTotalPrice()">
      <div class="sp"><p id="ice">SUBTOTAL :</p><p id="total1">€0.00</p></div>`;

        const cd = document.querySelector(".code2");

        let pq = 1;

        function itemQuantityP(index, price) {
            let q = document.querySelector(`.qty${index}`);
            let prev = document.querySelector(`#minus${index}`);
            let pq = quantities[index] || 1;
            pq++;
            quantities[index] = pq;
            q.textContent = pq;
            if (pq > 0) {
                prev.removeAttribute("disabled");
            }
            totalPrice += price;
            updateTotalPrice();
        }

        function itemQuantityM(index, price) {
            let q = document.querySelector(`.qty${index}`);
            let prev = document.querySelector(`#minus${index}`);

            let pq = quantities[index] || 1;

            if (pq > 1) {
                pq--;

                quantities[index] = pq;
                q.textContent = pq;
            }

            if (pq === 1) {
                prev.setAttribute("disabled", true);
            }

            totalPrice -= price;
            updateTotalPrice();
        }

        function calcTotalPrice(q) {
            const delivCost = d[q];
            const totalWithDlv = totalPrice + delivCost;
            return totalWithDlv;
        }



        function updateTotalPrice() {
            const ind = document.getElementById("inputGroupSelect04").selectedIndex;
            const totalWithDlv = calcTotalPrice(ind);
            const total1 = document.getElementById("total1");
            const totalPriceInput = document.getElementById("total_price");
            document.getElementById("total").textContent = `€${totalPrice}`;


            total1.textContent = `€${totalWithDlv}`;
            totalPriceInput.value = totalWithDlv;

            const discountInput = document.querySelector("#code2").value;
            document.getElementById("delivery").value = d[ind];

            if (discountInput === 'goba') {
                const totalWithDsc = Math.round((totalWithDlv / 100) * 85);
                document.querySelector("#total1").textContent = `€${totalWithDsc}`;
                totalPriceInput.value = totalWithDsc;
            }
        }

        updateTotalPrice();


        function collectItemsData() {
            const userItems = <?php echo $userItemsJSON; ?>;
            const collectedItems = [];
            const deliveryCost = [0, 5, 8, 0];
            const maxItems = 5;
            const itemsCount = userItems.length > maxItems ? maxItems : userItems.length


            for (let i = 0; i < itemsCount; i++) {

                const currentItem = userItems[i];

                const itemId = currentItem.item_id;
                let pric = currentItem.price;
                const disc = currentItem.discount;
                const user = currentItem.user;
                let quantity = quantities[i] ? quantities[i] : 1;

                if (disc > 0) {
                    pric = Math.round(pric - (disc / 100 * pric));
                } else {
                    pric = Math.round(pric);
                }

                const itemData = {
                    itemId: itemId,
                    price: pric,
                    discount: disc,
                    quantity: quantity,
                    user: user,
                    delivery: deliveryCost[document.getElementById("inputGroupSelect04").selectedIndex],
                    totalsum: document.getElementById("total1").textContent
                };

                collectedItems.push(itemData);
            }

            return collectedItems;
        }

        function onSubmit(e) {
            const itemsData = collectItemsData();
            const itemsJSON = JSON.stringify(itemsData);

            const xhr = new XMLHttpRequest();
            const url = '?page=admin&user=<?php echo $user; ?>';

            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-Type', 'application/json');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Duomenys sėkmingai išsiųsti į serverį');
                    } else {

                        console.error('Klaida siunčiant duomenis į serverį');
                    }
                }
            };

            xhr.send(itemsJSON);
        }



        var subbtn = document.getElementById('hide1');
        if (subbtn) {
            subbtn.style.display = 'none';
        }

        var subbtn1 = document.getElementById('hide8');
        if (subbtn1) {
            subbtn1.style.display = 'block';
        }




    }
</script>