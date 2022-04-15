<?php


session_start();

if(!isset($_SESSION['user_id']))
{
    $message = 'You must be logged in to access this page';
}
else
{
    try
    {
        $mysql_hostname = 'localhost';

       
        $mysql_username = 'root';

    
        $mysql_password = 'root';

        $mysql_dbname = 'cop4710';


        
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
       

        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("SELECT username FROM users 
        WHERE user_id = :user_id");

        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

      
        $stmt->execute();

        $phpro_username = $stmt->fetchColumn();

        
        if($phpro_username == false)
        {
            $message = 'Access Error';
        }
        else
        {
			if(isset($_SESSION['user_priv']) && $_SESSION['user_priv'] == 1)
			{
				$admin = ' You are super Admin!! '.$_SESSION["user_priv"];
			}
			else 
			{
				$admin = '';
			}
			
			$message = 'Welcome '.$phpro_username.$admin;

        }
    }
    catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}

?>

<html>
<head>
<title>Members Only Page</title>
</head>
<body>
	<h2><?php echo $message; ?></h2>
</body>
</html>