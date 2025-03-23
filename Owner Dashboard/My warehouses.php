<?php
include 'connection.php';

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'owner') {
	header('Location: ../sign up and login/login.php'); // Redirect to login if not logged in
}

if (isset($_POST['submit'])) {
	$owner_id = $_SESSION['user_id'];

	$name = $_POST['name'];
	$name = filter_var($name, FILTER_SANITIZE_STRING);
	$adress = $_POST['adress'];
	$adress = filter_var($adress, FILTER_SANITIZE_STRING);
	$area = $_POST['area'];
	$area = filter_var($area, FILTER_SANITIZE_STRING);
	$warehouse_type = $_POST['warehouse_type'];
	$warehouse_type = filter_var($warehouse_type, FILTER_SANITIZE_STRING);
	$price = $_POST['price'];
	$price = filter_var($price, FILTER_SANITIZE_STRING);
	$status = $_POST['status'];
	$status = filter_var($status, FILTER_SANITIZE_STRING);
	$contact = $_POST['contact'];
	$contact = filter_var($contact, FILTER_SANITIZE_STRING);

	$image_01 = $_FILES['image_01']['name'];
	$image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
	$image_size_01 = $_FILES['image_01']['size'];
	$image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
	$image_folder_01 = 'uploaded_img/' . $image_01;

	$image_02 = $_FILES['image_02']['name'];
	$image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
	$image_size_02 = $_FILES['image_02']['size'];
	$image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
	$image_folder_02 = 'uploaded_img/' . $image_02;

	$image_03 = $_FILES['image_03']['name'];
	$image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
	$image_size_03 = $_FILES['image_03']['size'];
	$image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
	$image_folder_03 = 'uploaded_img/' . $image_03;

	$details = $_POST['details'];
	$details = filter_var($details, FILTER_SANITIZE_STRING);

	$insert_warehouse = $conn->prepare("INSERT INTO `warehouses`(owner_id,warehouse_name,adress,total_area,warehouse_type,price,status,
	contact_information,image1,image2,image3,description) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

	$insert_warehouse->execute([
		$owner_id,
		$name,
		$adress,
		$area,
		$warehouse_type,
		$price,
		$status,
		$contact,
		$image_01,
		$image_02,
		$image_03,
		$details
	]);

	if ($insert_warehouse) {
		if ($image_size_01 > 2000000 or $image_size_02 > 2000000 or $image_size_03 > 2000000) {
			echo "<script>alert('Image Filed are too Big!');</script>";
		} else {
			move_uploaded_file($image_tmp_name_01, $image_folder_01);
			move_uploaded_file($image_tmp_name_02, $image_folder_02);
			move_uploaded_file($image_tmp_name_03, $image_folder_03);
			echo "<script>alert('New Warehouse Added!');</script>";
		}
	}
}

$user_id = $_SESSION['user_id'];
$fetch = $conn->prepare("SELECT warehouse_name,created_at,status FROM warehouses WHERE owner_id = ?");
$fetch->execute([$user_id]);
$row = $fetch->fetch(PDO::FETCH_ASSOC);





?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Boxicons -->
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link
		href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
		rel="stylesheet" />
	<!-- My CSS -->
	<!-- <link rel="stylesheet" href="Dashboardstyle.css"> -->
	<link rel="stylesheet" href="My warehouse.css">

	<title>Owner Dashboard</title>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">StoreSmart</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
				<a href="Dashboard.php">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="My warehouses.php">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">My Warehouses</span>
				</a>
			</li>
			<!-- <li>
				<a href="#">
					<i class='bx bxs-doughnut-chart' ></i>
					<span class="text">Analytics</span>
				</a>
			</li> -->
			<li>
				<a href="Profile.php">
					<i class='ri ri-profile-fill'></i>
					<span class="text">Profile</span>
				</a>
			</li>
			<!-- <li>
				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Team</span>
				</a>
			</li> -->
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='ri ri-contacts-fill'></i>
					<span class="text">Contact Us</span>
				</a>
			</li>
			<li>
				<a href="/sign up and login/login.html" class="logout">
					<i class='bx bxs-log-out-circle'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->



	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>

			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="My warehouses.html">My Warehouses</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<h3>1020</h3>
						<p>New Order</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<h3>2834</h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle'></i>
					<span class="text">
						<h3>$2543</h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Listed Warehouses</h3>
						<!-- <i class='bx bx-search'></i> -->
						<!-- <i class='bx bx-filter'></i> -->
					</div>
					<table>
						<thead>
							<tr>
								<th>Name</th>
								<th>Date Created</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($fetch->rowCount() > 0) {
								// Output data for each row
								while ($result = $fetch->fetch(PDO::FETCH_ASSOC)) {
									// Determine status class
									$statusClass = strtolower($result['status']);
							?>
									<tr>
										<td>
											<img src='img/people.png' alt='Owner Image'>
											<p><?= $result['warehouse_name']; ?></p>
										</td>
										<td><?= $result['created_at']; ?></td>
										<td><span class="status <?= $statusClass; ?>"><?= $result['status']; ?></span></td>
									</tr>
							<?php
								}
							} else {

								echo "<tr><td colspan='3'>No warehouses found</td></tr>";
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="add-products">


				<h1 class="heading">ADD WAREHOUSE</h1>

				<form id="form" action="" method="POST" enctype="multipart/form-data">
					<div class="flex">
						<div class="inputBox">
							<span>Warehouse Name (required)</span>
							<input type="text" class="box" required maxlength="100" placeholder="Enter Warehouse Name" name="name">
						</div>
						<div class="inputBox">
							<span>Adress (required)</span>
							<input type="text" class="box" required maxlength="100" placeholder="Enter Warehouse Adress" name="adress">
						</div>
						<div class="inputBox">
							<span>Total Area(required)</span>
							<input type="text" class="box" required max="100" placeholder="Enter Warehouse Total Area" name="area">
						</div>
						<div class="inputBox">
							<span>Type of Warehouse</span>
							<select name="warehouse_type" id="warehouse-type">
								<option value="" disabled selected>Select Type of Warehouse</option>
								<option value="General Purpose">General Purpose</option>
								<option value="Climate Controlled">Climate Controlled</option>
								<option value="Distribution Center">Distribution Center</option>
								<option value="Manufacturing">Manufacturing</option>
								<option value="Self-Storage">Self-Storage</option>
								<option value="Retail Warehouse">Retail Warehouse</option>
							</select>
						</div>
						<div class="inputBox">
							<span>Price(required)</span>
							<input type="number" class="box" min="0" required max=" 99999999" placeholder="Enter Warehouse Price" name="price">
						</div>
						<div class="inputBox">
							<span>Status</span>
							<select name="status" id="status">
								<option value="" disabled selected>Select Availability</option>
								<option value="Available">Available</option>
								<option value="Not Available">Not Available</option>
							</select>
						</div>
						<div class="inputBox">
							<span>Contact Information(required)</span>
							<input type="text" class="box" required max="100" placeholder="Contact Information" name="contact">
						</div>
						<div class="inputBox">
							<span>Image 01 (required)</span>
							<input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
						</div>
						<div class="inputBox">
							<span>Image 02 (required)</span>
							<input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
						</div>
						<div class="inputBox">
							<span>Image 03 (required)</span>
							<input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
						</div>
						<div class="inputBox">
							<span>Warehouse Description (required)</span>
							<textarea name="details" placeholder="Enter Warehouse Details" class="box" required maxlength="500" cols="30" rows="10"></textarea>
						</div>
					</div>

					<!-- <input type="submit" value="ADD" class="btn" name="add_warehouse"> -->
					<button name="submit" type="submit" value="ADD" class="btn">ADD</button>
				</form>

			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="Dashboard.js"></script>
</body>

</html>