<html>
	<head>
		<title> 
				<?php 
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
