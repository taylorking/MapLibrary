			 
		//	I hate javascript.. All the code below is to programatically disable and enable search fields for the user 
			
			function toggle(id) 
			{
				switch(id)
				{
					case 0:
						flip(document.getElementsByName("query_field_1")[0]);
						flip(document.getElementsByName("connector_0")[0]);
						flip(document.getElementsByName("enable_2")[0]);
						flip(document.getElementsByName("query1")[0]);
						break;
					case 1:
						flip(document.getElementsByName("query_field_2")[0]);
						flip(document.getElementsByName("connector_1")[0]);
						flip(document.getElementsByName("query2")[0]);
						break;
					default:	
				return false;
				}
			}
			function flip(element)
			{
				if(element.disabled == false) {
					element.disabled = true;
				}
				else{
					element.disabled = false;
				}
			}
			function verify() 
			{
				if(document.getElementsByName("query0")[0].value == "")
				{
					alert("Blank search is not allowed");
					return false;
				}	
				return true;
			}	
