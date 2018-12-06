<?php
  ob_start();
  session_start();
?>

<html lang = "en">
  <head>
    <title>Stock Portfolio</title>
    <link href = "css/bootstrap.min.css" rel = "stylesheet">
  </head>

  <body>
    <h2>Login</h2>
    <div class = "container form-login">
      <?php
        $msg = '';

        if(isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
			
			$userName = $_POST['username'];
			$conn = oci_connect('spatten', 'Nov961997', '(DESCRIPTION=(ADDRESS_LIST=(ADDRESS=(PROTOCOL=TCP)(Host=db2.ndsu.edu)(Port=1521)))(CONNECT_DATA=(SID=cs)))');
			$query = "SELECT PASSWORD, USERNAME_ID FROM LOGININFO WHERE USERNAME = '$userName'";
			$stid = oci_parse($conn,$query);
			oci_execute($stid,OCI_DEFAULT);
			while ($row = oci_fetch_array($stid,OCI_ASSOC))
			{
				$counter = 0;
				foreach ($row as $item)
				{
					if ($counter == 0)
					{
						$correctPassword = $item;
					}
					else
					{
						$userProfileID = $item;
					}
					$counter++;
				}
			}
			oci_free_statement($stid);
			oci_close($conn);
			
			if (strcmp($_POST['password'],$correctPassword) == 0) 
			{
				$_SESSION['valid'] = true;
				$_SESSION['timeout'] = time();
				$_SESSION['userProfileID'] = $userProfileID;
				header('Location: home.php');
			}
            else {
              $msg = 'Incorrect login credentials';
            }
        }
      ?>
    </div>
    <div class = "container">

      <form class = "form-login" role = "form" action= "<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
        method = "post">
        <h4 class = "form-login-header"><?php echo $msg; ?></h4>
        <input type = "text" class = "form-control"
               name = "username" placeholder = "username = username"
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password = password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
               name = "login">Login</button>
      </form>
    </div>
  </body>
</html>
