<?php 
	require 'database.php';

	$message = '';

	if (!empty($_POST['email']) && !empty($_POST['password'])) {
		$sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
		$stmt = $conn->prepare($sql); 
		$stmt->bindParam(':email',$_POST['email']);
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$stmt->bindParam(':password',$password);

		if ($stmt->execute()) {
			$message = 'Successfully created new user';
		} else {
			$message = 'Sorry there must have been an issue creating your accout';
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>SignUp</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Square+Peg&family=Tiro+Gurmukhi&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/style2.css">
	</head>
	<body>
		<?php require 'partials/header.php' ?>

		<?php if(!empty($message)): ?>
			<p><?= $message ?></p>
		<?php endif; ?>
		<h1>SignUp</h1>
		<span>or <a href="login.php">Login</a></span>
		<form action="signup.php" method="post">
			<input type="text" name="email" placeholder="Enter your mail">
			<input type="password" name="password" placeholder="Enter your password">
			<input type="password" name="confirm_password" placeholder="Confirm your password">
			<input type="submit" value="Send">
		</form>
	</body>
</html>