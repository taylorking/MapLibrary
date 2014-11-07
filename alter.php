<?php
include 'libs.php';
$conn = getConnection();
if(!verifyLogin())
	{
		// If the user does not have a valid cookie, this script should not run."
		echo('This operation is not allowed.<br />Please <a href="login.php">login</a>');
		return false;
	}
if(isset($_POST))
{
	if($_POST['id'] == null) 
		{
			//If the user has opened the form without an ID that means they are trying to create a record.. We will want to run an insert here.
		$query = "insert into maps (GKey, Subject, CatalogDate, Publisher, Identifier, Title, Type, Topic, SecondaryTopic, PublicationDate, Scale, Area1, Area2, Area3, Other) VALUES ('" . $_POST['gkey'] . "','" . $_POST['subject'] . "','" . $_POST['catalog_date'] . "','" . $_POST['publisher'] . "','" . $_POST['identifier'] . "','" . $_POST['title'] . "','" . $_POST['type'] . "','" . $_POST['topic'] . "','" . $_POST['secondary'] . "','" . $_POST['publication_date'] . "','" . $_POST['scale'] . "','" . $_POST['area1'] . "','" . $_POST['area2'] . "','" . $_POST['area3'] . "','" . $_POST['other'] . "')"; 
		}
	else 
		{	
			//Im too tired going to finish this later.. Basically this is just the big update set query like the insert before 
			$query = "update maps set GKey='" . $_POST['gkey'] . "', Subject='" . $_POST['subject'] . "', CatalogDate='" . $_POST['catalog_date'] . "', Publisher='" . $_POST['publisher'] . "', Identifier='" . $_POST['identifier'] . "', Title='" . $_POST['title'] . "', Type='" . $_POST['type'] . "', Topic='" . $_POST['topic'] . "', SecondaryTopic='" . $_POST['secondary'] . "', PublicationDate='" . $_POST['publication_date'] . "', Scale='" . $_POST['scale'] . "', Area1='" . $_POST['area1'] . "', Area2='" . $_POST['area2'] . "', Area3='" . $_POST['area3'] . "', Other='" . $_POST['other'] . "' WHERE id='" . $_POST['id'] . "'";
		}

	mysqli_query($conn, $query);
	echo("Query successful. ");	

}




if($_GET == null)
{
		return false;
}
include 'libs.php';
//This code is just a quick way for the admin to delete a record that may need to be deleted.
$conn = getConnection();
switch($_GET['function'])
{
	case 'delete':
	$query = "DELETE FROM maps where id='" . $_GET['id'] . "'";
	$result = mysqli_query($conn, $query);
	return ($result != null);
	default: 
	break;
}





?>
