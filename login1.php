<!DOCTYPE html>
<html>
<head>
	<title>login</title>
</head>
<style>
table{
	
	padding:20px;
	margin:50px;
	border-collapse:collapse;
	text-align:center;
	}	
</style>
<body>
	<form method="post" action="<?php echo base_url()?>main/login">

				
					<input type="email" name="email" placeholder="email"></br></br>
					
					<input type="password" name="password" placeholder="password"></br>
					<input type="submit" value="submit" name="submit">
				
				
					
</table>
</form>
</body>
</html>