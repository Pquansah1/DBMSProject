<?php

session_start();

if(isset( $_SESSION['user_id'] ))
{
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
	$time = filter_var($_POST['time'], FILTER_SANITIZE_STRING);
	$date = filter_var($_POST['date'], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
	$location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
	
    
    $mysql_hostname = 'localhost';

    $mysql_username = 'root';


    $mysql_password = 'root';

    $mysql_dbname = 'cop4710';

    try
    {		
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        

       
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    
        $stmt = $dbh->prepare("INSERT INTO events (name, category, description, event_time, event_date, location, univ_id, priv, rso, contact_phone, contact_email) VALUES (:name, 'Event', :description, :time, :date, :location, 1, 0, 0, :phone, :email)");

   
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
		$stmt->bindParam(':time', $time, PDO::PARAM_STR);
		$stmt->bindParam(':date', $date, PDO::PARAM_STR);
		$stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':location', $location, PDO::PARAM_STR);
		

        $stmt->execute();

     
        $message = 'New user added';
		
		header('Location: /');
    }
    catch(Exception $e)
    {
        
        if( $e->getCode() == 23000)
        {
            $message = 'Username already exists';
			header('Location: /');
        }
        else
        {
           
            $message = $e;
			header('Location: /');
        }
    }
}
else
{
	header('location: /');
}

?>