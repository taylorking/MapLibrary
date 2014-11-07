<html>
	<head>
		<title>
			<?php
			if(isset($_GET['id']))
			{
			
					include 'libs.php';
					$query = "SELECT Title FROM maps where id='" . $_GET['id'] . "'";
					$conn = getConnection();
					$result = mysqli_query($conn, $query);
					$result = $result->fetch_array(MYSQLI_BOTH);
					echo($result['Title']);
				} else 
{
	echo "Create a new record";
}
?>
		</title>
			<script type="text/javascript"> 
					function validate()
					{
					// This is where code to validate the users input in the form. 
					return false;
					}
			</script>
	</head>
	<body>
		<form action="alter.php" method="post"> 
			<?php 	
				// This page is a way for the administrator to edit records in the database. This is just the front-end form. The code to perform the transactions will likeley go in another file, however I have not decided yet.
					include 'libs.php'; 
					if(!verifyLogin()) 
					{
						echo('You are not allowed to access this page. Please <a href="login.php">login</a>');
						return false;
					}	
					$query = "SELECT * FROM maps WHERE id='" . $_GET['id'] . "'";
					$result = mysqli_query($conn, $query);
					$row = ($result != null)? $result->fetch_array(MYSQLI_BOTH) : null;

					// The code below prepopulates the fields on the form if we have been passed an ID as a get parameter. It will query the database to fill out the text fields. 		

					echo '<input type="hidden" value="' . $row['id'] . '" name="id"/>';
					echo '<table class="form">
								<tr>
									<td>
										GKey
									</td>
									<td>';
					echo			'<input type="text" name="gkey" value="' . $row['GKey'] . '"/>';
					echo		'</td>
								</tr>
								<tr>
									<td>
										Subject	
									</td>
									<td>';
					echo			'<input type="text" name="subject" value="' . $row['Subject'] . '"/>'; 
					echo		'</td>
								</tr>
								<tr>
									<td>	
										Catalog Date
									</td>
									<td>';
					echo			'<input type="text" name="catalog_date" value="' . $row['CatalogDate'] . '"/>';
					echo	'</td>
							</tr>
							<tr>
								<td>
									Publisher
								</td>
								<td>';
					echo	 '<input type="text" name="publisher" value="' . $row['Publisher'] . '" />';
					echo '</td>
							</tr>
							<tr>
								<td>
									Identifier
								</td>
								<td>';
					echo		'<input type="text" name="identifier" value="' . $row['Identifier'] . '"/>';
					echo	'</td>
							</tr>
							<tr>
								<td>
									Title
								</td>
								<td>';
					echo		'<input type="text" name="title" value="' . $row['Title'] . '"/>';
					echo  '</td>
							</tr>
							<tr>
								<td>
									Type
								</td>
								<td>';
					echo	'<input type="text" name="type" value="' . $row['type'] . '"/>';
					echo	'</td>
							</tr>
							<tr>
								<td>
									Topic	
								</td>
								<td>';	
					echo		'<input type="text" name="topic" value="' . $row['Topic'] . '"/>';
					echo 	'</td>
						</tr>
						<tr>
							<td>
								Secondary Topic
							</td>
							<td>';
					echo '<input type="text" name="secondary" value="' . $row['SecondaryTopic'] . '"/>';
					echo '</td>
						</tr>	
						<tr> 
							<td>
								Publication Date
							</td>
							<td>';
					echo '<input type="text" name="publication_date" value="' . $row['PublicationDate'] . '"/>';
					echo '</td>
						</tr>	
						<tr>
							<td>
								Scale
							</td>
							<td>';
					echo '<input type="text" name="scale" value="' . $row['Scale'] . '"/>';
					echo '</td>
						</tr>
						<tr>
							<td>
								Area 1
							</td>
							<td>';
					echo '<input type="text" name="area1" value="' . $row['Area1'] . '"/>';
					echo '</td>
						</tr>
						<tr>
							<td>
								Area 2
							</td>
							<td>';
					echo '<input type="text" name="area2" value="' . $row['Area2'] .'"/>';
					echo '</td>
						</tr>
						<tr>
								<td>
								Area 3
							</td>
							<td>';
					echo '<input type="text" name="area3" value="' . $row['Area3'] . '"/>';
					echo '</td>
						</tr>
						<tr>
							<td>
								Other
							</td>
							<td>';
					echo '<input type="text" name="other" value="' . $row['Other'] . '"/>'; 
					echo '</td>
					</tr>
					<tr>
						<td>
							<input type="submit" />
						</td>
					</tr>	
				</table>';
//				}
				?>
		</form> 
	</body>
</html>	
