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
        switch($_GET['attrib'])
        {
          case "map":
          if(!isSet($_GET['map_id'])) 
					{
						echo ("Error");
					}
					else 
					{
						include_once 'libs.php';
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
          break;
        }
				?>
		</title>
	</head>
  <body>
  <?php
        include_once 'libs.php';
        $conn = getConnection();
        switch($_GET['attrib'])
      {
        case "map":
        $query = "SELECT * FROM maps WHERE id='" . $_GET['map_id'] . "'";
        $result = mysqli_query($conn, $query);
        $row = $result->fetch_array(MYSQLI_BOTH);
        echo('<h1>' . $row['Title'] . '</h1><br />');
        echo('<h3>' . $row['Topic'] . '</h3>' . (isset($row['SecondaryTopic']))? '<h3>: ' . $row['SecondaryTopic'] . '</h3><br />':""); 
        echo('<p>' . "");
        $query = "SELECT * FROM copy where map_id='" . $row['id'] . "'";
        $result = mysqli_query($conn, $result); 
          echo("<table><tr><td>Copy Number</td><td>Checked Out</td><td>Checked out date</td><td>Checked out by</td>");
        while($row = $result->fetch_array(MYSQLI_BOTH))
        {
          echo("<td>" . $row['copy_id'] . "</td>");
          echo("<td>" . ($row['checked_out_user'] != null)? '<img src="asset/x-mark-4-256.png" width=16 height=16/>' : '<img src="asset/check-mark-256.png" width=16 height=16/>' . "</td>");
          if($row['checked_out_user'] == null)
          {
            echo("<td>" . $row['checked_out_date'] . "</td>");
            echo("<td>" . $row['checked_out_by'] . "</td>");
          }
          else
          {
            echo("<td></td>");
            echo("<td></td>");
            echo('<a href="checkout.php?id=' . $row['copy_id'] . '">Check out</a>');
          }
        }
        echo("</table>");    
        echo('</p>');
        break;
      }
    ?> 
  </body>
</html>
