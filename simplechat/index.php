<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to Baffoons Chat</title>
		<script type="text/javascript" src="js/jquery.js"></script>
	</head>
	<body>
		<h3>LOG IN</h3>
		<div id="LoginDiv">
			<form method="post" action="pages/UserLogin.php">
			<table>
				<tr>
					<td>Email: </td><td><input type="email" name="UserMailLogin" /></td>
				</tr>
				<tr>
					<td>Password: </td><td><input type="password" name="UserPasswordLogin" /></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" value="LOG IN" /></td>
				</tr>
				<?php
					if(isset($_GET['error'])){
				?>
				<tr>
					<td></td><td><span style="color: red;">Error Login</span></td>
				</tr>
				<?php
				}
				?>
			</table>
			</form>
		</div>
		<h3>SIGN UP</h3>
		<div id="SignUpDiv">
			<form method="post" action="pages/InsertUser.php">
			<table>
				<tr>
					<td>Name: </td><td><input type="text" name="UserName" /></td>
				</tr>
				<tr>
					<td>Email: </td><td><input type="email" name="UserMail" /></td>
				</tr>
				<tr>
					<td>Password: </td><td><input type="password" name="UserPassword" /></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" value="Sign Up" /></td>
				</tr>
				<?php
					if(isset($_GET['success']))
					{
				?>
				<tr>
					<td></td><td><span style="color: green;">User Registered</span></td>
				</tr>
				<?php
				}
				?>
			</table>
			</form>
		</div>
	</body>
</html>