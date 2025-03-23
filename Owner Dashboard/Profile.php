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
	<link rel="stylesheet" href="Dashboardstyle.css">
	<link rel="stylesheet" href="profile.css">

	<title>Owner Dashboard</title>
</head>

<body>


	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="Dashboard.html" class="brand">
			<i class='ri ri-admin-fill'></i>
			<span class="text"><em>StoreSmart</em></span>
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
							<a class="active" href="Profile.php">My Profile</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="container">
				<!-- Title section -->
				<div class="title">My Profile</div>
				<div class="content">
					<!-- Registration form -->
					<form action="#">
						<div class="user-details">
							<!-- Input for Full Name -->
							<div class="input-box">
								<span class="details">Full Name</span>
								<input type="text" placeholder="Enter your name" required>
							</div>
							<!-- Input for Username -->
							<div class="input-box">
								<span class="details">Username</span>
								<input type="text" placeholder="Enter your username" required>
							</div>
							<!-- Input for Email -->
							<div class="input-box">
								<span class="details">Email</span>
								<input type="text" placeholder="Enter your email" required>
							</div>
							<!-- Input for Phone Number -->
							<div class="input-box">
								<span class="details">Phone Number</span>
								<input type="text" placeholder="Enter your number" required>
							</div>
							<!-- Input for Password -->
							<div class="input-box">
								<span class="details">Password</span>
								<input type="text" placeholder="Enter your password" required>
							</div>
							<!-- Input for Confirm Password -->
							<div class="input-box">
								<span class="details">Confirm Password</span>
								<input type="text" placeholder="Confirm your password" required>
							</div>
						</div>
						<!-- Submit button -->
						<div class="button">
							<input type="submit" value="Update">
						</div>
					</form>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->


	<script src="Dashboard.js"></script>
</body>

</html>