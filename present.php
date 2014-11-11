<html>
	<head>
  <title>Search Results</title>
    <script type="text/javascript"> 
      var tab = document.getElementsByName("data")[0]; 
      var result;
      addScript("script/sort.js");
      function addScript(name)
      {
        var script = document.createElement("script");
        script.type="text/javascript";
        script.src = name;
        document.getElementsByTagName("head")[0].appendChild(script);
      } 
      function fill()
      {
        var admin = (
          <?php
          include_once "libs.php";
          echo json_encode(verifyLogin());
            ?>); // Verify whether or not the user is an admin in order to descide whether to print edit buttons
        result = ( <?php 
          include 'do_search.php'; // Take the get result from this the form and hand it off to another php file. I cut the big block out of here for clarity.
            echo(do_search($_GET));
              ?>);  
            result = result;
            initial_table(result, admin); 
        }
    </script>
  </head>
<body onload="fill()">

<?php
//include 'libs.php';
if(verifyLogin())
		{
      echo('
			<table>
				<tr>
					<td>Welcome ' . $_COOKIE['user'] . '</td><td><a href="libs.php?funct=logout"><img src="asset/exit-256.png" width=16 height=16/></a></td>
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

