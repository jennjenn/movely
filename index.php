<?php
session_start();
require_once('connect.php');
$uid = $_SESSION['uid'];
$username = $_GET['username'];
$theuser = $_SESSION['username'];
$url = $_GET['url'];
$delurlid = $_GET['delete'];
$notes = $_GET['notes'];
if(!empty($_GET['logout'])){
	session_destroy();
}
?>

<html>
<head>
	<title>movely</title>
</head>
<body>
<?php
if(!empty($delurlid)){
	$query2 = mysql_query("DELETE FROM urls WHERE urlid = $delurlid AND uid = $uid");
}
if(!empty($url)){
	$query2 = mysql_query("INSERT INTO urls(uid, url, notes) VALUES ($uid, '$url', '$notes')");
}
if(!empty($username)){
	//username submitted
	$query = mysql_query("SELECT * FROM users WHERE username = '$username'");
	$results = mysql_num_rows($query);
	if($results > 0){
		$results = mysql_fetch_assoc($query);
		$uid = $results['uid'];
		$_SESSION['uid'] = $uid;
		$_SESSION['username'] = $username;
		$uid = $_SESSION['uid'];
		$theuser = $_SESSION['username'];
		//echo $uid;
	}else{
		$query = mysql_query("INSERT INTO users(username) VALUES ('$username')");
	}	
}elseif(empty($uid)){
	//no username allow entry
	?>
	<form method="get" action="/" />
	<input type="text" value="username" name="username" id="username" />
</form>
<?php
}
if($uid){
	echo "<p>hai $theuser!</p>";
	echo '<p>paste your url here</p>';
	?>
	<form method="get" action="/" />
	<input type="text" name="url" id="url" width="25" />
	<br />
	<textarea name="notes">notes?</textarea>
	<input type="submit" value="add" />
	<?php

	$query = mysql_query("SELECT * FROM urls WHERE uid = $uid");
	echo '<p>here are your links:</p><ul>';
	while($results = mysql_fetch_assoc($query)){
		$theurl = $results['url'];
		$thenote = $results['notes'];
		$urlid = $results['urlid'];
		echo "<li><a href='$theurl'>$theurl</a> | $thenote | <a href='/?delete=$urlid' alt='delete?'>(X)</a></li>";
	}
	echo '</ul>';
	echo '<p>that\'s it!</p>';
	
}
?>
<a href="/?logout=1">log out</a>
</body>
</html>

<!--<script language="javascript" type="text/javascript"> 
document.write (document.location.href); 
</script>-->