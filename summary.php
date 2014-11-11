<!-- What this file is: A page that we will use to display all the information about the map
    As well as allow the users to make and read comments. 
--> 
<html>
	<head>
		<title> 
				<?php 

          //If we dont get ?id='Map_ID' in the page load, we really can't do anything.
          // I might want to do a javascript redirect here, but that is to worry about
          // later on down the road.
          if(!isSet($_GET['map_id'])) 
					{
						echo ("Error");
					}
					else 
					{
						include 'libs.php';
						$conn = getConnection();
						$query = "SELECT * FROM maps WHERE id='" . $_GET['map_id'] . "'";
						$result = mysqli_query($conn, $query);
						if(($row = $result->fetch_array(MYSQLI_BOTH)) != null)
						{
								echo("Summary of: " . $row['Title']);
						}
						else 
						{
							echo("Error. Invalid ID");
						}
					}
				?>
		</title>
	</head>
</html>
