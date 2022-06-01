<?php 
	session_start();

	if (isset($_SESSION['user_id'])) {
		header('Location: /php-login');
	}

	require 'database.php';
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$records = $conn->prepare('SELECT id, email, password FROM users WHERE email=:email');
		$records->bindParam(':email', $_POST['email']);
		$records->execute();
		$results = $records->fetch(PDO::FETCH_ASSOC);

		$message = '';

		if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
			$_SESSION['user_id'] = $results['id'];
			header("Location: /php-login");
		} else {
			$message = 'Sorry, those credentials do not match';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Square+Peg&family=Tiro+Gurmukhi&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/style2.css">
	</head>
	<body>
		<?php require 'partials/header.php' ?>

		<h1>Login</h1>
		<span>or <a href="signup.php">SignUp</a></span>
		<?php if (!empty($message)): ?>
			<p><?= $message ?></p>
		<?php endif; ?>
		<form action="login.php" method="post">
			<input type="text" name="email" placeholder="Enter your mail">
			<input type="password" name="password" placeholder="Enter your password">
			<input type="submit" value="Send">
		</form>
	</body>
</html>