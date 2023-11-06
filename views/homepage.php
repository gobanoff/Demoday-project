<?php

$db = new PDO("mysql:host=localhost;dbname=amazbay", "root", "");

$info = [];

$itemsPerPage = 12;
$page = isset($_GET['pg']) ? intval($_GET['pg']) : 1;
$category = isset($_GET['category']) ? $_GET['category'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$offset = ($page - 1) * $itemsPerPage;
if ($offset < 0) {
	$offset = 0;
}

if (!empty($search)) {
	$sql = "SELECT * FROM goods WHERE title LIKE :search LIMIT :limit OFFSET :offset";
	$query = $db->prepare($sql);
	$query->bindValue(':search', '%' . $search . '%');
} elseif (!empty($category)) {
	$sql = "SELECT * FROM goods WHERE category = :category LIMIT :limit OFFSET :offset";
	$query = $db->prepare($sql);
	$query->bindParam(':category', $category);
} else {
	$sql = "SELECT * FROM goods LIMIT :limit OFFSET :offset";
	$query = $db->prepare($sql);
}

$query->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
$query->bindParam(':offset', $offset, PDO::PARAM_INT);

if ($query->execute()) {
	$info = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
	print_r($query->errorInfo());
}


$sqlCount = "SELECT COUNT(*) FROM goods";
if (!empty($search)) {
	$sqlCount = "SELECT COUNT(*) FROM goods WHERE title LIKE :search";
	$queryCount = $db->prepare($sqlCount);
	$queryCount->bindValue(':search', '%' . $search . '%');
} else if (!empty($category)) {
	$sqlCount = "SELECT COUNT(*) FROM goods WHERE category = :category";
	$queryCount = $db->prepare($sqlCount);
	$queryCount->bindParam(':category', $category);
} else {
	$queryCount = $db->query($sqlCount);
}
$queryCount->execute();
$totalItems = $queryCount->fetchColumn();
$totalPages = ceil($totalItems / $itemsPerPage);

?>

<body>
	<style>
		.pagin a.current {
			text-decoration: underline;
		}

		.tuve {
			display: grid;
			padding-top: 100px;
			grid-template-columns: 1fr 1fr 1fr 1fr;
			grid-template-rows: 1fr 1fr 1fr;
			gap: 20px;
		}

		.btn-primary:hover {
			background-color: rgb(230, 255, 0);
			color: black;
		}

		.nav a:hover {
			color: rgb(10, 201, 218);
		}

		.sch {
			width: 500px;
			height: 50px;
			margin-top: 50px;
			border-radius: 6px;
			padding-left: 10px;
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

		.pagin {
			display: flex;
			justify-content: center;
			padding-top: 50px;
			gap: 20px;
			font-size: 18px;
			font-weight: 700;
			list-style-type: none;
		}


		.image {
			width: 300px;
		}

		h5 {
			color: rgb(170, 170, 185);
		}

		.pagin a {
			text-decoration: none;
		}

		img {
			height: 150px;
			width: fit-content;
		}

		a {
			text-decoration: none;
		}

		@media (max-width: 1030px) {
			h4 {
				font-size: 18px;
			}

			.tuve {
				width: 900px;

				padding-top: 100px;
				grid-template-columns: repeat(3, 1fr);
				grid-template-rows: repeat(4);
				gap: 10px;
			}



			.image {
				width: 100px;
			}

			img {
				height: 100px;
				width: fit-content;
			}

			a h5 {
				font-size: 12px;
			}
		}

		@media (max-width: 820px) {
			h4 {
				font-size: 16px;
			}

			.tuve {
				width: 768px;

				padding-top: 100px;
				grid-template-columns: 1fr 1fr 1fr;
				grid-template-rows: repeat(4);
				gap: 10px;
			}

			a h5 {
				font-size: 12px;
			}

			img {
				height: 100px;
				width: fit-content;
			}

			.image {
				width: 100px;
			}
		}

		@media (max-width: 600px) {
			h4 {
				font-size: 12px;
			}

			.tuve {
				width: 600px;

				padding-top: 100px;
				grid-template-columns: 1fr 1fr;
				grid-template-rows: repeat(6);
				gap: 20px;
			}

			a h5 {
				font-size: 12px;
			}

			img {
				height: 80px;
				width: fit-content;
			}

			.image {
				height: 150px;
				width: 90px;
			}
		}

		@media (max-width: 420px) {

			h4 {
				font-size: 10px;
			}

			img {
				height: 80px;
				width: fit-content;
			}

			.tuve {
				width: 400px;

				padding-top: 100px;
				grid-template-columns: 1fr 1fr;
				grid-template-rows: repeat(6);
				gap: 1px;
			}

			a h5 {
				font-size: 10px;
			}

			.image {
				height: 150px;
				width: 50px;
			}
		}
	</style>

	<?php
	include './views/include/homeheader.php'
	?>

	<div class="tuve">
		<?php foreach ($info as $data) : ?>
			<a href="?page=item&image=<?php echo urlencode($data['image']); ?>?> &cat=<?php echo urlencode($data['category']); ?>
	    &title=<?php echo urlencode($data['title']); ?>&username=<?php echo urlencode($data['username']); ?>
		&info=<?php echo urlencode($data['info']); ?>&price=<?php echo urlencode($data['price']); ?>
		&item_id=<?php echo urlencode($data['item_id']); ?>&cnt=<?php echo urlencode($data['counter']); ?> 
		&quantity=<?php echo urlencode($data['quantity']); ?>&discount=<?php echo urlencode($data['discount']); ?>
		">

				<div class="image">
					<img src="<?php echo $data['image']; ?>" alt="foto">
					<h5><?php echo $data['title']; ?></h5>
					<h4>€<?php echo $data['price']; ?></h4>
				</div>
			</a>
		<?php endforeach; ?>

	</div>

	<div class="pagin">
		<?php for ($i = 1; $i <= $totalPages; $i++) : ?>
			<?php if (isset($search)) : ?>
				<a href="?search=<?php echo $search; ?>&pg=<?php echo $i; ?>&category=<?php echo $category; ?>" class="<?php echo $i === $page ? 'current' : ''; ?>">
					<?php echo $i; ?>
				</a>
			<?php elseif (isset($category)) : ?>
				<a href="?category=<?php echo $category; ?>&pg=<?php echo $i; ?>&search=<?php echo $search; ?>" class="<?php echo $i === $page ? 'current' : ''; ?>">
					<?php echo $i; ?>
				</a>
			<?php else : ?>
				<a href="?pg=<?php echo $i; ?>&search=<?php echo $search; ?>&category=<?php echo $category; ?>" class="<?php echo $i === $page ? 'current' : ''; ?>">
					<?php echo $i; ?>
				</a>
			<?php endif; ?>
		<?php endfor; ?>
	</div>

</body>


</html>