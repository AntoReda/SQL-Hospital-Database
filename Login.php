
<?php
// variables needed to connect to the database
$host = 'localhost';
$dbname = 'database1';
$user = 'root';
$pass = '';

//Connecting to our DB.
$conn = mysqli_connect($host, $user, $pass, $dbname);

$username = "root";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // retrieves the username and password submitted by the user.
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT username, password FROM AdminUsers WHERE username=? AND password=?";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 0) {
        // show a pop-up message if the username or password is not found
        echo "<p style='text-align:center; margin-top:1%;'>Wrong username or password, Please try again.</p>";
    } else {
        // TODO: check if the password is correct and redirect the user to the admin page
		header("Location:index_Admin.php");
		exit();
    }
}
?>

<!DOCTYPE HTML>

<!--
	Hyperspace by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>



	<head>
		<title>COMP 353 Final Project</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">
							<h1>Admin Login Page</h1>

                            <form method="post">

                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" placeholder="Enter your username" required>

                                <label for="password">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password" required>

                                <input type="submit" value="Login">
								
                            </form>


                            <button  onclick="window.location.href='index.php'"  > Back to home page</button>
							
						</div>
			</div>

				
			

		<!-- Footer -->
			<footer id="footer" class="wrapper style1-alt">
				<div class="inner">
					<ul class="menu">
						<li>&copy; WarmUp Project. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>