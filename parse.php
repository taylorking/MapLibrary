<?php 
		include 'libs.php';
		function parse($_GET
		$conn = getConnection();
		// Begin to build the query
		$query = "SELECT * FROM maps";
		switch ( $_GET['query_field'] )
		{
			//Append relavant query information
			case "Title":
			$query = $query . " WHERE Title LIKE '%" . $_GET['query0'] . "%'";
			break;
			case "Topic": 
			$query = $query . " WHERE Topic LIKE '%" . $_GET['query0'] . "%'";
			break;
			case "Type": 
			$query = $query . " WHERE Type LIKE '%" . $_GET['query0'] . "%'";
			break;
			case "Area3":
			$query = $query . " WHERE Area3 LIKE '%" . $_GET['query0'] . "%'";
			break;
			case "Area2":
			$query = $query . " WHERE Area2 LIKE '%" . $_GET['query0'] . "%'";
			break;
			case "Area1":
			$query = $query . " WHERE Area1 LIKE '%" . $_GET['query0'] . "%'";
			break;
			case "PublicationDate":
			$query = $query . " WHERE PublicationDate LIKE '%" . $_GET['query0'] . "%'";
			break;	
		}	
		
		if($_GET['enable_1'] == "on" && $_GET['query1'] != "") 
		{
				switch($_GET['query_field_1'])
				{
				case "Title":
					switch($_GET['connector_0'])
					{
						case "ignore":
						break;
						case "AND":
						$query = $query . " AND Title LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "OR":
						$query = $query . " OR Title LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "ANDNOT":
						$query = $query . " AND Title NOT LIKE '%" . $_GET['query1'] . "%'";
						break;
					}
				break;
				case "Type":
					switch($_GET['connector_0'])
					{	
						case "ignore":
						break;
						case "AND":
						$query = $query . " AND Type LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "OR":
						$query = $query . " OR Type LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "ANDNOT":
						$query = $query . " AND Type NOT LIKE '%" . $_GET['query1'] . "%'";
						break;				
					}
				break;
				case "Area3":
					switch($_GET['connector0'])
					{
						case "ignore":
						break;
						case "AND":
						$query = $query . " AND Area3 LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "OR":
						$query = $query . " OR Area3 LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "ANDNOT":
						$query = $query . " AND Area3 NOT LIKE '%" . $_GET['query1'] . "%'";
						break; 
					}
					break;
				case "Area2":
					switch($_GET['connector0']) 
					{
						case "ignore":
						break;
						case "AND":
						$query = $query . " AND Area2 LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "OR":
						$query = $query . " OR Area2 LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "ANDNOT":
						$query = $query . " AND Area2 NOT LIKE '%" . $_GET['query1'] . "%'";
						break;	
					}
					break;
				case "Area1":
					switch($_GET['connector0'])
					{
						case "ignore":
						break;
						case "AND":
						$query = $query . " AND Area1 LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "OR":
						$query = $query . " OR Area1 LIKE '%" . $_GET['query1'] . "%'";
						break;
						case "ANDNOT":
						$query = $query . " AND Area1 NOT LIKE '%" . $_GET['query1'] . "%'";
						break;
					}
				break;
				}
		}
				$result = mysqli_query($conn, $query);
						while($row = $result->fetch_array(MYSQL_NUM))
						{
								$data[] = $row;
						}			
					echo(json_encode($data));	
					?>
