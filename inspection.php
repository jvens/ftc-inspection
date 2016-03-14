<?php include("password_protect.php"); ?>
<html>

<body>
<center>
<form action="update.php">
<fieldset>
<p>Team Number:<br>
<input type="number" name="number" min="1" max="99999"><br>

<p>Inspection Type:<br>
<input type="radio" name="type" value="robot" checked> Robot<br>
<input type="radio" name="type" value="field"> Field<br>

<p>Status:<br>
<input type="radio" name="status" value="pass" checked> Passed<br>
<input type="radio" name="status" value="fail"> Failed<br>

<p>Comment:<br>
<input type="text" name="comment"><br>

<p><input type="submit" value="Submit">
</fieldset>
</form>
</center>
</body>
</html>