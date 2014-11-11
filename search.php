<!-- What this file is:
This is a form that the user will fill out with their query information. 
It should dynamically change on the fly to only allow them to fill 
certain fields.

-->
<html>
	<head>
		<title>
			Query the Geography Database
		</title>
		<script type="text/javascript" src="script/dynamic_search_form.js">
			
		</script>
        <link rel = "stylesheet" href = "stylesheet.css">
	</head>
	<body>
    <div class = "mainWrapper">
		<form name="search" action="present.php" method="get" onsubmit="return verify()">
		<!-- 
			Below I put the code for the form inside of a table.. Derrick if you could please come up with a style for the class "form" all forms that the user can edit, I have tried to make that class.`
		-->	
		
			<?php
				include 'libs.php';
				if(!verifyLogin())
				{
					echo('<a href="login.php"><img src="asset/login-256.png" width=16 height=16 /></a>');
				}
				else
				{
				}
			?>
	<table class="form">
			<tr>
				<td>
				</td>
				<td>
				<select name="query_field">
					<option value="Title">Title</option>
					<option value="Type">Type</option>
					<option value="Area3">Area3</option>
					<option value="Area2">Area2</option>
					<option value="Area1">Area1</option>
					<option value="PublicationDate">PublicationDate</option>
				</select>
				</td>
				<td>
					<input type="text" name="query0"/>
				</td>
				<td>
					<select name="connector_0" disabled=true>
						<option value="ignore"/>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						<option value="ANDNOT">AND NOT</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="enable_1" onclick="toggle(0);"/>
				</td>
				<td>	
				<select name="query_field_1" disabled=true>
					<option value="Title">Title</option>
					<option value="Type">Type</option>
					<option value="Area3">Area3</option>
					<option value="Area2">Area2</option>
					<option value="Area1">Area1</option>
					<option value="PublicationDate">PublicationDate</option>
				</select>
				</td>
				<td>
					<input type="text" name="query1" disabled=true/>
				</td>
				<td>
					<select name="connector_1" disabled=true>
						<option value="ignore"/>
						<option value="AND">AND</option>
						<option value="OR">OR</option>
						<option value="ANDNOT">AND NOT</option>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" name="enable_2" onclick="toggle(1);" disabled=true/>
				</td>
				<td>	
				<select name="query_field_2" disabled=true>
					<option value="Title">Title</option>
					<option value="Type">Type</option>
					<option value="Area3">Area3</option>
					<option value="Area2">Area2</option>
					<option value="Area1">Area1</option>
					<option value="PublicationDate">PublicationDate</option>
				</select>
				</td>
				<td>
					<input type="text" name="query2" disabled=true/>
				</td>
			</tr>
			<tr>
				<td>
					<input type="submit" />
				</td>
			</tr>
			</table>
		</form>
        </div>
	</body>
</html>
