<html>
	<head>
		<script type="text/javascript">
			var tab,data;
			var sorted = -1;
			var ascending = false;

			function parse() 
			{
				tab = document.getElementsByName("data")[0];
				data = (
				<?php 
				include 'libs.php';

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
				);
				table_array(data);
			}
			
			function table_array(data) 
			{
				for(i = 0; i < data.length; i++)
				{
						tab.insertRow();
						for(j = 1; j < data[i].length; j++)
						{
							tab.rows[i+1].insertCell();
							tab.rows[i +1].cells[j-1].innerHTML = (data[i][j] != null)? data[i][j]:"";
						}
				}
			}
			function clearAllIcons()
			{
				for(i = 0; i < document.getElementsByName("data")[0].rows[0].cells.length; i++)
				{	
				var cell = document.getElementsByName("data")[0].rows[0].cells[i];
			  var img = cell.getElementsByTagName("img")[0];
				img.src = "";
				}
			}	
	
			function sort(p)
			{
				var asc = true;
				var cell = document.getElementsByName("data")[0].rows[0].cells[p];
			  var img = cell.getElementsByTagName("img")[0];
				clearTable();
				if(sorted != p) 
				{
					clearAllIcons();
					//sort ascending
					ascending = true;
					img.src='asset/arrow-up-256.png';
					img.width =16; 
					img.height = 16;
					sorted = p;
				}
				else
				{
					if(ascending)		
					{
						ascending = false;
						img.src = 'asset/arrow-down-256.png';
						img.height = 16;
						img.width = 16;
					}
					else
					{
						sorted = -1;
						ascending = false;
						img.src="";
						return;
					}
				}	
					if(ascending){
						for( i = 0 ; i < data.length ; i++)
						{
							for(j = 0; j < data.length - 1; j++)
							{
								if(data[j][p+1] > data[j+1][p+1])
								{
									var hold = data[j+1];
									data[j+1] = data[j];
									data[j] = hold;
								}
							}
						}
					}
					else {
						for(i = 0; i < data.length; i++)
						{
							for(j = 0; j < data.length - 1; j++)
							{
								if(data[j][p+1] < data[j+1][p+1])
								{
									var hold = data[j+1];
									data[j+1] = data[j]
										data[j] = hold;
								}
							}
						}
					}
					clearTable();
					table_array(data);
				}
//Do the actual sort now
//			doSort();


function clearTable()
{
	for(i = tab.length - 1; i > 0; i--)
	{
		tab.rows[i].remove();
	}
}
</script>
</head>
<body onload="parse()">
<?php
if(verifyLogin())
		{
			echo('
			<table>
				<tr>
					<td>Welcome ' . $_COOKIE['user'] . '</td><td><a href="libs.php?function=logout"><img src="asset/exit-256.png" width=16 height=16/></a></td>
				</tr>
				<tr>
					<td><a href="edit.php"><img src="asset/plus-256.png" width=16 height=16/></a></td>
				</tr>
			</table>');
		}
?>
<table name="data" class="result">
<tr class="hold"><td onclick='sort(0)'>GKey<img width=16 height=16 name="icon"></td>
								<td onclick='sort(1)'>Subject<img name="icon"></td>
								<td onclick='sort(2)'>Catalog Date<img name="icon"/></td>
								<td onclick='sort(3)'>Publisher<img name="icon"/></td>
								<td onclick='sort(4)'>Identifier<img name="icon"/></td>
								<td onclick='sort(5)'>Title<img name="icon"/></td>
								<td onclick='sort(6)'>Type<img name="icon"/></td>
								<td onclick='sort(7)'>Topic<img name="icon"/></td>
								<td onclick='sort(8)'>Secondary Topic<img name="icon"/></td>
								<td onclick='sort(9)'>Publication Date<img name="icon"/></td>
								<td onclick='sort(10)'>Scale<img name="icon"/></td>
								<td onclick='sort(11)'>Area 1<img name="icon"/></td>
								<td onclick='sort(12)'>Area 2<img name="icon"/></td>
								<td onclick='sort(13)'>Area 3<img name="icon"/></td>
</tr>
</table>
</body>
</html>

