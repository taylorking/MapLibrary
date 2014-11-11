			
			
	/**
	Appalachian State University Geography Maps Da_tabase
	Taylor King, Ian Matthews, Derrick Hamm, Huy Tu
	Under MIT License, Copyright 2014
	*/

			var _tab,_data;
			var sorted = -1;
			var ascending = false;
      var admin = false; // Note enabling this in the javascript console will not do anything except show the buttons. The php to actually execute queries will not work unless you are loggied in.
      _tab = document.getElementsByName("data")[0];

			
      function initial_table(data, admin)
      {
        _data = data;
        _admin = admin;
        for(i = 0; i < _data.length; i++) // initialize the table and add our sweet buttons to the end of the row
        {
            _data[i].push(((admin)? '<a href="edit.php?id=' + _data[i][0] + '"><img src="asset/edit-256.png" width=16 height=16/></a><a href="edit.php?function=delete&id=' + _data[i][0] + '"><img src="asset/x-mark-4-256.png" width=16 height=16/></a>':"") + '<a href="summary.php?id=' + _data[i][0] + '"><img src="asset/question-mark-4-256.png" width=16 height=16/></a>');
        }
        table_array(_data, _admin);
      }
			// This function takes the 2d array of data and puts it in a _table with the nametag "data"
			function table_array(data, admin) 
			{
				for(i = 0; i < data.length; i++)
				{
						// Create <tr> </tr> for the data with javascript
						_tab.insertRow();
						for(j = 1; j < data[i].length; j++)
						{
							_tab.rows[i+1].insertCell();
							// Not sure if I truly needed to do the test for null, but if the data is null we put in nothing
							_tab.rows[i +1].cells[j-1].innerHTML = (data[i][j] != null)? data[i][j]:"";
						}
        }
			}
			

			// Remove all icons from _table headers
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
				clear_table();
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
						for( i = 0 ; i < _data.length ; i++)
						{
							for(j = 0; j < _data.length - 1; j++)
							{
								if(_data[j][p+1] > _data[j+1][p+1])
								{
									var hold = _data[j+1];
									_data[j+1] = _data[j];
									_data[j] = hold;
								}
							}
						}
					}
					else {
						for(i = 0; i < _data.length; i++)
						{
							for(j = 0; j < _data.length - 1; j++)
							{
								if(_data[j][p+1] < _data[j+1][p+1])
								{
									var hold = _data[j+1];
									_data[j+1] = _data[j]
									_data[j] = hold;
								}
							}
						}
					}
          //_data = data;
					clear_table();
					table_array(_data, _admin);
				}
//Do the actual sort now
//			doSort();


function clear_table()
{
	// Iterate through the length of the array and remove all the arrays.
	for(i = _tab.length - 1; i > 0; i--)
	{
		_tab.rows[i].remove();
	}
}
