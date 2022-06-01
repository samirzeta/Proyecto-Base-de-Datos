<?php 
	session_start();

	require 'database.php';

	if (isset($_SESSION['user_id'])) {
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE id =:id');
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$user = null;

		if (count($results) > 0) {
			$user = $results;
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcomo to your App</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Square+Peg&family=Tiro+Gurmukhi&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		<?php require 'partials/header.php' ?>
		<?php if(!empty($user)): ?>
			<br>Welcome. <?= $user['email'] ?>
			<br>You are Successfully Logged In
			<a href="logout.php">Logout</a>
		<?php else: ?>
			<h1>Please Login or SignUp</h1>
		
			<a href="login.php">Login</a> or
			<a href="signup.php">Signup</a>
		<?php endif; ?>
	</body>
</html>