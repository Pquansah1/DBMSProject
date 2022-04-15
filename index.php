<?php

/*** begin our session ***/
session_start();


function listPublicEvents() {
	

    $mysql_hostname = 'localhost';


    $mysql_username = 'root';


    $mysql_password = 'root';


    $mysql_dbname = 'cop4710';
	
	try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);



        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

       
        $stmt = $dbh->prepare("SELECT name, description, event_date, contact_phone, contact_email, event_id FROM events WHERE priv = 0");        

        $stmt->execute();
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$event_id = $row['event_id'];
			echo "<a href='events.php?event_id=$event_id'>" . $row['name'] . "</a>".  "\t" . $row['description'] . "\t" . $row['event_date'] . "\t" . $row['contact_phone'] . "\t" . $row['contact_email'] . "<br><br>";

		}
		
		$stmt = null;
		


    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        echo 'We are unable to process your request. Please try again later';
    }	
	
}

function listUniversityEvents() {
	

    $mysql_hostname = 'localhost';


    $mysql_username = 'root';

    $mysql_password = 'root';

    
    $mysql_dbname = 'cop4710';
	
	try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
       
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $dbh->prepare("SELECT name, description, event_date, contact_phone, contact_email, event_id, event_time, location FROM events WHERE priv = 1");        
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
		
        $stmt->execute();
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$event_id = $row['event_id'];
			echo "<a href='events.php?event_id=$event_id'>". $row['name'] . "</a>". "\t" . $row['description'] . "\t" . $row['event_time'] . "\t" . $row['location'] . "\t" . $row['contact_email'] . "<br><br>";
		}
		
		$stmt = null;
    }
    catch(Exception $e)
    {
        /*** if we are here, something has gone wrong with the database ***/
        echo 'We are unable to process your request. Please try again later';
    }	
	
}

function listRSOEvents() {

	
    $mysql_hostname = 'localhost';

    $mysql_username = 'root';

   
    $mysql_password = 'root';

    $mysql_dbname = 'cop4710';
	
	try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        
        $stmt = $dbh->prepare("SELECT name, description, event_date, contact_phone, contact_email, event_id, event_time, location FROM events WHERE priv = 2");;        

        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
		
	
        $stmt->execute();
		
		
		while($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$event_id = $row['event_id'];
			echo "<a href='events.php?event_id=$event_id'>" . $row['name'] . "</a>" . "\t" . $row['description'] . "\t" . $row['event_time'] . "\t" . $row['location'] . "\t" . $row['contact_email'] . "<br><br>";
		}
		
		$stmt = null;
		

    }
    catch(Exception $e)
    {
       
        echo 'We are unable to process your request. Please try again later';
    }	
	
}

?>

<?php include_once("header.php"); ?>

	<div id="page" style="background-image: url(img/bkg.png); min-height: 100vh;">
		
		<br><br><center><div class="logo"><a href="index.php" style="text-decoration: none; color: #f2e707;">College Event Website</a></div></center>		

		<br>
		<?php if(!isset($_SESSION['user_id'])): ?>
		
			<center><p class="body">
				<h3>Login Below</h3>
				<form action="login.php" method="post">
					<fieldset>
						<p>
							<label for="username">Username:</label>
							<input type="text" id="username" name="username" value="" maxlength="20" />
						</p>
						<p>
							<label for="password">Password:</label>
							<input type="password" id="password" name="password" value="" maxlength="20" />
						</p>
						<p>
							<input type="submit" value="Login" />
						</p>
					</fieldset>
				</form>
			</p></center>
			
			<center><p class="body">
		
				<h3>Click <a href="signup.php">Here</a> to register</h3>
			
			</p>
			
		<?php else: ?>
		
			<center><p class="body">
			
			<style>
				#navbar 
					{
					width: 550px;
					height: 35px;
					font-size: 16px;
					font-family: Tahoma, Geneva, sans-serif;
					font-weight: bold;
					text-align: center;
					text-shadow: 1px 2px 3px #333333;
					background-color: #8AD9FF;
					border-radius: 8px;
					text-decoration: none;
					}

					 
					
			</style>
				
				<?php if(isset($_SESSION['user_priv']) && $_SESSION['user_priv'] == 3): ?>
					<div id="navbar">
						<h4><a href="logout.php">Logout</a> &nbsp&nbsp&nbsp <a href="createRSO.php">Request New RSO</a></h4>
					</div>
				<?php elseif (isset($_SESSION['user_priv']) && $_SESSION['user_priv'] == 2): ?>
					<div id="navbar">
					<h4><a href="logout.php">Logout</a> &nbsp&nbsp&nbsp <a href="createEvent.php">Host Event</a></h4>
					</div>
				<?php elseif (isset($_SESSION['user_priv']) && $_SESSION['user_priv'] == 1): ?>
					<div id="navbar">
					<h4><a href="logout.php">Logout</a> &nbsp&nbsp&nbsp <a href="createUni.php">Create University Profile</a></h4>
					</div>
				<?php else: ?>
					
					<h4><a href="logout.php">Logout</a>, Error: User privilege not set! </h4>
					
				<?php endif; ?>
				
			</p>		
		
		<?php endif; ?>
		
		<!-- show public event -->
		<center><p class="body"> Public Events 
		
		<br>
		<br>
		
			<?php
			
				if(isset($_SESSION['user_id']) && $_SESSION['user_priv'] == 3)
				{
					listPublicEvents();
				}
				elseif(isset($_SESSION['user_id']) && $_SESSION['user_priv'] == 2)
				{
					listPublicEvents();
				}
				elseif(isset($_SESSION['user_id']) && $_SESSION['user_priv'] == 1)
				{
				
				}
			
				
			?>
		</p>
		
		<center><p class="body"> Universities Events
		
		<br>
		
			<?php 
			
				
				if(isset($_SESSION['user_id']) && $_SESSION['user_priv'] == 2)
				{
					listPublicEvents();
				}
				elseif(isset($_SESSION['user_id']) && $_SESSION['user_priv'] == 1)
				{
					listUniversityEvents();
				}
				
				elseif(!isset($_SESSION['user_id']))
				{
				
				}

			?>
			
		</p>
		
		<center><p class="body"> RSO Events
		
		<br>
		
			<?php 
			
				listRSOEvents();		
			

			?>
			
		</p>
		
		<br>
		
	</div>
</body>

<?php include_once("footer.php"); ?>