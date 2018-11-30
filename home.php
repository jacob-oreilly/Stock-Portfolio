<?php
	session_start();
?>
<html>
	<body>
		<h2>Home</h2>
		<?php
			$userName = $_SESSION['username'];
			$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT FIRST_NAME, LAST_NAME, NET_EQUITY, NUM_PORTFOLIOS FROM PROFILE WHERE USERNAME = '$userName'";
			$stid = oci_parse($conn,$query);
			oci_execute($stid,OCI_DEFAULT);

			while ($row = oci_fetch_array($stid,OCI_ASSOC))
			{
				$counter = 0;
				foreach ($row as $item)
				{
					$userInfo[$counter] = $item;
					$counter++;
				}
			}
			oci_free_statement($stid);
			oci_close($conn);
			
			$arrayLength = count($userInfo);
			for ($x = 0; $x < $arrayLength; $x++)
			{
				switch ($x)
				{
					case 0:
						echo "First name: " . $userInfo[$x];
						echo '<br/>';
						break;
					case 1:
						echo "Last name: " . $userInfo[$x];
						echo '<br/>';
						break;
					case 2:
						echo "Net Equity: $" . $userInfo[$x];
						echo '<br/>';
						break;
					case 3:
						echo "Number of Portfolios: " . $userInfo[$x];
						echo '<br/>';
						break;
				}
			}
		?>
		<?php
			$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT NOTE, NET_CHANGE, EQUITY FROM PORTFOLIO WHERE PROFILE_ID = '$_SESSION['userID']'";
			$stid = oci_parse($conn,$query);
			oci_execute($stid,OCI_DEFAULT);

			while ($row = oci_fetch_array($stid,OCI_ASSOC))
			{
				$counter = 0;
				foreach ($row as $item)
				{
					$counter = $counter + 1;
				}
			}
			oci_free_statement($stid);
			oci_close($conn);
		?>
	</body>
</html>