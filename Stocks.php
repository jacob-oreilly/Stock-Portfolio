<?php
	ob_start();
	session_start();
?>
<?php include 'nav.php';?>
<html lang = "en">
        <head>
			<title>Stocks in selected Portfolio</title>
			<link href = "css/bootstrap.min.css" rel = "stylesheet">
			
		</head>
	<body>
		
	
		<strong><u>List of stocks</u></strong>
		</br>
		<?php
			$portfolioID = $_SESSION['portfolioID'];
			$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT TICKER, BID, ASK FROM STOCKS WHERE PORTFOLIO_ID = '$portfolioID'";
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
							echo "Ticker: " . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
						case 1:
							echo "Bid: " . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
						case 2:
							echo "Ask: " . $item;
							echo "&nbsp&nbsp&nbsp&nbsp";
							break;
					}
					$counter++;
				}
				echo '<br/>';
			}
			oci_free_statement($stid);
			oci_close($conn);
			echo '<br/><br/><br/>';
		?>
		</br>
		<strong><u>Your stock progress</u></strong>
		</br>
		<?php
			$portfolioID = $_SESSION['portfolioID'];
      $conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');

			$query = "SELECT EQUITY_GROWTH, STOCKSOWNED, PERCENT_CHANGE FROM USERSTOCKS WHERE USERSTOCK_ID = '$portfolioID'";
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
							echo "Equity Growth: " . $item;
							echo "<br/>";
							break;
						case 1:
							echo "Stocks Owned: " . $item;
							echo "<br/>";
							break;
						case 2:
							echo "Percentage Changed:" . $item;
							echo "<br/>";
							break;
					}
					$counter++;
				}
			}
			oci_free_statement($stid);
			oci_close($conn);
			echo '<br/><br/><br/>';
		?>
		<a id="back" href="home.php">Back</a>
	
</body>
</html>