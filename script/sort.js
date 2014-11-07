			
			
	/**
	Appalachian State University Geography Maps Database
	Taylor King, Ian Matthews, Derrick Hamm, Huy Tu
	Under MIT License, Copyright 2014
	*/

			var tab,data;
			var sorted = -1;
			var ascending = false;

			function parse(data) 
			{
				data = data;
				tab = document.getElementsByName("data")[0];
				table_array(data);
			}
			

			// This function takes the 2d array of data and puts it in a table with the nametag "data"
			function table_array(data) 
			{
				for(i = 0; i < data.length; i++)
				{
						// Create <tr> </tr> for the data with javascript
						tab.insertRow();
						for(j = 1; j < data[i].length; j++)
						{
							tab.rows[i+1].insertCell();
							// Not sure if I truly needed to do the test for null, but if the data is null we put in nothing
							tab.rows[i +1].cells[j-1].innerHTML = (data[i][j] != null)? data[i][j]:"";
						}
				}
			}
			

			// Remove all icons from table headers
			function clearAllIcons()
			{
				for(i = 0; i < document.getElementsByName("data")[0].rows[0].cells.length; i++)
				{	
				var cell = document.getElementsByName("data")[0].rows[0].cells[i];
			  var img = cell.getElementsByTagName("img")[0];
				// This sets the image to nothing
				img.src = "";
				}
			}	
	
			function sort(p)
			{
				var asc = true;
				var cell = document.getElementsByName("data")[0].rows[0].cells[p];
			  var img = cell.getElementsByTagName("img")[0];
				clearTable();
				// If this isnt the currently sorted column, we are doing a new sort.
				if(sorted != p) 
				{
					clearAllIcons();
					// sort ascending
					ascending = true;
					// switch the image to an up-arrow to indicate ascending sort. I got these images CC online. 
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
					// I am just doing a bubble sort here, because I am that lazy.. LOL, if we are only going to have about 2000 records, it shouldn't matter.. It's rendered on the client anyways though. 
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
	// Iterate through the length of the array and remove all the arrays.
	for(i = tab.length - 1; i > 0; i--)
	{
		tab.rows[i].remove();
	}
}
