<?php

session_start();


if(!isset( $_POST['username'], $_POST['password'], $_POST['form_token']))
{
    $message = 'Please enter a valid username and password';
}

elseif( $_POST['form_token'] != $_SESSION['form_token'])
{
    $message = 'Invalid form submission';
}

elseif(!isset($_POST['firstname']))
{
	$message = 'Please enter a valid name';
}

elseif(!isset($_POST['email']))
{
	$message = 'Please enter a valid name';
}

elseif (strlen( $_POST['username']) > 20 || strlen($_POST['username']) < 1)
{
    $message = 'Incorrect Length for Username';
}

elseif (strlen( $_POST['password']) > 20 || strlen($_POST['password']) < 1)
{
    $message = 'Incorrect Length for Password';
}

elseif (ctype_alnum($_POST['username']) != true)
{
  
    $message = "Username must be alpha numeric";
}

elseif (ctype_alnum($_POST['password']) != true)
{
        $message = "Password must be alpha numeric";
}
else
{
    
    $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
	$lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $user_priv = filter_var($_POST['priv'], FILTER_SANITIZE_STRING);
	

    
    $password = sha1( $password );
    

    $mysql_hostname = 'localhost';

    $mysql_username = 'root';

    $mysql_password = 'root';

    $mysql_dbname = 'cop4710';

    try
    {
		$reg_date = date("Y-m-d H:i:s");
		
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        

       
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $dbh->prepare("INSERT INTO users (username, password, priv, firstname, lastname, email, reg_date) VALUES (:username, :password, :priv , :firstname, :lastname, :email, :reg_date)");

        /*** bind the parameters ***/
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);
		$stmt->bindParam(':priv', $user_priv, PDO::PARAM_INT);
		$stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
		$stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->bindParam(':reg_date', $reg_date, PDO::PARAM_STR);
		

        
        $stmt->execute();

       
        unset( $_SESSION['form_token'] );

     
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
?>