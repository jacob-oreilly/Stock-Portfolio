<?php
	ob_start();
	session_start();
?>
<?php include 'nav.php';?>
<html>
<head>
	
	<style>
		body {
			margin: 0;
		}

		.container {
			min-height: 100%;
			display: flex;
			flex-direction: column;
		}

		
	</style>
</head>
<body>
	<div class="container">
		
		<?php
			$conn = oci_connect('joreilly', 'Feb231996', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT TICKER, BID, ASK, EQUITY FROM STOCKS WHERE PORTFOLIO_ID = '$portfolioID'";
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
			echo '<br/><br/><br/>';
		?>
		<a id="back" href="home.php">Back</a>
	</div>
</body>
</html>