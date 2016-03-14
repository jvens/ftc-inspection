<?php
	require 'FlashMessages.php';
	// Start a session
	if (!session_id()) @session_start();
	
	$servername = "localhost";
	$username = "ftciowa";
	$password = "gp";
	$database = "ftc";

	$link = mysql_connect($servername, $username, $password)
    	or die('Could not connect: ' . mysql_error());
	echo 'Connected successfully';
	
	mysql_select_db($database) or die('Could not select database');

	$sql = "SELECT * FROM team";

	// Performing SQL query
	$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
	
	if(!$result)
	{
		die('Query failed');
	}
	$ortbergRows = [];
	$ryersonRows = []; 

	while($row = mysql_fetch_assoc($result)) { 
		if ($row['division'] == "Ortberg")
			array_push($ortbergRows, $row);
		else
			array_push($ryersonRows, $row);
	}

	// Instantiate the class
	$msg = new \Plasticbrain\FlashMessages\FlashMessages();
	
	if (isset($_GET['status']))
	{
		$status = $_GET['status'];
		if ($status == "success")
		{
			$msg->success('Team info updated successfully.');
		}	
		else if ($status == "failed")
		{
			$msg->error('There was an error when updating team information.');
		}
	}
?>

<html>
<meta http-equiv="refresh" content="60" />
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js">
	</script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<style>
	table {
		border-collapse: collapse;
		width: 80%;
		border: 1px solid black;
	}

	table, th, td {
	}

	td {
		padding: 5px;
		padding-left: 10px;
	}

	tr:nth-child(odd) {
		background-color: #e0e0e0;
	}

	th{
		font-size: 1.2em;
		background-color: #a0a0a0;
		border-bottom: 1px solid;
	}

	</style>
</head>

<body>

<?php $msg->display(); ?>

<center>

<h1>Ortberg Division</h1>
<table style="width:80%" border=1>
	<tr>
		<th>Number</th>
		<th>Name</th>
		<th>Robot Inspection</th>
		<th>Field Inspection</th>
		<th>Last Upadated</th>
	</tr>

	<?php foreach($ortbergRows as $row) { 

		if ($row['robot_inspection_status'] == "PASS")
		{
			$robotBgColor = "green";
			$robotRobotStatus = "Passed";
		}
		else if ( $row['robot_inspection_status'] == "FAIL")
		{
			$robotBgColor = "red";
			$robotRobotStatus = "Failed";
		}
		else
		{
			$robotBgColor = "white";
			$robotRobotStatus = "Not Seen";
		}

		if ($row['field_inspection_status'] == "PASS")
		{
			$fieldBgColor = "green";
			$fieldRobotStatus = "Passed";
		}
		else if ( $row['field_inspection_status'] == "FAIL")
		{
			$fieldBgColor = "red";
			$fieldRobotStatus = "Failed";
		}
		else
		{
			$fieldBgColor = "white";
			$fieldRobotStatus = "Not Seen";
		} 

		$last_updated = new DateTime($row['last_updated']);
		?>

		<tr>
			<td><?php echo $row['team_number']; ?></td>
			<td><?php echo $row['team_name']; ?></td>
			<td bgcolor=<?php echo $robotBgColor;?> >
				<?php echo $robotRobotStatus; ?>
			</td>
			<td bgcolor= <?php echo $fieldBgColor;?> >
				<?php echo $fieldRobotStatus ?>
			</td>
			<td>
				<?php echo date_format($last_updated, "H:i:s"); ?>
			</td>
		</tr>
	<?php } ?>

</table>

<h1>Ryerson Division</h1>
<table style="width:80%" border=1>
	<tr>
		<th>Number</th>
		<th>Name</th>
		<th>Robot Inspection</th>
		<th>Field Inspection</th>
		<th>Last Upadated</th>
	</tr>
	<?php foreach($ryersonRows as $row) { 

		if ($row['robot_inspection_status'] == "PASS")
		{
			$robotBgColor = "green";
			$robotRobotStatus = "Passed";
		}
		else if ( $row['robot_inspection_status'] == "FAIL")
		{
			$robotBgColor = "red";
			$robotRobotStatus = "Failed";
		}
		else
		{
			$robotBgColor = "white";
			$robotRobotStatus = "Not Seen";
		}

		if ($row['field_inspection_status'] == "PASS")
		{
			$fieldBgColor = "green";
			$fieldRobotStatus = "Passed";
		}
		else if ( $row['field_inspection_status'] == "FAIL")
		{
			$fieldBgColor = "red";
			$fieldRobotStatus = "Failed";
		}
		else
		{
			$fieldBgColor = "white";
			$fieldRobotStatus = "Not Seen";
		} 

		$last_updated = new DateTime($row['last_updated']);
		?>
		<tr>
			<td><?php echo $row['team_number']; ?></td>
			<td><?php echo $row['team_name']; ?></td>
			<td bgcolor=<?php echo $robotBgColor;?> >
				<?php echo $robotRobotStatus; ?>
			</td>
			<td bgcolor= <?php echo $fieldBgColor;?> >
				<?php echo $fieldRobotStatus ?>
			</td>
			<td>
				<?php echo date_format($last_updated, "H:i:s"); ?>
			</td>
		</tr>
	<?php } ?>
</table>

</center>
</body>
</html>