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

        $stmt = $pdo->prepare("SELECT * FROM usercard WHERE user = ? AND item_id = ?");
        $stmt->execute([$user, $itemId]);
        $existingItem = $stmt->fetch();

        if (!$existingItem) {

            $insertStmt = $pdo->prepare("INSERT INTO usercard (user, image, title, item_id, price, quantity, discount) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insertStmt->execute([$user, $image, $title, $itemId, $price, $quan, $disc]);
        } else {

            echo "";
        }
        $pdo = null;
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

<a href="?page=userpage&user=<?php echo urlencode($user); ?>" class="btn btn-warning">Back to list</a>



   

<section>
    <div class="rez">
        <div class="cart1"></div>
        <div class="cart2"></div>
    </div>

</section>


<script>
    const item1 = document.querySelector(".cart1");
    const cart = document.querySelector("#cart");
    const goods = document.querySelector(".prek");

    item1.innerHTML += `<div class="pr"><p>Shopping Cart</p></div>
<div class="prek"></div>`;
    

    let totalPrice = 0.00;
    const userItems = <?php echo $userItemsJSON; ?>;
    console.log(userItems);
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
            html += `
     <div id="prek1">
     
      <img src="${image}" alt="item">
      <div id="name"><p id="title">Id:${itemId} </p><p id="title5"> ${title} </p></div>
      <div class="page">

      <button id="minus${i}" onclick="itemQuantityM(${i},${pric})">-</button> 
      <button id="qt" class="qty${i}">${quantity}</button> 
      <button id="plus${i}" onclick="itemQuantityP(${i},${pric})">+</button></div>
    
      <div id="price1"><p id="price">€ ${pric}</p><p id="price2">Price per item</p></div>
     
      <div id="title4"style=" ${discDisplayStyle}">-${disc}%</div>
     
      <button id="p"onclick="delItem(event)">Del</button> 
      
     </div><hr> `;

        };

        document.querySelector(".prek").innerHTML = html;
    }

    showList();

    function delItem(e) {
        const deletedItem = e.target.parentElement;
        const items = document.querySelectorAll("#prek1");
        const index = Array.from(items).indexOf(deletedItem);

        const item_id = userItems[index].item_id;

        deletedItem.remove();
        const deletedPrice = userItems[index].price;
        totalPrice -= deletedPrice;
        updateTotalPrice();

        quantities.splice(index, 1);
        userItems.splice(index, 1);

        const user = "<?php echo $user ?>";
        const params = `user=${user}&item_id=${item_id}`;
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '?page=delete_carditem', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Item deleted from database');
            } else {
                console.log('Error deleting item');
            }
        };
        xhr.send(params);
    }

    const d = [" ", 5, 8, 0];

    const item2 = document.querySelector(".cart2");

    item2.innerHTML += `<div class="forms">
<div class="sp1"><h2>Summary :</h2> <p id="total">€0.00</p> </div>
<h4 class="ship">Delivery </h4><div class="input-group">
<select class="form-select" id="inputGroupSelect04"
 aria-label="Example select with button addon" onchange="updateTotalPrice()">

  <option value="1">${d[0]} </option>
  <option value="2">DPD express - €${d[1]}.00 </option>
  <option value="3">Parcel pickup - €${d[2]}.00 </option>
  <option value="4">Standart Delivery - €${d[3]}.00 </option>
</select>

</div><h4 class="giv">Promocode -15%</h4>
<input class="code2"type="text" placeholder="Enter your promocode" onchange="updateTotalPrice()">
<div class="sp"><p class"ice">TOTAL PRICE :</p><p id="total1">€0.00</p></div>
 <button id="submitBtn" class="btn btn-secondary">Go to payment</button>`;

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
        document.getElementById("total1").textContent = `€${totalWithDlv}`;
        document.getElementById("total").textContent = `€${totalPrice}`;
        const discountInput = document.querySelector(".code2").value;

        if (discountInput === 'goba') {
            const totalWithDsc = Math.round((totalWithDlv / 100) * 85);
            document.querySelector("#total1").textContent = `€${totalWithDsc}`;
        }
    }

    updateTotalPrice();
</script>

<style>
    .rez {
        margin-top: 120px;
        display: flex;
        width: 1100px;
        height: 670px;
        border: none;
        background-color: rgb(216, 216, 216);
        border-radius: 20px;
        box-shadow: 5px 5px 20px 1px #888383;
        margin-bottom: 100px;
        margin-left: 120px;
    }

    #p {
        font-size: 11px;
        color: white;
        background-color: blue;
        height: 15px;
        width: 30px;
        margin-right: -30px;
        border: none;
        border-radius: 6px;
        margin-top: 15px;
        font-weight: 500;
    }

    #title4 {
        font-weight: 900;
        font-size: 14px;
        color: red;
        padding-top: 13px
    }

    #title5 {
        width: 180px;
        font-weight: 600;
        height: 20px;
    }

    .btn-secondary {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-left: 75px;
        margin-top: 85px;
        width: 150px;
    }

    .btn-warning {
        box-shadow: 5px 5px 10px 1px rgb(194, 194, 205);
        margin-top: 10px;
    }

    .cart1 {
        width: 70%;
        background-color: rgb(252, 252, 252);
        border-top-left-radius: 20px;
        border-bottom-left-radius: 20px;
    }

    .cart1 p {
        font-size: 30px;
        font-weight: 900;
        padding-left: 40px;

        padding-bottom: 20px;
        letter-spacing: 1px;
    }

    #prek1 {
        display: flex;
        justify-content: space-around;
        gap: 20px;
        height: 70px;
        margin-right: 30px;
        margin-left: 30px;
        align-items: center;
    }


    #prek1 img {
        margin-top: 10px;
        padding-top: 10px;
        width: 60px;
        height: 50px;
    }


    .prek {

        margin-top: 8px;
        margin-left: 40px;
        margin-right: 40px;
    }

    .pr {
        padding-top: 10px;
        display: flex;
        justify-content: space-between;
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



    .page {
        padding-right: 10px;
        display: flex;
        width: 20px;
        height: 20px;
    }

    .page button {
        background-color: white;
        color: black;
        font-size: 20px;
        border: none;
    }

    #price1 {
        margin: 0;
        margin-left: 50px;
        display: block;
        padding-top: 45px;
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

    #name {

        padding-bottom: 15px;

    }

    #name p {
        margin: 0;
        padding: 0;
        font-size: 12px;

    }

    #title {
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
        padding-top: 2px;
        color: red;
        padding-left: 15px;
    }

    .forms span {
        padding: 0;
    }

    #total1 {
        color: red;
        padding-left: 15px;
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

    .code2 {
        border-radius: 5px;
        margin-top: 10px;
        width: 205px;
        height: 40px;
        border: none;
    }

    .ice {
        width: 120px;
    }

    .sp {
        display: flex;
        padding-top: 50px;
        padding-left: 5px;
        font-weight: 700;
        font-size: 18px;
    }

    .code2::placeholder {
        padding-left: 10px;
        font-weight: 600;
        color: #c1b8b8;
    }

    .sp1 {
        padding-top: 53px;
        display: flex;

        font-weight: 700;
        font-size: 19px;
    }

    .ship {
        margin: 0;
        padding-bottom: 15px;
        padding-top: 5px;
    }

    .giv {
        padding-top: 20px;
    }
</style>


<script>
    document.getElementById('submitBtn').addEventListener('click', function() {
        if (confirm('Go to payment?')) {

            const user = "<?php echo $user ?>";
            window.location.href = `?page=buy&user=${encodeURIComponent(user)}&executeScript=true`;

        } else {
            return false;
        }
    });
</script>
