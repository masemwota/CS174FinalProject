<?php 	//setupusers.php
	require_once 'login.php'; 
	$testing = true;

	$conn = new mysqli($hn, $un, $pw, $db);
	if ($conn->connect_error) die(error("Database Connection Issue", $conn, $testing));


	if (isset($_POST['FirstName']) && isset($_POST['LastName']) && isset($_POST['Username']) && isset($_POST['Password']))
	{
		$firstname = get_post($conn, 'FirstName');
		$lastname = get_post($conn, 'LastName');
		$username = get_post($conn, 'Username');
		$password = get_post($conn, 'Password');

		//query 
	}

	else
	{
		echo <<<_END
<form action="setupusers.php" method="post"><pre>
First Name <input type="text" name="FirstName">
Last Name <input type="text" name="LastName">
Username <input type="text" name="Username">
Password <input type="text" name="Password">
<input type="submit" value="CREATE USER">
</pre></form>
_END;


		echo <<<_END
	<html><head><title>Translate App</title></head><body>
	<form action='translator.php' method='post' enctype='multipart/form-data'>
		<input type='submit' value='User'>
	</form>
_END;
	}

	$conn->close();


echo "</body></html>";
	



	$salt1 = generate_salt();
	$salt2 = generate_salt();

	$forename = 'Pauline';
	$surname = 'Jones';
	$username = 'pjones';
	$password = 'acrobat';

	$token = hash('ripemd128', "$salt1$password$salt2");

	add_user($connection, $forename, $surname, $username, $token);

	function add_user($connection, $fn, $sn, $un, $pw) 
	{
		$query = "INSERT INTO users VALUES('$fn', '$sn', '$un', '$pw')";
		$result = $connection->query($query);
		if (!$result) die($connection->error);
	}


	function generate_salt()
	{
		return "abcde"; 
	}

	function get_post($conn, $var)
	{
		return $conn->real_escape_string($_POST[$var]);
	}

	function mysql_entities_fix_string($conn, $string)
	{
		return htmlentities(mysql_fix_string($conn, $string));
	}

	function mysql_fix_string($conn, $string)
	{
		if (get_magic_quotes_gpc()) $string = stripslashes($string);
		return $conn->real_escape_string($string);
	}


	function error($msg, $conn, $testing)
	{
		if($testing == true)
		{
			testing_error($msg, $conn); 
		}
		else 
		{
			fatal_error($msg); 
		}

	}

	function fatal_error($msg)
	{
		echo <<<_END
	We are sorry, but it was not possible to complete
	the requested task. The error message we got was:

	<p>$msg</p>

	Please click the back button on your browser
	and try again. Thank you.
_END;
	}


	function testing_error($msg, $conn)
	{
		$msg2 = mysqli_error($conn);
		echo <<<_END
	The error message we got was:

	<p>$msg: $msg2</p>
_END;
	}
?>