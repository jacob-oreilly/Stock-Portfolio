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
					switch ($x)
					{
						case 0:
							echo "First name: " . $item;
							echo '<br/>';
							break;
						case 1:
							echo "Last name: " . $item;
							echo '<br/>';
							break;
						case 2:
							echo "Net Equity: $" . $item;
							echo '<br/>';
							break;
						case 3:
							echo "Number of Portfolios: " . $item;
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
		
		<?php
			$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT ID FROM PROFILE WHERE USERNAME = '$_SESSION['username']'";
			$stid = oci_parse($conn,$query);
			oci_execute($stid,OCI_DEFAULT);

			while ($row = oci_fetch_array($stid,OCI_ASSOC))
			{
				$_SESSION['userID'] = $row;
			}
			oci_free_statement($stid);
			oci_close($conn);
			
			
			$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT ID, NOTE, NET_CHANGE, EQUITY FROM PORTFOLIO WHERE PROFILE_ID = '$_SESSION['userID']'";
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
							echo "Portfolio ID : " . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
						case 1:
							echo "Note: " . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
						case 2:
							echo "Net Change: $" . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
						case 3:
							echo "Equity: " . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
					}
					$counter++;
				}
			}
			oci_free_statement($stid);
			oci_close($conn);
		?>
		
		<?php
			if(isset($_POST['submit']) && !empty($_POST['portfolioID']))
			{
				$msg = '';
				$portfolioIDInput = $_POST['portfolioID'];
				
				$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
				$query = "SELECT ID FROM PORTFOLIO WHERE ID = '$portfolioIDInput'";
				$stid = oci_parse($conn,$query);
				oci_execute($stid,OCI_DEFAULT);

				while ($row = oci_fetch_array($stid,OCI_ASSOC))
				{
					$portfolioID = $row;
				}
				oci_free_statement($stid);
				oci_close($conn);
				
				if (!empty($portfolioID))
				{
					$_SESSION['portfolioID'] = $portfolioID;
					header('Location: portfolio.php');
				}
				else
				{
				  $msg = 'Invalid Portfolio ID';
				}
			}
		?>
		
		<form class = "form-login" role = "form" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method = "post">
			<h4><?php echo $msg; ?></h4>
			<input type = "text" class = "form-control" name = "portfolioID" placeholder = "Portfolio ID" required autofocus></br>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" name = "submit">Submit</button>
		</form>
	</body>
</html>