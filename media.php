<?php
	ob_start();
	session_start();
?>
<?php include 'nav.php';?>
<html lang = "en">
	<body>
		<head>
			<title>Stock Media</title>
			<link href = "css/bootstrap.min.css" rel = "stylesheet">
			
		</head>
	
		
		<?php
			$conn = oci_connect('jorielly', 'Feb231996', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT TITLE, WORDS, DATES FROM MEDIA";
			$stid = oci_parse($conn,$query);
			oci_execute($stid,OCI_DEFAULT);

			while ($row = oci_fetch_array($stid,OCI_ASSOC))
			{
				$counter = 0;
				foreach ($row as $item)
				{
					switch ($counter)
					{
						case 0:
							echo $item;
							echo '<br/>';
							break;
						case 1:
							echo $item;
							echo '<br/>';
							break;
						case 2:
							echo $item;
							echo '<br/>';
							break;
					}
					$counter++;
				}
			}
			oci_free_statement($stid);
			oci_close($conn);
			echo '<br/><br/><br/>';
		?>
	
</body>
</html>