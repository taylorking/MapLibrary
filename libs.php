<?php

	/**
	Appalachian State University Geography Maps Database
	Taylor King, Ian Matthews, Derrick Hamm, Huy Tu
	Under MIT License, Copyright 2014
	*/

	// if the form posts to libs.php with its variable form_id set to login, we want to run the login routine
	if(isset($_POST['form_id']) && $_POST['form_id'] == "login")
	{
		doLogin();	
	}
	if(isset($_GET['function']) && $_GET['function'] == "logout")
	{
			setcookie('user', 'password', 1); //Set the cookies expired with bad data. 
			setcookie('password', 'blank', 1); 
			session_destroy();
			echo("Successfully Logged out.");
		//	echo('<script type="text/javascript"> document.location="login.php";</script>');
	}
	// I am going to use this to create a way for the user to logout .. Dont worry about it for now.
	//This function logs the user in.	
	function doLogin()
	{
		// Here we get their information from post variables
		$username = $_POST['username'];
		$password = $_POST['password'];
		// Hash the password before we use it
		$password = sha1($password);
		// Then set their cookie.
		setcookie('user', $username);
		setcookie('password', $password);

		if(!verifyLogin())	
		{
			// At this point Login has failed, I might put in a JS redirect back to the login page.. but I feel like it might be better to leave it.
			echo("Login was unsuccessful");
		}
		else
		{
			echo('Login successful. <a href="search.php">Return to search</a>');
		}
	}
	function verifyLogin()
	{
		//Make sure both cookies are set before we run this method.. otherwise php will crash as we try to access a variable that isn't there 
		if(isset($_COOKIE['password']) && isset($_COOKIE['user']))
		{
			$username = $_COOKIE['user'];
			//Query the password hash out of the database
			$query = "SELECT password FROM auth where username='" . $_COOKIE['user'] . "'";
			$conn = getConnection();
			$result = mysqli_query($conn, $query);
			$data = $result->fetch_array(MYSQLI_BOTH);
			// If the hash matches the hash in the database everything is kosher.
			if($data != null && $_COOKIE['password'] == $data['password'])
			{
				return true;
			}
		}
		return false;
	}
	
	
	function getConnection()
	{
		//Just sticking this in a function so I don't have to type out this long ass connection string everywhere
		$conn = mysqli_connect("127.0.0.1", "kingtb", "900499681", "3430-f14-t1") or die ("Error: " . mysqli_connect_error());
		return $conn;
	}
	
	//This method accepts a query to the maps table as a string, performs the query and displays the results in a table.
	function show($query)
	{
		$adminMode = verifyLogin();
			//if the user is an admin let them know.. In the near future, I am going to put a logout button in here.
			if($adminMode) 
			{
				echo("Welcome " . $_COOKIE['user'] . "<br/>" . '<a href="libs.php?function=logout"><img src="asset/exit-256.png" height=16 width=16 alt="Logout of the site" /></a><a href="edit.php"><img src="asset/plus-256.png" height=16 width=16 alt="New Record"></a>');
			}
		$conn = getConnection();
		$data = mysqli_query($conn,$query);
		echo($conn->error);
		//This function should display the results in an intuitive manner, Derrick if you could write and incorporate a style sheet here.. Would make it look nice..
		echo('<table class="result">');
	//	echo('<tr><td>' . ($adminMode)? "<a href=
		while($row = $data->fetch_array(MYSQLI_BOTH))
		{
			echo("<tr>");
				echo("<td>" . $row['GKey'] . "</td>");
				echo("<td>" . $row['Title'] . "</td>");
				echo("<td>" . $row['Topic'] . "</td>");
				echo("<td>" . $row['Type'] . "</td>");
				// This is the summary button shown to all users, will write something that will pass this off to a file called summary.php that accepts an ID as a GET parameter.
				echo('<td><a href="summary.php?id=' . $row['id'] . '"><img src="asset/question-mark-4-256.png" width=16 height=16 alt="Summary"/></a>');
		
		// These lines just create the edit and delete buttons.. I have got delete functionallity down, but I sent out a thing in GroupMe for edit functionallity`	
		echo(($adminMode)? '<a href="edit.php?id=' . $row['id'] . '"><img src="asset/edit-256.png" width=16 height=16 alt="Edit"/></a>':"");
		echo(($adminMode)? '<a href="alter.php?function=delete&id=' . $row['id'] . '"><img src="asset/x-mark-4-256.png" width=16 height=16 alt="Delete"/></a>': "");
		echo("</tr>");	
		}			
		echo("</table>");
	}

?>
