<?php

session_start();

$location = "UCF";

function listEventInfo() {
	
	
    $mysql_hostname = 'localhost';

   
    $mysql_username = 'root';


    $mysql_password = 'root';

  
    $mysql_dbname = 'cop4710';
	
	try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        

      
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("SELECT name, description, event_date, contact_phone, contact_email, event_id, location FROM events WHERE event_id = :event_id");        

        $stmt->bindParam(':event_id', $_GET['event_id'], PDO::PARAM_INT);
	
        $stmt->execute();
		
		$result = $stmt->fetch(PDO::FETCH_ASSOC);		

		$GLOBALS['location'] = $result['location'];
		
		echo "<h3>Name: " . $result['name'] . "</h3>";
		echo "<h3>Description: " . $result['description'] . "</h3>";
		echo "<h3>Date: " . $result['event_date'] . "</h3>";
		echo "<h3>Contact Phone: " . $result['contact_phone'] . "</h3>";
		echo "<h3>Contact Email: " . $result['contact_email'] . "</h3>";
		
		
		
		$stmt = null;
		
  

    }
    catch(Exception $e)
    {
   
        echo 'We are unable to process your request. Please try again later';
    }	
	
}

function listCommentsAndRatings() {
	
    $mysql_hostname = 'localhost';

    $mysql_username = 'root';

    /*** mysql password ***/
    $mysql_password = 'root';

    
    $mysql_dbname = 'cop4710';
	
	try
    {
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
       

      
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      
        $stmt = $dbh->prepare("SELECT c.text, r.rating FROM comments c, ratings r, events e WHERE e.event_id = c.event_id AND r.comment_id = c.comment_id AND e.event_id = :event_id");        

        $stmt->bindParam(':event_id', $_GET['event_id'], PDO::PARAM_INT);
		
		
        $stmt->execute();
	
		echo "<h3>Comments: </h3>";
		
		while($result = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			echo "<h3>" . $result['text'] . "\t\t\t" . "Rating: " .$result['rating'] . "</h3>" . "<a href=/>Remove</a>";
			
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

	<div id="page">
		<br><br><center><div class="logo"><a href="index.php" style="text-decoration: none; color: #333333;">College Event Hub</a></div></center>		

		<?php 
		
			listEventInfo();
			echo "<br>";
			listCommentsAndRatings();
		
		?>
		
		<div id="page">
		
			
			<form>

				
				<table>
					<tr><td> Add Comment: </td>
					<td> <input type="text" name="" value=""> </td></tr>

			</form>
					
			<form method="get" action="request.php">		
					<tr><td><input type="submit" value="Submit"> </td></tr>
				</table>
			</form>

			</div>
		
		<br>
		
		<iframe
			width="600"
			height="450"
			frameborder="0" style="border:0"
			src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA-bycgCKodNWMCGD9CUspU9ZC7aGxmHbk
			&q=<?php echo $location ?>
			&attribution_source=Google+Maps+Embed+API
			&attribution_web_url=http://www.butchartgardens.com/
			&attribution_ios_deep_link_id=comgooglemaps://?daddr=Butchart+Gardens+Victoria+BC">
		</iframe>
		
		<a class="twitter-share-button"	href="https://twitter.com/share">Tweet</a>
	
		
		<div class="fb-share-button" data-href="https://developers.facebook.com/docs/plugins/" data-layout="button_count"></div>
		
	</div>
</body>

<?php include_once("footer.php"); ?>