function myFunction()
		{
			var input, filter, table, tr, i, j, column_length, count_td;
		    column_length = document.getElementById('myTable').rows[0].cells.length;
        	input = document.getElementById("myInput");
        	filter = input.value.toUpperCase();
        	table = document.getElementById("myTable");
      		tr = table.getElementsByTagName("tr");
      		for (i = 1; i < tr.length; i++) 
      		{
        		count_td = 0;
        		for(j = 1; j < 5; j++)
        		{
            		td = tr[i].getElementsByTagName("td")[j];
            		if (td)
            		{
              			if ( td.innerHTML.toUpperCase().indexOf(filter) > -1) 
              			{            
                			count_td++;
              			}
            		}
        		}
		        if(count_td > 0)
		        {
        		    tr[i].style.display = "";
        		}
        		else
        		{
            		tr[i].style.display = "none";
        		}
      		}
    	}