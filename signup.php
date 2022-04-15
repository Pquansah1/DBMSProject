<?php


session_start();


$form_token = md5( uniqid('auth', true) );


$_SESSION['form_token'] = $form_token;
?>

<?php include_once("header.php"); ?>
	
	<div id="page" style="background-image: url(img/ucf.jpg); flex-grow: 1; min-height: 100vh;">
	
		<br><br><center><div class="logo"><a href="index.php" style="text-decoration: none; color: #9c9624;">College Event Hub</a></div></center>		

		<br>
		
		<center><p class="body">
			<h3>Sign Up Here</h3>
			<form action="ssignup.php" method="post">
				<fieldset>
					<table>
						<tr><td> <label for="firstname">First Name:</label> </td>
						<td> <input type="text" id="firstname" name="firstname" value="" maxlength="20" /> </td></tr>
					
					
						<tr><td> <label for="lastname">Last Name:</label> </td>
						<td> <input type="text" id="lastname" name="lastname" value="" maxlength="20" /> </td></tr>
					
						<tr><td> <label for="email">Email:</label> </td>
						<td> <input type="text" id="email" name="email" value="" maxlength="20" /> </td></tr>
					
						<tr><td> <label for="username">Username:</label> </td>
						<td> <input type="text" id="username" name="username" value="" maxlength="20" /> </td></tr>
					
						<tr><td> <label for="password">Password:</label> </td>
						<td> <input type="password" id="password" name="password" value="" maxlength="20" /> </td></tr>

						<tr><td> <label for="priv">User type:</label> </td><td>
							<select name="priv" id="priv">
							  <option value="1">Super Admin</option>
							  <option value="2">Admin</option>
							  <option value="3">User</option>
							</select>
						</tr></tr>
					
						<tr><td> <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
								 <input type="submit" value="Register" /> 
						</td></tr>
					</table>
				</fieldset>
			</form>
		</p></center>
		
		<br>
		
		<center><p class="body">
		
			
		</p>
		
	</div>
</body>

<?php include_once("footer.php"); ?>