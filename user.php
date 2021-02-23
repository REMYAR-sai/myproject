<!DOCTYPE html>
<html>
<head>
	<title>REGISTRATION FORM</title>
</head>
<body>
	<form action="<?php echo base_url()?>main/regist" method="post">
			<input type="text" name="firstname" required="" placeholder="firstname">
			<input type="text" name="lastname" required="" placeholder="lastname">
			<input type="text" name="username" required="" placeholder="username">
			<input type="password" name="password" required="" placeholder="password">
			<input type="text" name="mobile" required="" placeholder="mobile">
			<input type="email" name="email" required="" placeholder="email">
			<input type="submit" name="submit" required="" placeholder="submit">
	</form>
</body>
</html>