<?php include('app_logic.php'); ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Olympics</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>
	<form class="login-form" action="new_pass.php" method="post">
		<h2 class="form-title">New password</h2>
		<!-- form validation messages -->
		<?php include('messages.php'); ?>
		
		<input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
		<div class="form-group">
			<label>New password</label>
			<input type="password" name="new_pass">
		</div>
		<div class="form-group">
			<label>Confirm new password</label>
			<input type="password" name="new_pass_c">
		</div>
		<div class="form-group">
			<button type="submit" name="new_password" class="login-btn">Submit</button>
		</div>
	</form>
</body>
</html>