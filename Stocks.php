<!DOCTYPE html>
<html>
<head>
</head>
<body>
	<?php
			// Remember to replace 'username' and 'password'!
			$conn = oci_connect('joreilly', 'Feb231996', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');

			
			//put your query here
			$query = "SELECT ATTRIBUTESNAME, CITYNAME, COUNTRYNAME FROM HIGHSCHOOL WHERE ATTRIBUTESNAME = '$schoolName'";
			$stid = oci_parse($conn,$query);
			oci_execute($stid,OCI_DEFAULT);

			//iterate through each row
			while ($row = oci_fetch_array($stid,OCI_ASSOC)) 
			{
				//iterate through each item in the row and echo it  
				foreach ($row as $item)    
				{
					echo $item . ' ';
				}   
				echo '<br/>';
			}
			oci_free_statement($stid);
			oci_close($conn);
		?>
</body>
</html>