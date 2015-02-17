<!DOCTYPE html>
<html>
<table>
	<tr>
		<form method="POST" action="include/li.php">
			<td><input type="text" name="usr_name" size=15 placeholder="Username"></td>
			<tr><td><input type="password" name="usr_pass" size=15 placeholder="Password"></td>
			<tr>
				<td><input type="radio" name="usertype" value="admin" /> Admin<br />
				<input type="radio" name="usertype" value="customer" /> Customer<br/>
				<input type="radio" name="usertype" value="engineer" /> Engineer<br />
				<input type="radio" name="usertype" value="conductor" /> Conductor</td>
			</tr>
			<tr>
				<td><input type="submit" value="Login"></td>
			</tr>
		</form>
	</tr>
</table>

<a href="register.php">Register</a>
</html>
