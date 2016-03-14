<?php

	if (!$_GET['number'] || !$_GET['type'] || !$_GET['status'])
	{
		header('Location: status.php?status=failed');
		exit;
	}

	$servername = "localhost";
	$username = "ftciowa";
	$password = "gp";
	$database = "ftc";

	$link = mysql_connect($servername, $username, $password)
    	or die('Could not connect: ' . mysql_error());
	echo 'Connected successfully';
	
	mysql_select_db($database) or die('Could not select database');


	$type = NULL;
	$comment_type;

	if ($_GET['type'] == 'robot')
	{
		$type = 'robot_inspection_status';
		$comment_type = 'robot_inspection_comment';
	} 
	else 
	{
		$type = 'field_inspection_status';
		$comment_type = 'field_inspection_comment';
	}

	$status = NULL;
	if ($_GET['status'] == "pass")
		$status = "PASS";
	else
		$status = "FAIL";

	$sql = "UPDATE team SET ".$type."='".$status."', 
		".$comment_type."='".$_GET['comment']."',
		last_updated=NOW()
		WHERE team_number=".$_GET['number'];

	// Performing SQL query
	$result = mysql_query($sql);
	
	if($result)
	{
		header('Location: status.php?status=success');
		exit;
	}
		header('Location: status.php?status=failed');
		exit;
?>